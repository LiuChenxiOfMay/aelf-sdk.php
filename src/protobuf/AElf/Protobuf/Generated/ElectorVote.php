<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: types.proto

namespace AElf\Protobuf\Generated;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AElf.protobuf.generated.ElectorVote</code>
 */
class ElectorVote extends \Google\Protobuf\Internal\Message
{
    /**
     * The active voting record ids.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.Hash active_voting_record_ids = 1;</code>
     */
    private $active_voting_record_ids;
    /**
     * The voting record ids that were withdrawn.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.Hash withdrawn_voting_record_ids = 2;</code>
     */
    private $withdrawn_voting_record_ids;
    /**
     * The total number of active votes.
     *
     * Generated from protobuf field <code>int64 active_voted_votes_amount = 3;</code>
     */
    protected $active_voted_votes_amount = 0;
    /**
     * The total number of votes (including the number of votes withdrawn).
     *
     * Generated from protobuf field <code>int64 all_voted_votes_amount = 4;</code>
     */
    protected $all_voted_votes_amount = 0;
    /**
     * The active voting records.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.ElectionVotingRecord active_voting_records = 5;</code>
     */
    private $active_voting_records;
    /**
     * The voting records that were withdrawn.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.ElectionVotingRecord withdrawn_votes_records = 6;</code>
     */
    private $withdrawn_votes_records;
    /**
     * Public key for voter.
     *
     * Generated from protobuf field <code>bytes pubkey = 7;</code>
     */
    protected $pubkey = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \AElf\Protobuf\Generated\Hash[]|\Google\Protobuf\Internal\RepeatedField $active_voting_record_ids
     *           The active voting record ids.
     *     @type \AElf\Protobuf\Generated\Hash[]|\Google\Protobuf\Internal\RepeatedField $withdrawn_voting_record_ids
     *           The voting record ids that were withdrawn.
     *     @type int|string $active_voted_votes_amount
     *           The total number of active votes.
     *     @type int|string $all_voted_votes_amount
     *           The total number of votes (including the number of votes withdrawn).
     *     @type \AElf\Protobuf\Generated\ElectionVotingRecord[]|\Google\Protobuf\Internal\RepeatedField $active_voting_records
     *           The active voting records.
     *     @type \AElf\Protobuf\Generated\ElectionVotingRecord[]|\Google\Protobuf\Internal\RepeatedField $withdrawn_votes_records
     *           The voting records that were withdrawn.
     *     @type string $pubkey
     *           Public key for voter.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Types::initOnce();
        parent::__construct($data);
    }

    /**
     * The active voting record ids.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.Hash active_voting_record_ids = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getActiveVotingRecordIds()
    {
        return $this->active_voting_record_ids;
    }

    /**
     * The active voting record ids.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.Hash active_voting_record_ids = 1;</code>
     * @param \AElf\Protobuf\Generated\Hash[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setActiveVotingRecordIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AElf\Protobuf\Generated\Hash::class);
        $this->active_voting_record_ids = $arr;

        return $this;
    }

    /**
     * The voting record ids that were withdrawn.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.Hash withdrawn_voting_record_ids = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getWithdrawnVotingRecordIds()
    {
        return $this->withdrawn_voting_record_ids;
    }

    /**
     * The voting record ids that were withdrawn.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.Hash withdrawn_voting_record_ids = 2;</code>
     * @param \AElf\Protobuf\Generated\Hash[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setWithdrawnVotingRecordIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AElf\Protobuf\Generated\Hash::class);
        $this->withdrawn_voting_record_ids = $arr;

        return $this;
    }

    /**
     * The total number of active votes.
     *
     * Generated from protobuf field <code>int64 active_voted_votes_amount = 3;</code>
     * @return int|string
     */
    public function getActiveVotedVotesAmount()
    {
        return $this->active_voted_votes_amount;
    }

    /**
     * The total number of active votes.
     *
     * Generated from protobuf field <code>int64 active_voted_votes_amount = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setActiveVotedVotesAmount($var)
    {
        GPBUtil::checkInt64($var);
        $this->active_voted_votes_amount = $var;

        return $this;
    }

    /**
     * The total number of votes (including the number of votes withdrawn).
     *
     * Generated from protobuf field <code>int64 all_voted_votes_amount = 4;</code>
     * @return int|string
     */
    public function getAllVotedVotesAmount()
    {
        return $this->all_voted_votes_amount;
    }

    /**
     * The total number of votes (including the number of votes withdrawn).
     *
     * Generated from protobuf field <code>int64 all_voted_votes_amount = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setAllVotedVotesAmount($var)
    {
        GPBUtil::checkInt64($var);
        $this->all_voted_votes_amount = $var;

        return $this;
    }

    /**
     * The active voting records.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.ElectionVotingRecord active_voting_records = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getActiveVotingRecords()
    {
        return $this->active_voting_records;
    }

    /**
     * The active voting records.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.ElectionVotingRecord active_voting_records = 5;</code>
     * @param \AElf\Protobuf\Generated\ElectionVotingRecord[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setActiveVotingRecords($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AElf\Protobuf\Generated\ElectionVotingRecord::class);
        $this->active_voting_records = $arr;

        return $this;
    }

    /**
     * The voting records that were withdrawn.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.ElectionVotingRecord withdrawn_votes_records = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getWithdrawnVotesRecords()
    {
        return $this->withdrawn_votes_records;
    }

    /**
     * The voting records that were withdrawn.
     *
     * Generated from protobuf field <code>repeated .AElf.protobuf.generated.ElectionVotingRecord withdrawn_votes_records = 6;</code>
     * @param \AElf\Protobuf\Generated\ElectionVotingRecord[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setWithdrawnVotesRecords($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AElf\Protobuf\Generated\ElectionVotingRecord::class);
        $this->withdrawn_votes_records = $arr;

        return $this;
    }

    /**
     * Public key for voter.
     *
     * Generated from protobuf field <code>bytes pubkey = 7;</code>
     * @return string
     */
    public function getPubkey()
    {
        return $this->pubkey;
    }

    /**
     * Public key for voter.
     *
     * Generated from protobuf field <code>bytes pubkey = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setPubkey($var)
    {
        GPBUtil::checkString($var, False);
        $this->pubkey = $var;

        return $this;
    }

}

