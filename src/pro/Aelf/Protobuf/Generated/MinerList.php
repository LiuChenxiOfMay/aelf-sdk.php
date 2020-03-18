<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: types.proto

namespace Aelf\Protobuf\Generated;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>aelf.protobuf.generated.MinerList</code>
 */
class MinerList extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated bytes public_keys = 1;</code>
     */
    private $public_keys;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $public_keys
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Types::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated bytes public_keys = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPublicKeys()
    {
        return $this->public_keys;
    }

    /**
     * Generated from protobuf field <code>repeated bytes public_keys = 1;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPublicKeys($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::BYTES);
        $this->public_keys = $arr;

        return $this;
    }

}
