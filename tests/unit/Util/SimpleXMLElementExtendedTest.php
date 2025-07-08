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

namespace BigBlueButton\Tests\Unit\Util;

use BigBlueButton\Tests\Common\TestCase;
use BigBlueButton\Util\SimpleXMLElementExtended;

/**
 * @covers \BigBlueButton\Util\SimpleXMLElementExtended
 */
final class SimpleXMLElementExtendedTest extends TestCase
{
    /**
     * Test adding a child element with CDATA content.
     */
    public function testAddChildWithCData(): void
    {
        $xml = new SimpleXMLElementExtended('<?xml version="1.0" encoding="UTF-8"?><modules/>');
        $module = $xml->addChildWithCData('module', '{"foo": {"foo": "baa"}}');
        $module->addAttribute('name', 'clientSettingsOverride');

        $expected = '<?xml version="1.0" encoding="UTF-8"?>
<modules><module name="clientSettingsOverride"><![CDATA[{"foo": {"foo": "baa"}}]]></module></modules>';

        $this->assertXmlStringEqualsXmlString($expected, $xml->asXML());
    }
}
