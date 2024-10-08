<?php

declare(strict_types=1);

/**
 * This file is part of littleredbutton/bigbluebutton-api-php.
 *
 * littleredbutton/bigbluebutton-api-php is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * littleredbutton/bigbluebutton-api-php is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with littleredbutton/bigbluebutton-api-php. If not, see <http://www.gnu.org/licenses/>.
 */

namespace BigBlueButton\Tests\Unit\Parameters;

use BigBlueButton\Parameters\BaseParameters;
use PHPUnit\Framework\TestCase;

final class BaseParametersTest extends TestCase
{
    public function testBooleanGetterWithNonBoolean(): void
    {
        $params = new TestParameters();

        $this->expectException(\BadFunctionCallException::class);
        $this->expectExceptionMessage('notABool is not a boolean property');

        $params->isNotABool();
    }

    public function testGetterWithInvalid(): void
    {
        $params = new TestParameters();

        $this->expectException(\BadFunctionCallException::class);
        $this->expectExceptionMessage('invalid is not a valid property');

        $params->getInvalid();
    }

    public function testSetterWithInvalid(): void
    {
        $params = new TestParameters();

        $this->expectException(\BadFunctionCallException::class);
        $this->expectExceptionMessage('invalid is not a valid property');

        $params->setInvalid('foobar');
    }

    public function testEnum(): void
    {
        $params = new TestEnumParameters();

        $params->setEnum('one');
        $this->assertSame(TestEnum::ONE, $params->getEnum());

        $params->setEnum('two');
        $this->assertSame(TestEnum::TWO, $params->getEnum());
    }
}

/**
 * @internal
 *
 * @method isNotABool()
 * @method getInvalid()
 * @method setInvalid(string $invalid)
 */
final class TestParameters extends BaseParameters
{
    protected string $notABool = 'string';
}

/**
 * @internal
 *
 * @method self     setEnum(TestEnum|string $enum)
 * @method TestEnum getEnum()
 */
final class TestEnumParameters extends BaseParameters
{
    protected ?TestEnum $enum = null;
}

enum TestEnum: string
{
    case ONE = 'one';
    case TWO = 'two';
}
