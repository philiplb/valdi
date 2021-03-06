<?php

/*
 * This file is part of the Valdi package.
 *
 * (c) Philip Lehmann-Böhm <philip@philiplb.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ValdiTests\Validator;

use PHPUnit_Framework_TestCase;
use Valdi\Validator\IP;

class IPTest extends \PHPUnit\Framework\TestCase
{

    public function testValidate()
    {
        $validator = new IP();

        $this->assertTrue($validator->isValid('127.0.0.1', []));
        $this->assertTrue($validator->isValid('2001:0db8:0000:08d3:0000:8a2e:0070:7344', []));
        $this->assertTrue($validator->isValid('2001:db8:0:8d3:0:8a2e:70:7344', []));
        $this->assertTrue($validator->isValid('::ffff:7f00:1', []));

        $this->assertFalse($validator->isValid('999.999.999.999', []));
        $this->assertFalse($validator->isValid('127.0.0', []));
        $this->assertFalse($validator->isValid(':::ffff:7f00:1', []));

        $this->assertFalse($validator->isValid('test', []));

        $this->assertTrue($validator->isValid('', []));
        $this->assertTrue($validator->isValid(null, []));
    }

    public function testGetInvalidDetails()
    {
        $validator = new IP();
        $read = $validator->getInvalidDetails();
        $expected = 'ip';
        $this->assertSame($read, $expected);
    }

}
