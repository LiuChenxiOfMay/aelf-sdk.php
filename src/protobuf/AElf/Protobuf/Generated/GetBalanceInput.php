<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: types.proto

namespace AElf\Protobuf\Generated;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AElf.protobuf.generated.GetBalanceInput</code>
 */
class GetBalanceInput extends \Google\Protobuf\Internal\Message
{
    /**
     * The symbol of token.
     *
     * Generated from protobuf field <code>string symbol = 1;</code>
     */
    protected $symbol = '';
    /**
     * The target address of the query.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address owner = 2;</code>
     */
    protected $owner = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $symbol
     *           The symbol of token.
     *     @type \AElf\Protobuf\Generated\Address $owner
     *           The target address of the query.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Types::initOnce();
        parent::__construct($data);
    }

    /**
     * The symbol of token.
     *
     * Generated from protobuf field <code>string symbol = 1;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * The symbol of token.
     *
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
     * The target address of the query.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address owner = 2;</code>
     * @return \AElf\Protobuf\Generated\Address
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * The target address of the query.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address owner = 2;</code>
     * @param \AElf\Protobuf\Generated\Address $var
     * @return $this
     */
    public function setOwner($var)
    {
        GPBUtil::checkMessage($var, \AElf\Protobuf\Generated\Address::class);
        $this->owner = $var;

        return $this;
    }

}

