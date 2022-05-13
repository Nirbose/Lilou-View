<?php

use Nirbose\LilouView\Tokenizer;
use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase
{
    public function testTokenize()
    {
        $tokenizer = new Tokenizer("@func(a, b, c) {var}");
        $this->assertEquals(
            [
                "func" => [
                    [
                        "@func(a, b, c)"
                    ],
                    [
                        "func"
                    ],
                    [
                        "a, b, c"
                    ]
                ],
                "var" => [
                    [
                        "{var}"
                    ],
                    [
                        "var"
                    ]
                ]
            ],
            $tokenizer->getTokens()
        );
    }
}
