<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Script\ScriptInfo;

use BitWasp\Bitcoin\Crypto\EcAdapter\Key\PublicKeyInterface;
use BitWasp\Bitcoin\Script\Opcodes;
use BitWasp\Bitcoin\Script\Parser\Operation;
use BitWasp\Bitcoin\Script\ScriptInterface;
use BitWasp\Bitcoin\Script\ScriptType;
use BitWasp\Buffertools\BufferInterface;

class PayToPubkey
{
    /**
     * @var BufferInterface
     */
    private $publicKey;

    /**
     * @var bool
     */
    private $verify;

    /**
     * @var int
     */
    private $opcode;

    /**
     * PayToPubkey constructor.
     * @param int $opcode
     * @param BufferInterface $publicKey
     * @param bool $allowVerify
     */
    public function __construct(int $opcode, BufferInterface $publicKey, bool $allowVerify = false)
    {
        if ($opcode === Opcodes::OP_CHECKSIG) {
            $verify = false;
        } else if ($allowVerify && $opcode === Opcodes::OP_CHECKSIGVERIFY) {
            $verify = true;
        } else {
            throw new \InvalidArgumentException('Malformed pay-to-pubkey script - invalid opcode');
        }

        $this->verify = $verify;
        $this->opcode = $opcode;
        $this->publicKey = $publicKey;
    }

    /**
     * @param Operation[] $chunks
     * @param bool $allowVerify
     * @return static
     */
    public static function fromDecodedScript(array $chunks, bool $allowVerify = false): PayToPubkey
    {
        if (count($chunks) !== 2 || !$chunks[0]->isPush() || $chunks[1]->isPush()) {
            throw new \InvalidArgumentException('Malformed pay-to-pubkey script');
        }

        return new PayToPubkey($chunks[1]->getOp(), $chunks[0]->getData(), $allowVerify);
    }

    /**
     * @param ScriptInterface $script
     * @param bool $allowVerify
     * @return PayToPubkey
     */
    public static function fromScript(ScriptInterface $script, bool $allowVerify = false): PayToPubkey
    {
        return static::fromDecodedScript($script->getScriptParser()->decode(), $allowVerify);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return ScriptType::P2PK;
    }

    /**
     * @return int
     */
    public function getRequiredSigCount(): int
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getKeyCount(): int
    {
        return 1;
    }

    /**
     * @return bool
     */
    public function isChecksigVerify(): bool
    {
        return $this->verify;
    }

    /**
     * @param PublicKeyInterface $publicKey
     * @return bool
     */
    public function checkInvolvesKey(PublicKeyInterface $publicKey): bool
    {
        return $publicKey->getBuffer()->equals($this->publicKey);
    }

    /**
     * @return BufferInterface
     */
    public function getKeyBuffer(): BufferInterface
    {
        return $this->publicKey;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         INDX( 	 Uz	�            (   p  �       H                     �    p Z     �    �$&���$&���$&���$&��        �              M u l t i s i g . p h p       �    p `     �    �#$&���J$&���J$&���J$&��       7              P a y T o P u b k e y . p h p �    x h     �    ��$&���d$&���d$&���d$&��       �              P a y T o P u b k e y H a s h . p h p �    p Z     �    �#$&���J$&���J$&���J$&��       7              P A Y T O P ~ 1 . P  P       �    p Z     �    ��$&���d$&���d$&���d$&��       �              P A Y T O P ~ 2 . P H P                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    