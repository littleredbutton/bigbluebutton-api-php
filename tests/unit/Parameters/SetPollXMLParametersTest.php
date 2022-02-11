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
namespace BigBlueButton\Parameters;

use BigBlueButton\TestCase;

class SetPollXMLParametersTest extends TestCase
{
    public function testSimplePollXML()
    {
        $params               = $this->generateSetPollXMLParams();
        $setPollXMLParameters = $this->getSetPollXMLParamsMock($params);

        $this->assertEquals($params['meetingID'], $setPollXMLParameters->getMeetingID());
        $this->assertEquals($params['title'], $setPollXMLParameters->getTitle());
        $this->assertEquals($params['question'], $setPollXMLParameters->getQuestion());
        $this->assertEquals($params['questionType'], $setPollXMLParameters->getQuestionType());

        $expectedXML = '<poll>';
        $expectedXML .= "<title>{$params['title']}</title><question>{$params['question']}</question><questionType>{$params['questionType']}</questionType>";
        $expectedXML .= '<answers>';
        $expectedXML .= implode(array_map(function ($answer) {
            return "<answer>$answer</answer>";
        }, $params['answers']));
        $expectedXML .= '</answers></poll>';

        $this->assertXmlStringEqualsXmlString($expectedXML, $setPollXMLParameters->getPollAsXML());
    }
}
