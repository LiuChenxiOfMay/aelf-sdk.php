   {
        $this->cswapValue($a->x, $b->x, $cond, $curveSize);
        $this->cswapValue($a->y, $b->y, $cond, $curveSize);
        $this->cswapValue($a->order, $b->order, $cond, $curveSize);
        $this->cswapValue($a->infinity, $b->infinity, $cond, 8);
    }

    /**
     * @param bool|\GMP $a
     * @param bool|\GMP $b
     * @param int $cond
     * @param int $maskBitSize
     */
    public function cswapValue(& $a, & $b, int $cond, int $maskBitSize)
    {
        $isGMP = is_object($a) && $a instanceof \GMP;

        $sa = $isGMP ? $a : gmp_init(intval($a), 10);
        $sb = $isGMP ? $b : gmp_init(intval($b), 10);

        $mask = str_pad('', $maskBitSize, (string) (1 - intval($cond)), STR_PAD_LEFT);
        $mask = gmp_init($mask, 2);

        $taA = $this->adapter->bitwiseAnd($sa, $mask);
        $taB = $this->adapter->bitwiseAnd($sb, $mask);

        $sa = $this->adapter->bitwiseXor($this->adapter->bitwiseXor($sa, $sb), $taB);
        $sb = $this->adapter->bitwiseXor($this->adapter->bitwiseXor($sa, $sb), $taA);
        $sa = $this->adapter->bitwiseXor($this->adapter->bitwiseXor($sa, $sb), $taB);

        $a = $isGMP ? $sa : (bool) gmp_strval($sa, 10);
        $b = $isGMP ? $sb : (bool) gmp_strval($sb, 10);
    }

    /**
     *
     */
    private function validate()
    {
        if (! $this->infinity && ! $this->curve->contains($this->x, $this->y)) {
            throw new \RuntimeException('Invalid point');
        }
    }

    /**
     * {@inheritDoc}
     * @see \Mdanter\Ecc\Primitives\PointInterface::getDouble()
     * @return self
     */
    public function getDouble(): PointInterface
    {
        if ($this->isInfinity()) {
            return $this->curve->getInfinity();
        }

        $math = $this->adapter;
        $modMath = $this->modAdapter;

        $a = $this->curve->getA();
        $threeX2 = $math->mul(gmp_init(3, 10), $math->pow($this->x, 2));

        $tangent = $modMath->div(
            $math->add($threeX2, $a),
            $math->mul(gmp_init(2, 10), $this->y)
        );

        $x3 = $modMath->sub(
            $math->pow($tangent, 2),
            $math->mul(gmp_init(2, 10), $this->x)
        );

        $y3 = $modMath->sub(
            $math->mul($tangent, $math->sub($this->x, $x3)),
            $this->y
        );

        return $this->curve->getPoint($x3, $y3, $this->order);
    }

    /**
     * {@inheritDoc}
     * @see \Mdanter\Ecc\Primitives\PointInterface::__toString()
     */
    public function __toString(): string
    {
        if ($this->infinity) {
            return '[ (infinity) on ' . (string) $this->curve . ' ]';
        }

        return "[ (" . $this->adapter->toString($this->x) . "," . $this->adapter->toString($this->y) . ') on ' . (string) $this->curve . ' ]';
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        $info = [
            'x' => $this->adapter->toString($this->x),
            'y' => $this->adapter->toString($this->y),
            'z' => $this->adapter->toString($this->order),
            'curve' => $this->curve
        ];

        if ($this->infinity) {
            $info['x'] = 'inf (' . $info['x'] . ')';
            $info['y'] = 'inf (' . $info['y'] . ')';
            $info['z'] = 'inf (' . $info['z'] . ')';
        }

        return $info;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
## Implemented BIPs

This page lists BIPs implemented by the core library.
 
Some BIPs are specific to the network layer - for these see [Bitcoin P2P](https://github.com/Bit-Wasp/bitcoin-p2p-php)

  - [BIP 11](https://github.com/bitcoin/bips/blob/master/bip-0011.mediawiki) - M of N standard transactions
  - [BIP 13](https://github.com/bitcoin/bips/blob/master/bip-0013.mediawiki) - Pay to Script Hash address format
  - [BIP 14](https://github.com/bitcoin/bips/blob/master/bip-0014.mediawiki) - Protocol Version and User Agent
  - [BIP 16](https://github.com/bitcoin/bips/blob/master/bip-0016.mediawiki) - Pay to Script Hash
  - [BIP 21](https://github.com/bitcoin/bips/blob/master/bip-0021.mediawiki) - Bitcoin URI's
  - [BIP 32](https://github.com/bitcoin/bips/blob/master/bip-0032.mediawiki) - Hierarchical Deterministic Wallets
  - [BIP 37](https://github.com/bitcoin/bips/blob/master/bip-0037.mediawiki) - Bloom Filtering
  - [BIP 39](https://github.com/bitcoin/bips/blob/master/bip-0039.mediawiki) - Mnemonic code for generating deterministic keys
  - [BIP 65](https://github.com/bitcoin/bips/blob/master/bip-0065.mediawiki) - OP_CHECKLOCKTIMEVERIFY
  - [BIP 66](https://github.com/bitcoin/bips/blob/master/bip-0066.mediawiki) - Strict DER Signatures
  - [BIP 67](https://github.com/bitcoin/bips/blob/master/bip-0067.mediawiki) - Deterministic P2SH multi-signature addresses
  - [BIP 69](https://github.com/bitcoin/bips/blob/master/bip-0069.mediawiki) - Lexicographical Indexing of Transaction Inputs and Outputs
  - [BIP 70](https://github.com/bitcoin/bips/blob/master/bip-0070.mediawiki) - Payment Protocol
  - [BIP 72](https://github.com/bitcoin/bips/blob/master/bip-0072.mediawiki) - Payment protocol URIs
  - [BIP 112](https://github.com/bitcoin/bips/blob/master/bip-0112.mediawiki) - OP_CHECKSEQUENCEVERIFY
  - [BIP 141](https://github.com/bitcoin/bips/blob/master/bip-0141.mediawiki) - Segregated Witness (Consensus layer)
  - [BIP 143](https://github.com/bitcoin/bips/blob/master/bip-0143.mediawiki) - Transaction Signature Verification for Version 0 Witness Program
  - [BIP 146](https://github.com/bitcoin/bips/blob/master/bip-0146.mediawiki) - Dealing w