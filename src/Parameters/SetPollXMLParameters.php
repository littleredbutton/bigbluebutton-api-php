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

/**
 * @method string getMeetingID()
 * @method $this setMeetingID(string $id)
 * @method string getTitle()
 * @method $this setTitle(string $title)
 * @method string getQuestion()
 * @method $this setQuestion(string $question)
 * @method string getQuestionType()
 * @method $this setQuestionType(string $questionType)
 * @method string[] getAnswers()
 * @method $this setAnswers(string[] $answers)
 */
class SetPollXMLParameters extends BaseParameters
{
    public const POLL_TYPE_YES_NO            = 'YN';
    public const POLL_TYPE_YES_NO_ABSTENTION = 'YNA';
    public const POLL_TYPE_TRUE_FALSE        = 'TF';
    public const POLL_TYPE_LETTER            = 'A-';
    public const POLL_TYPE_A2                = 'A-2';
    public const POLL_TYPE_A3                = 'A-3';
    public const POLL_TYPE_A4                = 'A-4';
    public const POLL_TYPE_A5                = 'A-5';
    public const POLL_TYPE_CUSTOM            = 'CUSTOM';
    public const POLL_TYPE_RESPONSE          = 'R-';

    /**
     * @var string
     */
    protected $meetingID;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $question;

    /**
     * @var string
     */
    protected $questionType;

    /**
     * @var string[]
     */
    protected $answers = [];

    public function __construct(string $meetingID, string $title, string $question, string $questionType)
    {
        $this->ignoreProperties = ['title', 'question', 'questionType', 'answers'];

        $this->meetingID    = $meetingID;
        $this->title        = $title;
        $this->question     = $question;
        $this->questionType = $questionType;
    }

    public function addAnswer(string $answer)
    {
        $this->answers[] = $answer;
    }

    public function getPollAsXML(): string
    {
        $xml    = new \SimpleXMLElement('<poll/>');
        $xml->addChild('title', $this->title);
        $xml->addChild('question', $this->question);
        $xml->addChild('questionType', $this->questionType);

        $answers = $xml->addChild('answers');

        foreach ($this->answers as $answer) {
            $answers->addChild('answer', $answer);
        }

        return $xml->asXML();
    }

    protected function getProperties(): array
    {
        $properties = parent::getProperties();

        $properties['pollXML'] = $this->getPollAsXML();

        return $properties;
    }
}
