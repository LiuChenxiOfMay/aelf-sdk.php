NDj9FLR/ojezD5Geyfv5sOSLWZAMO7y6YBmIs=
-----END BITCOIN SIGNED MESSAGE-----"));

        $this->assertTrue($bitcoinECDSA->checkSignatureForRawMessage("-----BEGIN BITCOIN SIGNED MESSAGE-----
oho
-----BEGIN SIGNATURE-----
1HZwkjkeaoZfTSaJxDw6aKkxp45agDiEzN
G9NVTo1N2vbNEVNYGgobMwwuZuUb0jWvytoRd92qfckoBjhlkTbDQehADRXOWWqHGexxWcPGmub0CPdcEC+0Rbs=
-----END BITCOIN SIGNED MESSAGE-----"));

        $this->assertTrue($bitcoinECDSA->checkSignatureForRawMessage("-----BEGIN BITCOIN SIGNED MESSAGE-----
aha
-----BEGIN SIGNATURE-----
1HZwkjkeaoZfTSaJxDw6aKkxp45agDiEzN
HJoQp4rhjY5wd4NyhSVUMy4EY+9npgOnXzro+l5ibkSBfA/p6JjkfUuvlnc8As6tw4eOIhtp2BN81xw/El9bpIg=
-----END BITCOIN SIGNED MESSAGE-----"));
    }
}
                                                                                                                                       