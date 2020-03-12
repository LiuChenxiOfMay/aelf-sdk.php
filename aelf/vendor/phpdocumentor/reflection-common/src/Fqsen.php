<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/wrappers.proto

namespace Google\Protobuf;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Wrapper message for `uint32`.
 * The JSON representation for `UInt32Value` is JSON number.
 *
 * Generated from protobuf message <code>google.protobuf.UInt32Value</code>
 */
class UInt32Value extends \Google\Protobuf\Internal\Message
{
    /**
     * The uint32 value.
     *
     * Generated from protobuf field <code>uint32 value = 1;</code>
     */
    private $value = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $value
     *           The uint32 value.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Protobuf\Wrappers::initOnce();
        parent::__construct($data);
    }

    /**
     * The uint32 value.
     *
     * Generated from protobuf field <code>uint32 value = 1;</code>
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * The uint32 value.
     *
     * Generated from protobuf field <code>uint32 value = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setValue($var)
    {
        GPBUtil::checkUint32($var);
        $this->value = $var;

        return $this;
    }

}

                                                                                                                                                                                                                                                                                                                                                                                        