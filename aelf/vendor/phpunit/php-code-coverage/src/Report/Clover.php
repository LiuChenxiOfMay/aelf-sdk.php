<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Key\Deterministic;

use BitWasp\Bitcoin\Crypto\EcAdapter\Key\KeyInterface;
use BitWasp\Bitcoin\Crypto\EcAdapter\Key\PrivateKeyInterface;
use BitWasp\Bitcoin\Crypto\EcAdapter\Key\PublicKeyInterface;
use BitWasp\Bitcoin\Crypto\Hash;
use BitWasp\Buffertools\Buffer;
use BitWasp\Buffertools\BufferInterface;

class ElectrumKey
{
    /**
     * @var null|PrivateKeyInterface
     */
    private $masterPrivate;

    /**
     * @var PublicKeyInterface
     */
    private $masterPublic;

    /**
     * @param KeyInterface $masterKey
     */
    public function __construct(KeyInterface $masterKey)
    {
        if ($masterKey->isCompressed()) {
            throw new \RuntimeException('Electrum keys are not compressed');
        }

        if ($masterKey instanceof PrivateKeyInterface) {
            $this->masterPrivate = $masterKey;
            $this->masterPublic = $masterKey->getPublicKey();
        } elseif ($masterKey instanceof PublicKeyInterface) {
            $this->masterPublic = $masterKey;
        }
    }

    /**
     * @return PrivateKeyInterface
     */
    public function getMasterPrivateKey(): PrivateKeyInterface
    {
        if (null === $this->masterPrivate) {
            throw new \RuntimeException("Cannot produce master private key from master public key");
        }

        return $this->masterPrivate;
    }

    /**
     * @return PublicKeyInterface
     */
    public function getMasterPublicKey(): PublicKeyInterface
    {
        return $this->masterPublic;
    }

    /**
     * @return BufferInterface
     */
    public function getMPK(): BufferInterface
    {
        return $this->getMasterPublicKey()->getBuffer()->slice(1);
    }

    /**
     * @param int $sequence
     * @param bool $change
     * @return \GMP
     */
    public function getSequenceOffset(int $sequence, bool $change = false): \GMP
    {
        $seed = new Buffer(sprintf("%s:%d:%s", $sequence, $change ? 1 : 0, $this->getMPK()->getBinary()));
        return Hash::sha256d($seed)->getGmp();
    }

    /**
     * @param int $sequence
     * @param bool $change
     * @return KeyInterface
     */
    public function deriveChild(int $sequence, bool $change = false): KeyInterface
    {
        $key = is_null($this->masterPrivate) ? $this->masterPublic : $this->masterPrivate;
        return $key->tweakAdd($this->getSequenceOffset($sequence, $change));
    }

    /**
     * @return ElectrumKey
     */
    public function withoutPrivateKey(): ElectrumKey
    {
        $clone = clone $this;
        $clone->masterPrivate = null;
        return $clone;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Key\Deterministic\HdPrefix;

use BitWasp\Bitcoin\Network\NetworkInterface;

class GlobalPrefixConfig
{
    /**
     * @var NetworkConfig[]
     */
    private $networkConfigs = [];

    /**
     * ScriptPrefixConfig constructor.
     * @param NetworkConfig[] $config
     */
    public function __construct(array $config)
    {
        foreach ($config as $networkPrefixConfig) {
            if (!($networkPrefixConfig instanceof NetworkConfig)) {
                throw new \InvalidArgumentException("expecting array of NetworkPrefixConfig");
            }

            $networkClass = get_class($networkPrefixConfig->getNetwork());
            if (array_key_exists($networkClass, $this->networkConfigs)) {
                throw new \InvalidArgumentException("multiple configs for network");
            }

            $this->networkConfigs[$networkClass] = $networkPrefixConfig;
        }
    }

    /**
     * @param NetworkInterface $network
     * @return NetworkConfig
     */
    public function getNetworkConfig(NetworkInterface $network): NetworkConfig
    {
        $class = get_class($network);
        if (!array_key_exists($class, $this->networkConfigs)) {
            throw new \InvalidArgumentException("Network not registered with GlobalHdPrefixConfig");
        }

        return $this->networkConfigs[$class];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Key\Deterministic\HdPrefix;

use BitWasp\Bitcoin\Network\NetworkInterface;

class NetworkConfig
{
    /**
     * @var NetworkInterface
     */
    private $network;

    /**
     * @var ScriptPrefix[]
     */
    private $scriptPrefixMap = [];

    /**
     * @var ScriptPrefix[]
     */
    private $scriptTypeMap = [];

    /**
     * NetworkHdKeyPrefixConfig constructor.
     * @param NetworkInterface $network
     * @param ScriptPrefix[] $prefixConfigList
     */
    public function __construct(NetworkInterface $network, array $prefixConfigList)
    {
        foreach ($prefixConfigList as $config) {
            if (!($config instanceof ScriptPrefix)) {
                throw new \InvalidArgumentException("expecting array of NetworkPrefixConfig");
            }
            $this->setupConfig($config);
        }

        $this->network = $network;
    }

    /**
     * @param ScriptPrefix $config
     */
    private function setupConfig(ScriptPrefix $config)
    {
        $this->checkForOverwriting($config);

        $this->scriptPrefixMap[$config->getPrivatePrefix()] = $config;
        $this->scriptPrefixMap[$config->getPublicPrefix()] = $config;
        $this->scriptTypeMap[$config->getScriptDataFactory()->getScriptType()] = $config;
    }

    /**
     * @param ScriptPrefix $config
     */
    private function checkForOverwriting(ScriptPrefix $config)
    {
        if (array_key_exists($config->getPublicPrefix(), $this->scriptPrefixMap)) {
            $this->rejectConflictPrefix($config, $config->getPublicPrefix());
        }

        if (array_key_exists($config->getPrivatePrefix(), $this->scriptPrefixMap)) {
            $this->rejectConflictPrefix($config, $config->getPrivatePrefix());
        }

        if (array_key_exists($config->getScriptDataFactory()->getScriptType(), $this->scriptTypeMap)) {
            $this->rejectConflictScriptType($config);
        }
    }

    /**
     * @param ScriptPrefix $config
     * @param string $prefix
     */
    private function rejectConflictPrefix(ScriptPrefix $config, $prefix)
    {
 