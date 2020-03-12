32
    {
        return new Int32(ByteOrder::LE);
    }

    /**
     * Add a int64 serializer to the template
     *
     * @return Int64
     */
    public function int64(): Int64
    {
        return new Int64(ByteOrder::BE);
    }

    /**
     * Add a little-endian Int64 serializer to the template
     *
     * @return Int64
     */
    public function int64le(): Int64
    {
        return new Int64(ByteOrder::LE);
    }

    /**
     * Add a int128 serializer to the template
     *
     * @return Int128
     */
    public function int128(): Int128
    {
        return new Int128(ByteOrder::BE);
    }

    /**
     * Add a little-endian Int128 serializer to the template
     *
     * @return Int128
     */
    public function int128le(): Int128
    {
        return new Int128(ByteOrder::LE);
    }

    /**
     * Add a int256 serializer to the template
     *
     * @return Int256
     */
    public function int256(): Int256
    {
        return new Int256(ByteOrder::BE);
    }

    /**
     * Add a little-endian Int256 serializer to the template
     *
     * @return Int256
     */
    public function int256le(): Int256
    {
        return new Int256(ByteOrder::LE);
    }

    /**
     * Add a VarInt serializer to the template
     *
     * @return VarInt
     */
    public function varint(): VarInt
    {
        return new VarInt();
    }

    /**
     * Add a VarString serializer to the template
     *
     * @return VarString
     */
    public function varstring(): VarString
    {
        return new VarString(new VarInt());
    }

    /**
     * Add a byte string serializer to the template. This serializer requires a length to
     * pad/truncate to.
     *
     * @param  int $length
     * @return ByteString
     */
    public function bytestring(int $length): ByteString
    {
        return new ByteString($length, ByteOrder::BE);
    }

    /**
     * Add a little-endian byte string serializer to the template. This serializer requires
     * a length to pad/truncate to.
     *
     * @param  int $length
     * @return ByteString
     */
    public function bytestringle(int $length): ByteString
    {
        return new ByteString($length, ByteOrder::LE);
    }

    /**
     * Add a vector serializer to the template. A $readHandler must be provided if the
     * template will be used to deserialize a vector, since it's contents are not known.
     *
     * The $readHandler should operate on the parser reference, reading the bytes for each
     * item in the collection.
     *
     * @param  callable $readHandler
     * @return Vector
     */
    public function vector(callable $readHandler): Vector
    {
        return new Vector($this->varint(), $readHandler);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         