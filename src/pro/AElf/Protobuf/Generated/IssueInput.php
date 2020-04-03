<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: types.proto

namespace AElf\Protobuf\Generated;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AElf.protobuf.generated.IssueInput</code>
 */
class IssueInput extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string symbol = 1;</code>
     */
    protected $symbol = '';
    /**
     * Generated from protobuf field <code>sint64 amount = 2;</code>
     */
    protected $amount = 0;
    /**
     * Generated from protobuf field <code>string memo = 3;</code>
     */
    protected $memo = '';
    /**
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address to = 4;</code>
     */
    protected $to = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $symbol
     *     @type int|string $amount
     *     @type string $memo
     *     @type \AElf\Protobuf\Generated\Address $to
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Types::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string symbol = 1;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Generated from protobuf field <code>string symbol = 1;</code>
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
     * Generated from protobuf field <code>sint64 amount = 2;</code>
     * @return int|string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Generated from protobuf field <code>sint64 amount = 2;</code>
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
     * Generated from protobuf field <code>string memo = 3;</code>
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Generated from protobuf field <code>string memo = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setMemo($var)
    {
        GPBUtil::checkString($var, True);
        $this->memo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address to = 4;</code>
     * @return \AElf\Protobuf\Generated\Address
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address to = 4;</code>
     * @param \AElf\Protobuf\Generated\Address $var
     * @return $this
     */
    public function setTo($var)
    {
        GPBUtil::checkMessage($var, \AElf\Protobuf\Generated\Address::class);
        $this->to = $var;

        return $this;
    }

}
