<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Transaction;

use BitWasp\Bitcoin\Script\ScriptInterface;
use BitWasp\Bitcoin\Serializable;
use BitWasp\Bitcoin\Serializer\Transaction\TransactionOutputSerializer;
use BitWasp\Buffertools\BufferInterface;

class TransactionOutput extends Serializable implements TransactionOutputInterface
{

    /**
     * @var int
     */
    private $value;

    /**
     * @var ScriptInterface
     */
    private $script;

    /**
     * Initialize class
     *
     * @param int $value
     * @param ScriptInterface $script
     */
    public function __construct(int $value, ScriptInterface $script)
    {
        if ($value < 0) {
            throw new \RuntimeException('Transaction output value cannot be negative');
        }
        $this->value = $value;
        $this->script = $script;
    }

    /**
     * {@inheritdoc}
     * @see TransactionOutputInterface::getValue()
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     * @see TransactionOutputInterface::getScript()
     */
    public function getScript(): ScriptInterface
    {
        return $this->script;
    }

    /**
     * {@inheritdoc}
     * @see TransactionOutputInterface::equals()
     */
    public function equals(TransactionOutputInterface $output): bool
    {
        $script = $this->script->equals($output->getScript());
        if (!$script) {
            return false;
        }

        return gmp_cmp($this->value, $output->getValue()) === 0;
    }

    /**
     * {@inheritdoc}
     * @see \BitWasp\Bitcoin\SerializableInterface::getBuffer()
     */
    public function getBuffer(): BufferInterface
    {
        return (new TransactionOutputSerializer())->serialize($this);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Transaction;

use BitWasp\Bitcoin\Script\ScriptInterface;
use BitWasp\Bitcoin\SerializableInterface;

interface TransactionOutputInterface extends SerializableInterface
{
    /**
     * Get the value of this output
     *
     * @return int
     */
    public function getValue(): int;

    /**
     * Get the script for this output
     *
     * @return ScriptInterface
     */
    public function getScript(): ScriptInterface;

    /**
     * @param TransactionOutputInterface $output
     * @return bool
     */
    public function equals(TransactionOutputInterface $output): bool;
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin;

use BitWasp\Bitcoin\Address\AddressInterface;
use BitWasp\Bitcoin\Network\NetworkInterface;

class Uri
{
    const BIP0021 = 0;
    const BIP0072 = 1;

    /**
     * @var AddressInterface
     */
    private $bip21Address;

    /**
     * @var AddressInterface|null
     */
    private $bip72Address;

    /**
     * @var null|string
     */
    private $amount;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $request;

    /**
     * @var int
     */
    private $rule;

    /**
     * Uri constructor.
     * @param AddressInterface|null $address
     * @param int $convention
     */
    public function __construct(AddressInterface $address = null, int $convention = self::BIP0021)
    {
        if ($convention === self::BIP0021) {
            if ($address === null) {
                throw new \InvalidArgumentException('Cannot provide a null address with bip0021');
            }
            $this->bip21Address = $address;
        } else if ($convention === self::BIP0072) {
            $this->bip72Address = $address;
        } else {
            throw new \InvalidArgumentException("Invalid convention for bitcoin uri");
        }

        $this->rule = $convention;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAmountBtc(string $value)
    {
        $this->amount = $value;
        return $this;
    }

    /**
     * @param Amount $amount
     * @param int $value
     * @return $this
     */
    public function setAmount(Amount $amount, int $value)
    {
        $this->amount = $amount->toBtc($value);
        return $this;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setRequestUrl(string $url)
    {
        $this->request = $url;
        return $this;
    }

    /**
     * @param NetworkInterface|null $network
     * @return string
     */
    public function uri(NetworkInterface $network = null): string
    {
        if ($this->rule === self::BIP0072) {
            $address = $this->bip72Address === null ? '' : $this->bip72Address->getAddress($network);
        } else {
            $address = $this->bip21Address->getAddress($network);
        }

        $url = 'bitcoin:' . $address;

        $params = [];
        if (null !== $this->amount) {
            $params['amount'] = $this->amount;
        }

        if (null !== $this->label) {
            $params['label'] = $this->label;
        }

        if (null !== $this->message) {
            $params['message'] = $this->message;
        }

        if (null !== $this->request) {
            $params['r'] = $this->request;
        }

        if (count($params) > 0) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }
}
                                                                                                                                                                                                                                                                                                                  