<?php

namespace Elliptic;

use \Exception;
use BN\BN;

class Utils
{
    public static function toArray($msg, $enc = false)
    {
        if( is_array($msg) )
            return array_slice($msg, 0);

        if( !$msg )
            return array();

        if( !is_string($msg) )
            throw new Exception("Not implemented");

        if( !$enc )
            return array_slice(unpack("C*", $msg), 0);

        if( $enc === "hex" )
            return array_slice(unpack("C*", hex2bin($msg)), 0);

        return $msg;
    }

    public static function toHex($msg)
    {
        if( is_string($msg) )
            return bin2hex($msg);

        if( !is_array($msg) )
            throw new Exception("Not implemented");

        $binary = call_user_func_array("pack", array_merge(["C*"], $msg)); 
        return bin2hex($binary);
    }

    public static function toBin($msg, $enc = false)
    {
        if( is_array($msg) )
            return call_user_func_array("pack", array_merge(["C*"], $msg)); 

        if( $enc === "hex" )
            return hex2bin($msg);

        return $msg;
    }

    public static function encode($arr, $enc)
    {
        if( $enc === "hex" )
            return self::toHex($arr);
        return $arr;
    }

    // Represent num in a w-NAF form
    public static function getNAF($num, $w)
    {
        $naf = array();
        $ws = 1 << ($w + 1);
        $k = clone($num);

        while( $k->cmpn(1) >= 0 )
        {
            if( !$k->isOdd() )
                array_push($naf, 0);
            else
            {
                $mod = $k->andln($ws - 1);
                $z = $mod;
                if( $mod > (($ws >> 1) - 1))
                    $z = ($ws >> 1) - $mod;
                $k->isubn($z);
                array_push($naf, $z);
            }

            // Optimization, shift by word if possible
            $shift = (!$k->isZero() && $k->andln($ws - 1) === 0) ? ($w + 1) : 1;
            for($i = 1; $i < $shift; $i++)
                array_push($naf, 0);
            $k->iushrn($shift);
        }

        return $naf;
    }

    // Represent k1, k2 in a Joint Sparse Form
    public static function getJSF($k1, $k2)
    {
        $jsf = array( array(), array() );
        $k1 = $k1->_clone();
        $k2 = $k2->_clone();
        $d1 = 0;
        $d2 = 0;

        while( $k1->cmpn(-$d1) > 0 || $k2->cmpn(-$d2) > 0 )
        {
            // First phase
            $m14 = ($k1->andln(3) + $d1) & 3;
            $m24 = ($k2->andln(3) + $d2) & 3;
            if( $m14 === 3 )
                $m14 = -1;
            if( $m24 === 3 )
                $m24 = -1;

            $u1 = 0;
            if( ($m14 & 1) !== 0 )
            {
                $m8 = ($k1->andln(7) + $d1) & 7;
                $u1 = ( ($m8 === 3 || $m8 === 5) && $m24 === 2 ) ? -$m14 : $m14;
            }
            array_push($jsf[0], $u1);

            $u2 = 0;
            if( ($m24 & 1) !== 0 )
            {
                $m8 = ($k2->andln(7) + $d2) & 7;
                $u2 = ( ($m8 === 3 || $m8 === 5) && $m14 === 2 ) ? -$m24 : $m24;
            }
            array_push($jsf[1], $u2);

            // Second phase
            if( (2 * $d1) === ($u1 + 1) )
                $d1 = 1 - $d1;
            if( (2 * $d2) === ($u2 + 1) )
                $d2 = 1 - $d2;
            $k1->iushrn(1);
            $k2->iushrn(1);
        }

        return $jsf;
    }

    public static function intFromLE($bytes) {
        return new BN($bytes, 'hex', 'le');
    }

    public static function parseBytes($bytes) {
        if (is_string($bytes))
            return self::toArray($bytes, 'hex');
        return $bytes;
    }

    public static function randBytes($count)
    {
        $res = "";
        for($i = 0; $i < $count; $i++)
            $res .= chr(rand(0, 255));
        return $res;
    }

    public static function optionAssert(&$array, $key, $value = false, $required = false)
    {
        if( isset($array[$key]) )
            return;
        if( $required )
            throw new Exception("Missing option " . $key);
        $array[$key] = $value;
    }
}

?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php
require_once __DIR__ . "/../vendor/autoload.php";

use BN\BN;

class CurveTest extends PHPUnit_Framework_TestCase {
    public function test_should_work_with_example_curve() {
        $curve = new \Elliptic\Curve\ShortCurve(array(
            "p" => '1d',
            "a" => '4',
            "b" => '14'
        ));

        $p = $curve->point('18', '16');
        $this->assertTrue($p->validate());
        $this->assertTrue($p->dbl()->validate());
        $this->assertTrue($p->dbl()->add($p)->validate());
        $this->assertTrue($p->dbl()->add($p->dbl())->validate());
        $this->assertTrue($p->dbl()->add($p->dbl())->eq($p->add($p)->add($p)->add($p)));
    }

    public function test_should_work_with_secp112k1() {
        $curve = new \Elliptic\Curve\ShortCurve(array(
            "p" => 'db7c 2abf62e3 5e668076 bead208b',
            "a" => 'db7c 2abf62e3 5e668076 bead2088',
            "b" => '659e f8ba0439 16eede89 11702b22'
        ));

        $p = $curve->point(
            '0948 7239995a 5ee76b55 f9c2f098',
            'a89c e5af8724 c0a23e0e 0ff77500');
        $this->assertTrue($p->validate());
        $this->assertTrue($p->dbl()->validate());
    }

    public function test_should_work_with_secp256k1() {
        $curve = new \Elliptic\Curve\ShortCurve(array(
            "p" => 'ffffffff ffffffff ffffffff ffffffff ffffffff ffffffff fffffffe ' .
                   'fffffc2f',
            "a" => '0',
            "b" => '7',
            "n" => 'ffffffff ffffffff ffffffff fffffffe ' .
                   'baaedce6 af48a03b bfd25e8c d0364141',
            "g" => [
                '79be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798',
                '483ada7726a3c4655da4fbfc0e1108a8fd17b448a68554199c47d08ffb10d4b8'
            ]
        ));

        $p = $curve->point(
            '79be667e f9dcbbac 55a06295 ce870b07 029bfcdb 2dce28d9 59f2815b 16f81798',
            '483ada77 26a3c465 5da4fbfc 0e1108a8 fd17b448 a6855419 9c47d08f fb10d4b8'
        );
        $this->assertTrue($p->validate());
        $this->assertTrue($p->dbl()->validate());
        $this->assertTrue($p->toJ()->dbl()->toP()->validate());
        $this->assertTrue($p->mul(new BN('79be667e f9dcbbac 55a06295 ce870b07', 16))->validate());

        $j = $p->toJ();
        $this->assertTrue($j->trpl()->eq($j->dbl()->add($j)));

        // Endomorphism test
        $this->assertNotNull($curve->endo);
        $this->assertEquals(
            $curve->endo["beta"]->fromRed()->toString(16),
            '7ae96a2b657c07106e64479eac3434e99cf0497512f58995c1396c28719501ee');
        $this->assertEquals(
            $curve->endo["lambda"]->toString(16),
            '5363ad4cc05c30e0a5261c028812645a122e22ea20816678df02967c1b23bd72');

        $k = new BN('1234567890123456789012345678901234', 16);
        $split = $curve->_endoSplit($k);

        $testK = $split["k1"]->add($split["k2"]->mul($curve->endo["lambda"]))->umod($curve->n);
        $this->assertEquals($testK->toString(16), $k->toString(16));
    }

    public function test_should_compute_this_problematic_secp256k1_multiplication() {
        $curve = \Elliptic\Curves::getCurve("secp256k1")->curve;
        $g1 = $curve->g; // precomputed g
        $this->assertNotNull($g1->precomputed);
        $g2 = $curve->point($g1->getX(), $g1->getY()); // not precomputed g
        $this->assertNull($g2->precomputed);
        $a = new BN(
            '6d1229a6b24c2e775c062870ad26bc261051e0198c67203167273c7c62538846', 16);
        $p1 = $g1->mul($a);
        $p2 = $g2->mul($a);
        $this->assertTrue($p1->eq($p2));
    }

    public function test_should_not_use_fixed_NAF_when_k_is_too_large() {
        $curve = \Elliptic\Curves::getCurve("secp256k1")->curve;
        $g1 = $curve->g; // precomputed g
        $this->assertNotNull($g1->precomputed);
        $g2 = $curve->point($g1->getX(), $g1->getY()); // not precomputed g
        $this->assertNull($g2->precomputed);

        $a = new BN(
            '6d1229a6b24c2e775c062870ad26bc26' .
            '1051e0198c67203167273c7c6253884612345678',
            16);
        $p1 = $g1->mul($a);
        $p2 = $g2->mul($a);
        $this->assertTrue($p1->eq($p2));
    }

    public function test_should_not_fail_on_secp256k1_regression() {
        $curve = \Elliptic\Curves::getCurve("secp256k1")->curve;
        $k1 = new BN(
            '32efeba414cd0c830aed727749e816a01c471831536fd2fce28c56b54f5a3bb1', 16);
        $k2 = new BN(
            '5f2e49b5d64e53f9811545434706cde4de528af97bfd49fde1f6cf792ee37a8c', 16);

        $p1 = $curve->g->mul($k1);
        $p2 = $curve->g->mul($k2);

        // 2 + 2 + 1 = 2 + 1 + 2
        $two = $p2->dbl();
        $five = $two->dbl()->add($p2);
        $three = $two->add($p2);
        $maybeFive = $three->add($two);

        $this->assertTrue($maybeFive->eq($five));

        $p1 = $p1->mul($k2);
        $p2 = $p2->mul($k1);

        $this->assertTrue($p1->validate());
        $this->assertTrue($p2->validate());
        $this->assertTrue($p1->eq($p2));
    }

    public function test_should_correctly_double_the_affine_point_on_secp256k1() {
        $bad = new ArrayObject(array(
            "x" => '026a2073b1ef6fab47ace18e60e728a05180a82755bbcec9a0abc08ad9f7a3d4',
            "y" => '9cd8cb48c3281596139f147c1364a3ede88d3f310fdb0eb98c924e599ca1b3c9',
            "z" => 'd78587ad45e4102f48b54b5d85598296e069ce6085002e169c6bad78ddc6d9bd'
        ), ArrayObject::ARRAY_AS_PROPS);

        $good = new ArrayObject(array(
            "x" => 'e7789226739ac2eb3c7ccb2a9a910066beeed86cdb4e0f8a7fee8eeb29dc7016',
            "y" => '4b76b191fd6d47d07828ea965e275b76d0e3e0196cd5056d38384fbb819f9fcb',
            "z" => 'cbf8d99056618ba132d6145b904eee1ce566e0feedb9595139c45f84e90cfa7d'
        ), ArrayObject::ARRAY_AS_PROPS);

        $curve = \Elliptic\Curves::getCurve("secp256k1")->curve;
        $bad = $curve->jpoint($bad->x, $bad->y, $bad->z);
        $good = $curve->jpoint($good->x, $good->y, $good->z);

        // They are the same points
        $this->assertTrue($bad->add($good->neg())->isInfinity());

        // But doubling borks them out
        $this->assertTrue($bad->dbl()->add($good->dbl()->neg())->isInfinity());
    }

    public function test_should_store_precomputed_values_correctly_on_negation() {
        $curve = \Elliptic\Curves::getCurve("secp256k1")->curve;
        $p = $curve->g->mul('2');
        $p->precompute();
        $neg = $p->neg(true);
        $neg2 = $neg->neg(true);
        $this->assertTrue($p->eq($neg2));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
require_once __DIR__ . "/../vendor/autoload.php";

class ECDHTest extends PHPUnit_Framework_TestCase {
    public function test_should_work_with_secp256k1_curve() {
        $this->doTest('secp256k1');
    }

    public function test_should_work_with_p256_curve() {
        $this->doTest('p256');
    }

    public function test_should_work_with_curve25519_curve() {
        $this->doTest('curve25519');
    }

    public function test_should_work_with_ed25519_curve() {
        $this->doTest('ed25519');
    }

    function doTest($name) {
        $ecdh = new \Elliptic\EC($name);
        $s1 = $ecdh->genKeyPair();
        $s2 = $ecdh->genKeyPair();
        $sh1 = $s1->derive($s2->getPublic());
        $sh2 = $s2->derive($s1->getPublic());

        $this->assertEquals($sh1->toString(16), $sh2->toString(16));

        $sh1 = $s1->derive($ecdh->keyFromPublic($s2->getPublic('hex'), 'hex')
                ->getPublic());
        $sh2 = $s2->derive($ecdh->keyFromPublic($s1->getPublic('hex'), 'hex')
                ->getPublic());
        $this->assertEquals($sh1->toString(16), $sh2->toString(16));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
require_once __DIR__ . "/../vendor/autoload.php";
use BN\BN;

class ECDSATest extends PHPUnit_Framework_TestCase {

    function ECDSACurveNames() {
        return [
            ['secp256k1']
            , ['ed25519']
            , ['p256']
            , ['p384']
            , ['p521']
        ];
    }

    static $entropy = [
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
        21, 22, 23, 24, 25
    ];

    static $msg = 'deadbeef';

    protected $curve;
    protected $ecdsa;
    protected $keys;

    public function prepare($name) {
        $this->curve = \Elliptic\Curves::getCurve($name);
        $this->assertNotNull($this->curve);

        $this->ecdsa = new \Elliptic\EC($this->curve);
        $this->keys  = $this->ecdsa->genKeyPair([ "entropy" => self::$entropy ]);
        return [$this->curve, $this->ecdsa, $this->keys];
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_generate_proper_key_pair($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $keylen = 64;
        if ($name == 'p384') {
            $keylen = 96;
        } else if ($name == 'p521') {
            $keylen = 132;
        }
        // Get keys out of pair
        $this->assertTrue( $keys->getPublic()->x && $keys->getPublic()->y );
        $this->assertTrue( $keys->getPrivate()->byteLength() > 0);
        $this->assertEquals( strlen($keys->getPrivate('hex')), $keylen);
        $this->assertTrue( strlen($keys->getPublic('hex')) > 0);
        $this->assertTrue( strlen($keys->getPrivate('hex')) > 0);
        $this->assertTrue( $keys->validate()["result"], 'key validate' );
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_sign_and_verify($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $signature = $ecdsa->sign(self::$msg, $keys);
        $this->assertTrue($ecdsa->verify(self::$msg, $signature, $keys), 'Normal verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_sign_and_verify_using_keys_methods($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $signature = $keys->sign(self::$msg);
        $this->assertTrue($keys->verify(self::$msg, $signature), 'On-key verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_load_private_key_from_the_hex_value($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $copy = $ecdsa->keyFromPrivate($keys->getPrivate('hex'), 'hex');
        $signature = $ecdsa->sign(self::$msg, $copy);
        $this->assertTrue($ecdsa->verify(self::$msg, $signature, $copy), 'hex-private verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_have_signature_s_leq_keys_ec_nh($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        // key.sign(msg, options)
        $sign = $keys->sign('deadbeef', [ "canonical" => true ]);
        $this->assertTrue($sign->s->cmp($keys->ec->nh) <= 0);
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_support_options_k($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $sign = $keys->sign(self::$msg, [
            "k" => function($iter) {
                    $this->assertTrue($iter >= 0);
                    return new BN(1358);
                }
            ]);
        $this->assertTrue($ecdsa->verify(self::$msg, $sign, $keys), 'custom-k verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_have_another_signature_with_pers($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $sign1 = $keys->sign(self::$msg);
        $sign2 = $keys->sign(self::$msg, [ "pers" => '1234', "persEnc" => 'hex' ]);
        $this->assertNotEquals($sign1->r->toString('hex') . $sign1->s->toString('hex'),
                $sign2->r->toString('hex') . $sign2->s->toString('hex'));
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_load_public_key_from_compact_hex_value($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $pub = $keys->getPublic(true, 'hex');
        $copy = $ecdsa->keyFromPublic($pub, 'hex');
        $this->assertEquals($copy->getPublic(true, 'hex'), $pub);
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_load_public_key_from_hex_value($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $pub = $keys->getPublic('hex');
        $copy = $ecdsa->keyFromPublic($pub, 'hex');
        $this->assertEquals($copy->getPublic('hex'), $pub);
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_support_hex_DER_encoding_of_signatures($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $signature = $ecdsa->sign(self::$msg, $keys);
        $dsign = $signature->toDER('hex');
        $this->assertTrue($ecdsa->verify(self::$msg, $dsign, $keys), 'hex-DER encoded verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_support_DER_encoding_of_signatures($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $signature = $ecdsa->sign(self::$msg, $keys);
        $dsign = $signature->toDER();
        $this->assertTrue($ecdsa->verify(self::$msg, $dsign, $keys), 'DER encoded verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_not_verify_signature_with_wrong_public_key($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $signature = $ecdsa->sign(self::$msg, $keys);

        $wrong = $ecdsa->genKeyPair();
        $this->assertNotTrue($ecdsa->verify(self::$msg, $signature, $wrong), 'Wrong key verify');
    }

    /**
     * @dataProvider ECDSACurveNames
     */
    public function test_should_not_verify_signature_with_wrong_private_key($name) {
        list($curve, $ecdsa, $keys) = $this->prepare($name);
        $signature = $ecdsa->sign(self::$msg, $keys);

        $wrong = $ecdsa->keyFromPrivate($keys->getPrivate('hex') .
                $keys->getPrivate('hex'), 'hex');
        $this->assertNotTrue($ecdsa->verify(self::$msg, $signature, $wrong), 'Wrong key verify');
    }


    // TODO: Implement RFC6979 vectors test


    function MaxwellsTrickVector() {
        $p256 = \Elliptic\Curves::getCurve("p256");
        $p384 = \Elliptic\Curves::getCurve("p384");
        $msg = 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855';
        return [
          [[
            "curve" => $p256,
            "pub" => '041548fc88953e06cd34d4b300804c5322cb48c24aaaa4d0' .
                     '7a541b0f0ccfeedeb0ae4991b90519ea405588bdf699f5e6' .
                     'd0c6b2d5217a5c16e8371062737aa1dae1',
            "message" => $msg,
            "sig" => '3006020106020104',
            "result" => true
          ]],
          [[
            "curve" => $p256,
            "pub" => '04ad8f60e4ec1ebdb6a260b559cb55b1e9d2c5ddd43a41a2' .
                     'd11b0741ef2567d84e166737664104ebbc337af3d861d352' .
                     '4cfbc761c12edae974a0759750c8324f9a',
            "message" => $msg,
            "sig" => '3006020106020104',
            "result" => true
          ]],
          [[
            "curve" => $p256,
            "pub" => '0445bd879143a64af5746e2e82aa65fd2ea07bba4e355940' .
                     '95a981b59984dacb219d59697387ac721b1f1eccf4b11f43' .
                     'ddc39e8367147abab3084142ed3ea170e4',
            "message" => $msg,
            "sig" => '301502104319055358e8617b0c46353d039cdaae020104',
            "result" => true
          ]],
          [[
            "curve" => $p256,
            "pub" => '040feb5df4cc78b35ec9c180cc0de5842f75f088b4845697' .
                     '8ffa98e716d94883e1e6500b2a1f6c1d9d493428d7ae7d9a' .
                     '8a560fff30a3d14aa160be0c5e7edcd887',
            "message" => $msg,
            "sig" => '301502104319055358e8617b0c46353d039cdaae020104',
            "result" => false
          ]],
          [[
            "curve" => $p384,
            "pub" => '0425e299eea9927b39fa92417705391bf17e8110b4615e9e' .
                     'b5da471b57be0c30e7d89dbdc3e5da4eae029b300344d385' .
                     '1548b59ed8be668813905105e673319d59d32f574e180568' .
                     '463c6186864888f6c0b67b304441f82aab031279e48f047c31',
            "message" => $msg,
            "sig" => '3006020103020104',
            "result" => true
          ]],
          [[
            "curve" => $p384,
            "pub" => '04a328f65c22307188b4af65779c1d2ec821c6748c6bd8dc' .
                     '0e6a008135f048f832df501f7f3f79966b03d5bef2f187ec' .
                     '34d85f6a934af465656fb4eea8dd9176ab80fbb4a27a649f' .
                     '526a7dfe616091b78d293552bc093dfde9b31cae69d51d3afb',
            "message" => $msg,
            "sig" => '3006020103020104',
            "result" => true
          ]],
          [[
            "curve" => $p384,
            "pub" => '04242e8585eaa7a28cc6062cab4c9c5fd536f46b17be1728' .
