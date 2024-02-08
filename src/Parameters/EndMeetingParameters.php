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

namespace BigBlueButton\Parameters;

/**
 * Class EndMeetingParameters.
 *
 * @method string getMeetingID()
 * @method $this  setMeetingID(string $id)
 */
class EndMeetingParameters extends BaseParameters
{
    /**
     * @var string
     */
    protected $meetingID;

    /**
     * @var string|null
     */
    protected $password;

    public function __construct(string $meetingID, ?string $password = null)
    {
        if (\func_num_args() === 2) {
            @trigger_error(sprintf('Passing $password parameter to constructor of "%s" is deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter to end a meeting.', self::class), \E_USER_DEPRECATED);
        }

        $this->password = $password;
        $this->meetingID = $meetingID;
    }

    /**
     * @deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter.
     */
    public function getPassword(): string
    {
        if (null === $this->password) {
            throw new \RuntimeException(sprintf('Password was not passed to "%s".', self::class));
        }

        return $this->password;
    }

    /**
     * @deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter.
     *
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
