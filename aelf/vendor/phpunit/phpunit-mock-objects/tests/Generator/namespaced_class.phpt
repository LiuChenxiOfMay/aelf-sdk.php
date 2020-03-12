<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Serializer\Transaction;

use BitWasp\Bitcoin\Script\Opcodes;
use BitWasp\Bitcoin\Serializer\Script\ScriptWitnessSerializer;
use BitWasp\Bitcoin\Serializer\Types;
use BitWasp\Bitcoin\Transaction\Transaction;
use BitWasp\Bitcoin\Transaction\TransactionInterface;
use BitWasp\Buffertools\BufferInterface;
use BitWasp\Buffertools\Parser;

class TransactionSerializer implements TransactionSerializerInterface
{
    const NO_WITNESS = 1;

    /**
     * @var \BitWasp\Buffertools\Types\Int32
     */
    protected $int32le;

    /**
     * @var \BitWasp\Buffertools\Types\Uint32
     */
    protected $uint32le;

    /**
     * @var \BitWasp\Buffertools\Types\VarInt
     */
    protected $varint;

    /**
     * @var TransactionInputSerializer
     */
    protected $inputSerializer;

    /**
     * @var TransactionOutputSerializer
     */
    protected $outputSerializer;

    /**
     * @var ScriptWitnessSerializer
     */
    protected $witnessSerializer;

    public function __construct(TransactionInputSerializer $inputSerializer = null, TransactionOutputSerializer $outputSerializer = null, ScriptWitnessSerializer $witnessSerializer = null)
    {
        $this->int32le = Types::int32le();
        $this->uint32le = Types::uint32le();
        $this->varint = Types::varint();

        if ($inputSerializer === null || $outputSerializer === null) {
            $opcodes = new Opcodes();
            if (!$inputSerializer) {
                $inputSerializer = new TransactionInputSerializer(new OutPointSerializer(), $opcodes);
            }
            if (!$outputSerializer) {
                $outputSerializer = new TransactionOutputSerializer($opcodes);
            }
        }

        if (!$witnessSerializer) {
            $witnessSerializer = new ScriptWitnessSerializer();
        }

        $this->inputSerializer = $inputSerializer;
        $this->outputSerializer = $outputSerializer;
        $this->witnessSerializer = $witnessSerializer;
    }

    /**
     * @param Parser $parser
     * @return TransactionInterface
     */
    public function fromParser(Parser $parser): TransactionInterface
    {
        $version = (int) $this->int32le->read($parser);

        $vin = [];
        $vinCount = $this->varint->read($parser);
        for ($i = 0; $i < $vinCount; $i++) {
            $vin[] = $this->inputSerializer->fromParser($parser);
        }

        $vout = [];
        $flags = 0;
        if (count($vin) === 0) {
            $flags = (int) $this->varint->read($parser);
            if ($flags !== 0) {
                $vinCount = $this->varint->read($parser);
                for ($i = 0; $i < $vinCount; $i++) {
                    $vin[] = $this->inputSerializer->fromParser($parser);
                }

                $voutCount = $this->varint->read($parser);
                for ($i = 0; $i < $voutCount; $i++) {
                    $vout[] = $this->outputSerializer->fromParser($parser);
                }
            }
        } else {
            $voutCount = $this->varint->read($parser);
            for ($i = 0; $i < $voutCount; $i++) {
                $vout[] = $