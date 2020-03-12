 key recovery param by trial and error
     *
     * @param \GMP $r
     * @param \GMP $s
     * @param BufferInterface $messageHash
     * @param PublicKey $publicKey
     * @return int
     * @throws \Exception
     */
    public function calcPubKeyRecoveryParam(\GMP $r, \GMP $s, BufferInterface $messageHash, PublicKey $publicKey): int
    {
        $Q = $publicKey->getPoint();
        for ($i = 0; $i < 4; $i++) {
            try {
                $recover = $this->recover($messageHash, new CompactSignature($this, $r, $s, $i, $publicKey->isCompressed()));
                if ($Q->equals($recover->getPoint())) {
                    return $i;
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        throw new \Exception('Failed to find valid recovery factor');
    }

    /**
     * @param BufferInterface $privateKey
     * @return bool
     */
    public function validatePrivateKey(BufferInterface $privateKey): bool
    {
        $math = $this->math;
        $scalar = $privateKey->getGmp();
        return $math->cmp($scalar, gmp_init(0)) > 0 && $math->cmp($scalar, $this->getOrder()) < 0;
    }

    /**
     * @param \GMP $element
     * @param bool $half
     * @return bool
     */
    public function validateSignatureElement(\GMP $element, bool $half = false): bool
    {
        $math = $this->getMath();
        $against = $this->getOrder();
        if ($half) {
            $against = $math->rightShift($against, 1);
        }

        return $math->cmp($element, $against) < 0 && $math->cmp($element, gmp_init(0)) !== 0;
    }

    /**
     * @param BufferInterface $publicKey
     * @return PublicKeyInterface
     * @throws \Exception
     */
    public function publicKeyFromBuffer(BufferInterface $publicKey): PublicKeyInterface
    {
        $prefix = $publicKey->slice(0, 1)->getBinary();
        $size = $publicKey->getSize();
        $compressed = false;
        if ($prefix === PublicKey::KEY_UNCOMPRESSED || $prefix === "\x06" || $prefix === "\x07") {
            if ($size !== PublicKey::LENGTH_UNCOMPRESSED) {
                throw new \Exception('Invalid length for uncompressed key');
            }
        } else if ($prefix === PublicKey::KEY_COMPRESSED_EVEN || $prefix === PublicKey::KEY_COMPRESSED_ODD) {
            if ($size !== PublicKey::LENGTH_COMPRESSED) {
                throw new \Exception('Invalid length for compressed key');
            }
            $compressed = true;
        } else {
            throw new \Exception('Unknown public key prefix');
        }
        
        $x = $publicKey->slice(1, 32)->getGmp();
        $curve = $this->generator->getCurve();
        $y = $compressed
            ? $curve->recoverYfromX($prefix === PublicKey::KEY_COMPRESSED_ODD, $x)
            : $publicKey->slice(33, 32)->getGmp();

        return new PublicKey(
            $this,
            $curve->getPoint($x, $y),
            $compressed,
            $prefix
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  