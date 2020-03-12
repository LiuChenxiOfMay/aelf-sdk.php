<?php

// Protocol Buffers - Google's data interchange format
// Copyright 2008 Google Inc.  All rights reserved.
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

/**
 * MapField and MapFieldIter are used by generated protocol message classes to
 * manipulate map fields.
 */

namespace Google\Protobuf\Internal;

/**
 * MapFieldIter is used to iterate MapField. It is also need for the foreach
 * syntax.
 */
class MapFieldIter implements \Iterator
{

    /**
     * @ignore
     */
    private $container;

    /**
     * Create iterator instance for MapField.
     *
     * @param MapField The MapField instance for which this iterator is
     * created.
     * @param GPBType Map key type.
     * @ignore
     */
    public function __construct($container, $key_type)
    {
        $this->container = $container;
        $this->key_type = $key_type;
    }

    /**
     * Reset the status of the iterator
     *
     * @return void
     */
    public function rewind()
    {
        return reset($this->container);
    }

    /**
     * Return the element at the current position.
     *
     * @return object The element at the current position.
     */
    public function current()
    {
        return current($this->container);
    }

    /**
     * Return the current key.
     *
     * @return object The current key.
     */
    public function key()
    {
        $key = key($this->container);
        switch ($this->key_type) {
            case GPBType::INT64:
            case GPBType::UINT64:
            case GPBType::FIXED64:
            case GPBType::SFIXED64:
            case GPBType::SINT64:
                if (PHP_INT_SIZE === 8) {
                    return $key;
                }
                // Intentionally fall through
            case GPBType::STRING:
                // PHP associative array stores int string as int for key.
                return strval($key);
            case GPBType::BOOL:
                // PHP associative array stores bool as integer for key.
                return boolval($key);
            default:
                return $key;
        }
    }

    /**
     * Move to the next position.
     *
     * @return void
     */
    public function next()
    {
        return next($this->container);
    }

    /**
     * Check whether there are more elements to iterate.
     *
     * @return bool True if there are more elements to iterate.
     */
    public function valid()
    {
        return key($this->container) !== null;
    }
}
                                                                                              <?php

// Protocol Buffers - Google's data interchange format
// Copyright 2008 Google Inc.  All rights reserved.
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

/**
 * Defines Message, the parent class extended by all protocol message classes.
 */

namespace Google\Protobuf\Internal;

use Google\Protobuf\Internal\CodedInputStream;
use Google\Protobuf\Internal\CodedOutputStream;
use Google\Protobuf\Internal\DescriptorPool;
use Google\Protobuf\Internal\GPBLabel;
use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\GPBWire;
use Google\Protobuf\Internal\MapEntry;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\ListValue;
use Google\Protobuf\Value;
use Google\Protobuf\Struct;
use Google\Protobuf\NullValue;

/**
 * Parent class of all proto messages. Users should not instantiate this class
 * or extend this class or its child classes by their own.  See the comment of
 * specific functions for more details.
 */
class Message
{

    /**
     * @ignore
     */
    private $desc;
    private $unknown = "";

    /**
     * @ignore
     */
    public function __construct($data = NULL)
    {
        // MapEntry message is shared by all types of map fields, whose
        // descriptors are different from each other. Thus, we cannot find a
        // specific descriptor from the descriptor pool.
        if ($this instanceof MapEntry) {
            $this->initWithDescriptor($data);
        } else {
            $this->initWithGeneratedPool();
            if (is_array($data)) {
                $this->mergeFromArray($data);
            } else if (!empty($data)) {
                throw new \InvalidArgumentException(
                    'Message constructor must be an array or null.'
                );
            }
        }
    }

    /**
     * @ignore
     */
    private function initWithGeneratedPool()
    {
        $pool = DescriptorPool::getGeneratedPool();
        $this->desc = $pool->getDescriptorByClassName(get_class($this));
        if (is_null($this->desc)) {
            user_error(get_class($this) . " is not found in descriptor pool.");
            return;
        }
        foreach ($this->desc->getField() as $field) {
            $setter = $field->getSetter();
            if ($field->isMap()) {
                $message_type = $field->getMessageType();
                $key_field = $message_type->getFieldByNumber(1);
                $value_field = $message_type->getFieldByNumber(2);
                switch ($value_field->getType()) {
                    case GPBType::MESSAGE:
                    case GPBType::GROUP:
                        $map_field = new MapField(
                            $key_field->getType(),
                            $value_field->getType(),
                            $value_field->getMessageType()->getClass());
                        $this->$setter($map_field);
                        break;
                    case GPBType::ENUM:
                        $map_field = new MapField(
                            $key_field->getType(),
                            $value_field->getType(),
                            $value_field->getEnumType()->getClass());
                        $this->$setter($map_field);
                        break;
                    default:
                        $map_field = new MapField(
                            $key_field->getType(),
                            $value_field->getType());
                        $this->$setter($map_field);
                        break;
                }
            } else if ($field->getLabel() === GPBLabel::REPEATED) {
                switch ($field->getType()) {
                    case GPBType::MESSAGE:
                    case GPBType::GROUP:
                        $repeated_field = new RepeatedField(
                            $field->getType(),
                            $field->getMessageType()->getClass());
                        $this->$setter($repeated_field);
                        break;
                    case GPBType::ENUM:
                        $repeated_field = new RepeatedField(
                            $field->getType(),
                            $field->getEnumType()->getClass());
                        $this->$setter($repeated_field);
                        break;
                    default:
                        $repeated_field = new RepeatedField($field->getType());
                        $this->$setter($repeated_field);
                        break;
                }
            } else if ($field->getOneofIndex() !== -1) {
                $oneof = $this->desc->getOneofDecl()[$field->getOneofIndex()];
                $oneof_name = $oneof->getName();
                $this->$oneof_name = new OneofField($oneof);
            } else if ($field->getLabel() === GPBLabel::OPTIONAL &&
                       PHP_INT_SIZE == 4) {
                switch ($field->getType()) {
                    case GPBType::INT64:
                    case GPBType::UINT64:
                    case GPBType::FIXED64:
                    case GPBType::SFIXED64:
                    case GPBType::SINT64:
                        $this->$setter("0");
                }
            }
        }
    }

    /**
     * @ignore
     */
    private function initWithDescriptor(Descriptor $desc)
    {
        $this->desc = $desc;
        foreach ($desc->getField() as $field) {
            $setter = $field->getSetter();
            $defaultValue = $this->defaultValue($field);
            $this->$setter($defaultValue);
        }
    }

    protected function readWrapperValue($member)
    {
        $field = $this->desc->getFieldByName($member);
        $oneof_index = $field->getOneofIndex();
        if ($oneof_index === -1) {
            $wrapper = $this->$member;
        } else {
            $wrapper = $this->readOneof($field->getNumber());
        }

        if (is_null($wrapper)) {
            return NULL;
        } else {
            return $wrapper->getValue();
        }
    }

    protected function writeWrapperValue($member, $value)
    {
        $field = $this->desc->getFieldByName($member);
        $wrapped_value = $value;
        if (!is_null($value)) {
            $desc = $field->getMessageType();
            $klass = $desc->getClass();
            $wrapped_value = new $klass;
            $wrapped_value->setValue($value);
        }

        $oneof_index = $field->getOneofIndex();
        if ($oneof_index === -1) {
            $this->$member = $wrapped_value;
        } else {
            $this->writeOneof($field->getNumber(), $wrapped_value);
        }
    }

    protected function readOneof($number)
    {
        $field = $this->desc->getFieldByNumber($number);
        $oneof = $this->desc->getOneofDecl()[$field->getOneofIndex()];
        $oneof_name = $oneof->getName();
        $oneof_field = $this->$oneof_name;
        if ($number === $oneof_field->getNumber()) {
            return $oneof_field->getValue();
        } else {
            return $this->defaultValue($field);
        }
    }

    protected function writeOneof($number, $value)
    {
        $field = $this->desc->getFieldByNumber($number);
        $oneof = $this->desc->getOneofDecl()[$field->getOneofIndex()];
        $oneof_name = $oneof->getName();
        $oneof_field = $this->$oneof_name;
        $oneof_field->setValue($value);
        $oneof_field->setFieldName($field->getName());
        $oneof_field->setNumber($number);
    }

    protected function whichOneof($oneof_name)
    {
        $oneof_field = $this->$oneof_name;
        $number = $oneof_field->getNumber();
        if ($number == 0) {
          return "";
        }
        $field = $this->desc->getFieldByNumber($number);
        return $field->getName();
    }

    /**
     * @ignore
     */
    private function defaultValue($field)
    {
        $value = null;

        switch ($field->getType()) {
            case GPBType::DOUBLE:
            case GPBType::FLOAT:
                return 0.0;
            case GPBType::UINT32:
            case GPBType::INT32:
            case GPBType::FIXED32:
            case GPBType::SFIXED32:
            case GPBType::SINT32:
            case GPBType::ENUM:
                return 0;
            case GPBType::INT64:
            case GPBType::UINT64:
            case GPBType::FIXED64:
            case GPBType::SFIXED64:
            case GPBType::SINT64:
                if (PHP_INT_SIZE === 4) {
                    return '0';
                } else {
                    return 0;
                }
            case GPBType::BOOL:
                return false;
            case GPBType::STRING:
            case GPBType::BYTES:
                return "";
            case GPBType::GROUP:
            case GPBType::MESSAGE:
                return null;
            default:
                user_error("Unsupported type.");
                return false;
        }
    }

    /**
     * @ignore
     */
    private function skipField($input, $tag)
    {
        $number = GPBWire::getTagFieldNumber($tag);
        if ($number === 0) {
            throw new GPBDecodeException("Illegal field number zero.");
        }

        $start = $input->current();
        switch (GPBWire::getTagWireType($tag)) {
            case GPBWireType::VARINT:
                $uint64 = 0;
                if (!$input->readVarint64($uint64)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside varint.");
                }
                break;
            case GPBWireType::FIXED64:
                $uint64 = 0;
                if (!$input->readLittleEndian64($uint64)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside fixed64.");
                }
                break;
            case GPBWireType::FIXED32:
                $uint32 = 0;
                if (!$input->readLittleEndian32($uint32)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside fixed32.");
                }
                break;
            case GPBWireType::LENGTH_DELIMITED:
                $length = 0;
                if (!$input->readVarint32($length)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside length.");
                }
                $data = NULL;
                if (!$input->readRaw($length, $data)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside length delimited data.");
                }
                break;
            case GPBWireType::START_GROUP:
            case GPBWireType::END_GROUP:
                throw new GPBDecodeException("Unexpected wire type.");
            default:
                throw new GPBDecodeException("Unexpected wire type.");
        }
        $end = $input->current();

        $bytes = str_repeat(chr(0), CodedOutputStream::MAX_VARINT64_BYTES);
        $size = CodedOutputStream::writeVarintToArray($tag, $bytes, true);
        $this->unknown .= substr($bytes, 0, $size) . $input->substr($start, $end);
    }

    /**
     * @ignore
     */
    private static function parseFieldFromStreamNoTag($input, $field, &$value)
    {
        switch ($field->getType()) {
            case GPBType::DOUBLE:
                if (!GPBWire::readDouble($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside double field.");
                }
                break;
            case GPBType::FLOAT:
                if (!GPBWire::readFloat($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside float field.");
                }
                break;
            case GPBType::INT64:
                if (!GPBWire::readInt64($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside int64 field.");
                }
                break;
            case GPBType::UINT64:
                if (!GPBWire::readUint64($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside uint64 field.");
                }
                break;
            case GPBType::INT32:
                if (!GPBWire::readInt32($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside int32 field.");
                }
                break;
            case GPBType::FIXED64:
                if (!GPBWire::readFixed64($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside fixed64 field.");
                }
                break;
            case GPBType::FIXED32:
                if (!GPBWire::readFixed32($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside fixed32 field.");
                }
                break;
            case GPBType::BOOL:
                if (!GPBWire::readBool($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside bool field.");
                }
                break;
            case GPBType::STRING:
                // TODO(teboring): Add utf-8 check.
                if (!GPBWire::readString($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside string field.");
                }
                break;
            case GPBType::GROUP:
                trigger_error("Not implemented.", E_ERROR);
                break;
            case GPBType::MESSAGE:
                if ($field->isMap()) {
                    $value = new MapEntry($field->getMessageType());
                } else {
                    $klass = $field->getMessageType()->getClass();
                    $value = new $klass;
                }
                if (!GPBWire::readMessage($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside message.");
                }
                break;
            case GPBType::BYTES:
                if (!GPBWire::readString($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside bytes field.");
                }
                break;
            case GPBType::UINT32:
                if (!GPBWire::readUint32($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside uint32 field.");
                }
                break;
            case GPBType::ENUM:
                // TODO(teboring): Check unknown enum value.
                if (!GPBWire::readInt32($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside enum field.");
                }
                break;
            case GPBType::SFIXED32:
                if (!GPBWire::readSfixed32($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside sfixed32 field.");
                }
                break;
            case GPBType::SFIXED64:
                if (!GPBWire::readSfixed64($input, $value)) {
                    throw new GPBDecodeException(
                        "Unexpected EOF inside sfixed64 field.");
                }
                break;
            case GPBType::SINT32:
                if (!GPBWire::readSint32($input, $value)) {
                    throw 