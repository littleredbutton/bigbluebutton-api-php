<?php

declare(strict_types=1);

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
 * Class ApiVersionResponse.
 */
class ApiVersionResponse extends BaseResponse
{
    public function getVersion(): string
    {
        return $this->rawXml->version->__toString();
    }

    public function getApiVersion(): string
    {
        return $this->rawXml->apiVersion->__toString();
    }

    public function getBbbVersion(): string
    {
        return $this->rawXml->bbbVersion->__toString();
    }
}
