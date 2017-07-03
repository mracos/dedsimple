<?php

namespace Dedsimple\Tests;

use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase {
    /**
     * @covers ::dd
     */
    public function testDdFunction()
    {
        $string = 'ok';
        dd($string, false);
        $this->expectOutputString("<pre>string(2) \"ok\"\n</pre>");
    }

    /**
     * @covers ::env
     */
    public function testEnvFunction()
    {
        putenv("DEDSIMPLE_TEST=true");
        $this->assertEquals("true", env("DEDSIMPLE_TEST"));

        $this->assertEmpty(env("ASDASDASDIOJ_ASD"));

        $this->assertEquals(
            "default",
            env("ASDOKWJD", "default")
        );
    }
}
