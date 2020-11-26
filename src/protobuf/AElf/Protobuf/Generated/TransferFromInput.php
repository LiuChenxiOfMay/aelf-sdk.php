<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: types.proto

namespace AElf\Protobuf\Generated;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AElf.protobuf.generated.TransferFromInput</code>
 */
class TransferFromInput extends \Google\Protobuf\Internal\Message
{
    /**
     * The source address of the token.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address from = 1;</code>
     */
    protected $from = null;
    /**
     * The destination address of the token.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address to = 2;</code>
     */
    protected $to = null;
    /**
     * The symbol of the token to transfer.
     *
     * Generated from protobuf field <code>string symbol = 3;</code>
     */
    protected $symbol = '';
    /**
     * The amount to transfer.
     *
     * Generated from protobuf field <code>int64 amount = 4;</code>
     */
    protected $amount = 0;
    /**
     * The memo.
     *
     * Generated from protobuf field <code>string memo = 5;</code>
     */
    protected $memo = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \AElf\Protobuf\Generated\Address $from
     *           The source address of the token.
     *     @type \AElf\Protobuf\Generated\Address $to
     *           The destination address of the token.
     *     @type string $symbol
     *           The symbol of the token to transfer.
     *     @type int|string $amount
     *           The amount to transfer.
     *     @type string $memo
     *           The memo.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Types::initOnce();
        parent::__construct($data);
    }

    /**
     * The source address of the token.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address from = 1;</code>
     * @return \AElf\Protobuf\Generated\Address
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * The source address of the token.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address from = 1;</code>
     * @param \AElf\Protobuf\Generated\Address $var
     * @return $this
     */
    public function setFrom($var)
    {
        GPBUtil::checkMessage($var, \AElf\Protobuf\Generated\Address::class);
        $this->from = $var;

        return $this;
    }

    /**
     * The destination address of the token.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address to = 2;</code>
     * @return \AElf\Protobuf\Generated\Address
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * The destination address of the token.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address to = 2;</code>
     * @param \AElf\Protobuf\Generated\Address $var
     * @return $this
     */
    public function setTo($var)
    {
        GPBUtil::checkMessage($var, \AElf\Protobuf\Generated\Address::class);
        $this->to = $var;

        return $this;
    }

    /**
     * The symbol of the token to transfer.
     *
     * Generated from protobuf field <code>string symbol = 3;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * The symbol of the token to transfer.
     *
     * Generated from protobuf field <code>string symbol = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setSymbol($var)
    {
        GPBUtil::checkString($var, True);
        $this->symbol = $var;

        return $this;
    }

    /**
     * The amount to transfer.
     *
     * Generated from protobuf field <code>int64 amount = 4;</code>
     * @return int|string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * The amount to transfer.
     *
     * Generated from protobuf field <code>int64 amount = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setAmount($var)
    {
        GPBUtil::checkInt64($var);
        $this->amount = $var;

        return $this;
    }

    /**
     * The memo.
     *
     * Generated from protobuf field <code>string memo = 5;</code>
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * The memo.
     *
     * Generated from protobuf field <code>string memo = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setMemo($var)
    {
        GPBUtil::checkString($var, True);
        $this->memo = $var;

        return $this;
    }

}

