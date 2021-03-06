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

use Exception;
use PHPUnit_Framework_TestCase;
use Valdi\Validator\Regexp;
use Valdi\ValidationException;

class RegexpTest extends \PHPUnit\Framework\TestCase
{

    public function testValidate()
    {
        $validator = new Regexp();

        $this->assertTrue($validator->isValid('test', ['/t.st/']));

        $this->assertFalse($validator->isValid('test', ['foo']));
        $this->assertFalse($validator->isValid('@test.de', ['foo']));

        $this->assertTrue($validator->isValid('', ['foo']));
        $this->assertTrue($validator->isValid(null, ['foo']));

        try {
            $validator->isValid('test', []);
            $this->fail();
        } catch (ValidationException $e) {
            $read = $e->getMessage();
            $expected = '"regexp" expects 1 parameter.';
            $this->assertSame($read, $expected);
        } catch (Exception $e) {
            $this->fail();
        }

        try {
            $validator->isValid('test', ['1', '2']);
            $this->fail();
        } catch (ValidationException $e) {
            $read = $e->getMessage();
            $expected = '"regexp" expects 1 parameter.';
            $this->assertSame($read, $expected);
        } catch (Exception $e) {
            $this->fail();
        }
    }

}
