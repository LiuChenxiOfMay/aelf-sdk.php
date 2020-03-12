ned for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }

    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Kind::class, \Google\Protobuf\Field_Kind::class);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

// Protocol Buffers - Google's data interchange format
// Copyright 2017 Google Inc.  All rights reserved.
// https://developers.google.com/protocol-buffers/
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions are
// met:
//
//     * Redistributions of source code must retain the above copyright
// notice, this list of conditions and the following disclaimer.
//     * Redistributions in binary form must reproduce the above
// copyright notice, this list of conditions and the following disclaimer
// in the documentation and/or other materials provided with the
// distribution.
//     * Neither the name of Google Inc. nor the names of its
// contributors may be used to endorse or promote products derived from
// this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
// "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
// LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
// A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
// OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
// LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
// DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
// THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
// (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
// OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

namespace Google\Protobuf;

use Google\Protobuf\Internal\GetPublicDescriptorTrait;
use Google\Protobuf\Internal\GPBType;

class FieldDescriptor
{
    use GetPublicDescriptorTrait;

    private $internal_desc;

    /**
     * @internal
     */
    public function __construct($internal_desc)
    {
        $this->internal_desc = $internal_desc;
    }

    /**
     * @return string Field name
     */
    public function getName()
    {
        return $this->internal_desc->getName();
    }

    /**
     * @return int Protobuf field number
     */
    public function getNumber()
    {
        return $this->internal_desc->getNumber();
    }

    /**
     * @return int
     */
    public function getLabel()
    {
        return $this->internal_desc->getLabel();
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->internal_desc->getType();
    }

    /**
     * @return Descriptor Returns a descriptor for the field type if the field type is a message, otherwise throws \Exception
     * @throws \Exception
     */
    public function getMessageType()
    {
        if ($this->getType() == GPBType::MESSAGE) {
            return $this->getPublicDescriptor($this->internal_desc->getMessageType());
        } else {
            throw new \Exception("Cannot get message type for non-message field '" . $this->getName() . "'");
        }
    }

    /**
     * @return EnumDescriptor Returns an enum descriptor if the field type is an enum, otherwise throws \Exception
     * @throws \Exception
     */
    public function getEnumType()
    {
        if ($this->getType() == GPBType::ENUM) {
            return $this->getPublicDescriptor($this->internal_desc->getEnumType());
        } else {
            throw new \Exception("Cannot get enum type for non-enum field '" . $this->getName() . "'");
        }
    }

    /**
     * @return boolean
     */
    public function isMap()
    {
        return $this->internal_desc->isMap();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/wrappers.proto

namespace Google\Protobuf;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Wrapper message for `float`.
 * The JSON representation for `FloatValue` is JSON number.
 *
 * Generated from protobuf message <code>google.protobuf.FloatValue</code>
 */
class FloatValue extends \Google\Protobuf\Internal\Message
{
    /**
     * The float value.
     *
     * Generated from protobuf field <code>float value = 1;</code>
     */
    private $value = 0.0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type float $value
     *           The float value.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Protobuf\Wrappers::initOnce();
        parent::__construct($data);
    }

    /**
     * The float value.
     *
     * Generated from protobuf field <code>float value = 1;</code>
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * The float value.
     *
     * Generated from protobuf field <code>float value = 1;</code>
     * @param float $var
     * @retu