<?php
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
 * Class SendChatMessageParameters.
 *
 * @method string      getMeetingID()
 * @method $this       setMeetingID(string $id)
 * @method string      getMessage()
 * @method $this       setMessage(string $message)
 * @method string|null getUserName()
 * @method $this       setUserName(string $userName)
 */
class SendChatMessageParameters extends BaseParameters
{
    /**
     * @var string
     */
    protected $meetingID;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string|null
     */
    protected $userName;

    public function __construct(string $meetingID, string $message, ?string $userName = null)
    {
        $this->meetingID = $meetingID;
        $this->message = $message;
        $this->userName = $userName;
    }
}
