ion tweakAdd(\GMP $tweak): KeyInterface
    {
        $context = $this->ecAdapter->getContext();
        $bin = Buffer::int(gmp_strval($tweak, 10), 32)->getBinary();

        $clone = $this->clonePubkey();
        if (1 !== secp256k1_ec_pubkey_tweak_add($context, $clone, $bin)) {
            throw new \RuntimeException('Secp256k1: tweak add failed.');
        }

        return new PublicKey($this->ecAdapter, $clone, $this->compressed);
    }

    /**
     * @param \GMP $tweak
     * @return KeyInterface
     * @throws \Exception
     */
    public function tweakMul(\GMP $tweak): KeyInterface
    {
        $context = $this->ecAdapter->getContext();
        $bin = Buffer::int(gmp_strval($tweak, 10), 32)->getBinary();

        $clone = $this->clonePubkey();
        if (1 !== secp256k1_ec_pubkey_tweak_mul($context, $clone, $bin)) {
            throw new \RuntimeException('Secp256k1: tweak mul failed.');
        }

        return new PublicKey($this->ecAdapter, $clone, $this->compressed);
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new PublicKeySerializer($this->ecAdapter))->serialize($this);
    }
}
                                                                                                                                                                                                               