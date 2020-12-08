<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: types.proto

namespace AElf\Protobuf\Generated;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AElf.protobuf.generated.ContractUpdateInput</code>
 */
class ContractUpdateInput extends \Google\Protobuf\Internal\Message
{
    /**
     * The contract address that needs to be updated.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address address = 1;</code>
     */
    protected $address = null;
    /**
     * The byte array of the new contract code.
     *
     * Generated from protobuf field <code>bytes code = 2;</code>
     */
    protected $code = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \AElf\Protobuf\Generated\Address $address
     *           The contract address that needs to be updated.
     *     @type string $code
     *           The byte array of the new contract code.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Types::initOnce();
        parent::__construct($data);
    }

    /**
     * The contract address that needs to be updated.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address address = 1;</code>
     * @return \AElf\Protobuf\Generated\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * The contract address that needs to be updated.
     *
     * Generated from protobuf field <code>.AElf.protobuf.generated.Address address = 1;</code>
     * @param \AElf\Protobuf\Generated\Address $var
     * @return $this
     */
    public function setAddress($var)
    {
        GPBUtil::checkMessage($var, \AElf\Protobuf\Generated\Address::class);
        $this->address = $var;

        return $this;
    }

    /**
     * The byte array of the new contract code.
     *
     * Generated from protobuf field <code>bytes code = 2;</code>
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * The byte array of the new contract code.
     *
     * Generated from protobuf field <code>bytes code = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCode($var)
    {
        GPBUtil::checkString($var, False);
        $this->code = $var;

        return $this;
    }

}

