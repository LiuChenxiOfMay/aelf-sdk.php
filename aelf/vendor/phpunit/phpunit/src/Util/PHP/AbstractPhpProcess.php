<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Crypto\EcAdapter\Impl\Secp256k1\Signature;

use BitWasp\Bitcoin\Crypto\EcAdapter\Impl\Secp256k1\Adapter\EcAdapter;
use BitWasp\Bitcoin\Crypto\EcAdapter\Impl\Secp256k1\Serializer\Signature\DerSignatureSerializer;
use BitWasp\Bitcoin\Crypto\EcAdapter\Signature\SignatureInterface;
use BitWasp\Bitcoin\Serializable;
use BitWasp\Buffertools\BufferInterface;

class Signature extends Serializable implements SignatureInterface
{
    /**
     * @var \GMP
     */
    private $r;

    /**
     * @var  \GMP
     */
    private $s;

    /**
     * @var EcAdapter
     */
    private $ecAdapter;

    /**
     * @var resource
     */
    private $secp256k1_sig;

    /**
     * @param EcAdapter $adapter
     * @param \GMP $r
     * @param \GMP $s
     * @param resource $secp256k1_ecdsa_signature_t
     */
    public function __construct(EcAdapter $adapter, \GMP $r, \GMP $s, $secp256k1_ecdsa_signature_t)
    {
        if (!is_resource($secp256k1_ecdsa_signature_t) ||
            !get_resource_type($secp256k1_ecdsa_signature_t) === SECP256K1_TYPE_SIG
        ) {
            throw new \InvalidArgumentException('Secp256k1\Signature\Signature expects ' . SECP256K1_TYPE_SIG . ' resource');
        }

        $this->secp256k1_sig = $secp256k1_ecdsa_signature_t;
        $this->ecAdapter = $adapter;
        $this->r = $r;
        $this->s = $s;
    }

    /**
     * @return \GMP
     */
    public function getR()
    {
        return $this->r;
    }

    /**
     * @return \GMP
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->secp256k1_sig;
    }

    /**
     * @param Signature $other
     * @return bool
     */
    private function doEquals(Signature $other): bool
    {
        $a = '';
        $b = '';
        secp256k1_ecdsa_signature_serialize_der($this->ecAdapter->getContext(), $a, $this->getResource());
        secp256k1_ecdsa_signature_serialize_der($this->ecAdapter->getContext(), $b, $other->getResource());

        return hash_equals($a, $b);
    }

    /**
     * @param SignatureInterface $signature
     * @return bool
     */
    public function equals(SignatureInterface $signature): bool
    {
        /** @var Signature $signature */
        return $this->doEquals($signature);
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new DerSignatureSerializer($this->ecAdapter))->serialize($this);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Crypto\EcAdapter\Key;

use BitWasp\Bitcoin\Crypto\EcAdapter\Serializer\Key\PublicKeySerializerInterface;
use BitWasp\Bitcoin\Crypto\Hash;
use BitWasp\Bitcoin\Serializable;
use BitWasp\Buffertools\BufferInterface;

abstract class Key extends Serializable implements KeyInterface
{
    /**
     * @var BufferInterface
     */
    protected $pubKeyHash;

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this instanceof PrivateKeyInterface;
    }

    /**
     * @param PublicKeySerializerInterface|null $serializer
     * @return \BitWasp\Buffertools\BufferInterface
     */
    public function getPubKeyHash(PublicKeySerializerInterface $serializer = null): BufferInterface
    {
        if ($this instanceof PrivateKeyInterface) {
            $publicKey = $this->getPublicKey();
        } else {
            $publicKey = $this;
        }

        if (null === $this->pubKeyHash) {
            $this->pubKeyHash = Hash::sha256ripe160($serializer ? $serializer->serialize($publicKey) : $publicKey->getBuffer());
        }

        return $this->pubKeyHash;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Crypto\EcAdapter\Key;

use BitWasp\Bitcoin\Crypto\EcAdapter\Serializer\Key\PublicKeySerializerInterface;
use BitWasp\Bitcoin\SerializableInterface;
use BitWasp\Buffertools\BufferInterface;

interface KeyInterface extends SerializableInterface
{
    /**
     * Check if the key should be be using compressed format
     *
     * @return bool
     */
    public function isCompressed(): bool;

    /**
     * Return a boolean indicating whether the key is private.
     *
     * @return bool
     */
    public function isPrivate(): bool;

    /**
     * Return the hash of the public key.
     *
     * @param PublicKeySerializerInterface|null $serializer
     * @return BufferInterface
     */
    public function getPubKeyHash(PublicKeySerializerInterface $serializer = null): BufferInterface;

    /**
     * @param \GMP $offset
     * @return KeyInterface
     */
    public function tweakAdd(\GMP $offset): KeyInterface;

    /**
     * @param \GMP $offset
     * @return KeyInterface
     */
    public function tweakMul(\GMP $offset): KeyInterface;

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface;
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          