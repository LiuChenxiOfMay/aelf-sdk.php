<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/descriptor.proto

namespace Google\Protobuf\Internal;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\GPBWire;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\InputStream;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A message representing a option the parser does not recognize. This only
 * appears in options protos created by the compiler::Parser class.
 * DescriptorPool resolves these when building Descriptor objects. Therefore,
 * options protos in descriptor objects (e.g. returned by Descriptor::options(),
 * or produced by Descriptor::CopyTo()) will never have UninterpretedOptions
 * in them.
 *
 * Generated from protobuf message <code>google.protobuf.UninterpretedOption</code>
 */
class UninterpretedOption extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption.NamePart name = 2;</code>
     */
    private $name;
    private $has_name = false;
    /**
     * The value of the uninterpreted option, in whatever type the tokenizer
     * identified it as during parsing. Exactly one of these should be set.
     *
     * Generated from protobuf field <code>optional string identifier_value = 3;</code>
     */
    protected $identifier_value = '';
    private $has_identifier_value = false;
    /**
     * Generated from protobuf field <code>optional uint64 positive_int_value = 4;</code>
     */
    protected $positive_int_value = 0;
    private $has_positive_int_value = false;
    /**
     * Generated from protobuf field <code>optional int64 negative_int_value = 5;</code>
     */
    protected $negative_int_value = 0;
    private $has_negative_int_value = false;
    /**
     * Generated from protobuf field <code>optional double double_value = 6;</code>
     */
    protected $double_value = 0.0;
    private $has_double_value = false;
    /**
     * Generated from protobuf field <code>optional bytes string_value = 7;</code>
     */
    protected $string_value = '';
    private $has_string_value = false;
    /**
     * Generated from protobuf field <code>optional string aggregate_value = 8;</code>
     */
    protected $aggregate_value = '';
    private $has_aggregate_value = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Internal\UninterpretedOption\NamePart[]|\Google\Protobuf\Internal\RepeatedField $name
     *     @type string $identifier_value
     *           The value of the uninterpreted option, in whatever type the tokenizer
     *           identified it as during parsing. Exactly one of these sho