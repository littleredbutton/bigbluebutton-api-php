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

namespace BigBlueButton\Parameters;

/**
 * @method string    getCallbackURL()
 * @method $this     setCallbackURL(string $url)
 * @method string    getMeetingID()
 * @method $this     setMeetingID(string $id)
 * @method string    getEventID()
 * @method $this     setEventID(string $id)
 * @method bool|null isGetRaw()
 * @method $this     setGetRaw(bool $getRaw)
 */
class HooksCreateParameters extends BaseParameters
{
    protected ?string $meetingID = null;
    protected ?string $eventID = null;
    protected ?bool $getRaw = null;

    public function __construct(protected string $callbackURL)
    {
    }
}
