<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Address;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Network\NetworkInterface;
use BitWasp\Bitcoin\Script\ScriptInterface;
use BitWasp\Bitcoin\Script\WitnessProgram;

class SegwitAddress extends Address implements Bech32AddressInterface
{
    /**
     * @var WitnessProgram
     */
    protected $witnessProgram;

    /**
     * SegwitAddress constructor.
     * @param WitnessProgram $witnessProgram
     */
    public function __construct(WitnessProgram $witnessProgram)
    {
        $this->witnessProgram = $witnessProgram;

        parent::__construct($witnessProgram->getProgram());
    }

    /**
     * @param NetworkInterface|null $network
     * @return string
     */
    public function getHRP(NetworkInterface $network = null): string
    {
        $network = $network ?: Bitcoin::getNetwork();
        return $network->getSegwitBech32Prefix();
    }

    /**
     * @return WitnessProgram
     */
    public function getWitnessProgram(): WitnessProgram
    {
        return $this->witnessProgram;
    }

    /**
     * @return ScriptInterface
     */
    public function getScriptPubKey(): ScriptInterface
    {
        return $this->witnessProgram->getScript();
    }

    /**
     * @param NetworkInterface|null $network
     * @return string
     */
    public function getAddress(NetworkInterface $network = null): string
    {
        $network = $network ?: Bitcoin::getNetwork();

        return \BitWasp\Bech32\encodeSegwit($network->getSegwitBech32Prefix(), $this->witnessProgram->getVersion(), $this->witnessProgram->getProgram()->getBinary());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin;

use BitWasp\Bitcoin\Crypto\Hash;
use BitWasp\Bitcoin\Exceptions\Base58ChecksumFailure;
use BitWasp\Bitcoin\Exceptions\Base58InvalidCharacter;
use BitWasp\Buffertools\Buffer;
use BitWasp\Buffertools\BufferInterface;
use BitWasp\Buffertools\Buffertools;

class Base58
{
    /**
     * @var string
     */
    private static $base58chars = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';

    /**
     * Encode a given hex string in base58
     *
     * @param BufferInterface $buffer
     * @return string
     */
    public static function encode(BufferInterface $buffer): string
    {
        $size = $buffer->getSize();
        if ($size === 0) {
            return '';
        }

        $orig = $buffer->getBinary();
        $decimal = $buffer->getGmp();

        $return = '';
        $zero = gmp_init(0);
        $_58 = gmp_init(58);
        while (gmp_cmp($decimal, $zero) > 0) {
            $div = gmp_div($decimal, $_58);
            $rem = gmp_sub($decimal, gmp_mul($div, $_58));
            $return .= self::$base58chars[(int) gmp_strval($rem, 10)];
            $decimal = $div;
        }
        $return = strrev($return);

        // Leading zeros
        for ($i = 0; $i < $size && $orig[$i] === "\x00"; $i++) {
          