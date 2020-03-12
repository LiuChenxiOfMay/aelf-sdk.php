ool
    {
        return $this->compressed;
    }

    /**
     * @return \GMP
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getSecretBinary(): string
    {
        return $this->secretBin;
    }

    /**
     * @return PublicKey
     */
    public function getPublicKey()
    {
        if (null === $this->publicKey) {
            $context = $this->ecAdapter->getContext();
            $publicKey_t = null;
            if (1 !== secp256k1_ec_pubkey_create($context, $publicKey_t, $this->getBinary())) {
                throw new \RuntimeException('Failed to create public key');
            }
            /** @var resource $publicKey_t */
            $this->publicKey = new PublicKey($this->ecAdapter, $publicKey_t, $this->compressed);
        }

        return $this->publicKey;
    }

    /**
     * @param \GMP $tweak
     * @return KeyInterface
     */
    public function tweakAdd(\GMP $tweak): KeyInterface
    {
        $adapter = $this->ecAdapter;
        $math = $adapter->getMath();
        $context = $adapter->getContext();
        $privateKey = $this->getBinary(); // mod by reference
        $tweak = Buffer::int($math->toString($tweak), 32)->getBinary();
        $ret = \secp256k1_ec_privkey_tweak_add(
            $context,
            $privateKey,
            $tweak
        );

        if ($ret !== 1) {
            throw new \RuntimeException('Secp256k1 privkey tweak add: failed');
        }

        $secret = new Buffer($privateKey);
        return $adapter->getPrivateKey($secret->getGmp(), $this->compressed);
    }

    /**
     * @param \GMP $tweak
     * @return KeyInterface
     */
    public function tweakMul(\GMP $tweak): KeyInterface
    {
        $privateKey = $this->getBinary();
        $math = $this->ecAdapter->getMath();
        $tweak = Buffer::int($math->toString($tweak), 32)->getBinary();
        $ret = \secp256k1_ec_privkey_tweak_mul(
            $this->ecAdapter->getContext(),
            $privateKey,
            $tweak
        );

        if ($ret !== 1) {
            throw new \RuntimeException('Secp256k1 privkey tweak mul: failed');
        }

        $secret = new Buffer($privateKey);

        return $this->ecAdapter->getPrivateKey($secret->getGmp(), $this->compressed);
    }

    /**
     * @param NetworkInterface $network
     * @return string
     */
    public function toWif(NetworkInterface $network = null): string
    {
        $network = $network ?: Bitcoin::getNetwork();
        $wifSerializer = new WifPrivateKeySerializer(new PrivateKeySerializer($this->ecAdapter));
        return $wifSerializer->serialize($network, $this);
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new PrivateKeySerializer($this->ecAdapter))->serialize($this);
    }
}
                                                                           