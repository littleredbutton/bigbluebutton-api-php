<?php
/**
 * BigBlueButton open source conferencing system - https://www.bigbluebutton.org/.
 *
 * Copyright (c) 2016-2018 BigBlueButton Inc. and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * BigBlueButton is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with BigBlueButton; if not, see <http://www.gnu.org/licenses/>.
 */

namespace BigBlueButton\Responses;

/**
 * Class BaseResponseAsJson
 * @package BigBlueButton\Responses
 */
abstract class BaseResponseAsJson
{
    const SUCCESS = 'SUCCESS';
    const FAILED = 'FAILED';

    /**
     * @var string
     */
    protected $rawJson;

    /**
     * BaseResponseAsJson constructor.
     *
     * @param rawJson
     */
    public function __construct($rawJson)
    {
        $this->rawJson = json_decode($rawJson);
    }

    /**
     * @return json|false|string
     */
    public function getRawJson()
    {
        return json_encode($this->rawJson);
    }

    public function getRawArray()
    {
        return json_decode(json_encode($this->rawJson), true);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if ($this->failed()) {
            return $this->rawJson->response->message;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getMessageKey()
    {
        if ($this->failed()) {
            return $this->rawJson->response->messageKey;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getReturnCode()
    {
        return $this->rawJson->response->returncode;
    }

    public function success()
    {
        return $this->getReturnCode() === self::SUCCESS;
    }

    public function failed()
    {
        return $this->getReturnCode() === self::FAILED;
    }
}