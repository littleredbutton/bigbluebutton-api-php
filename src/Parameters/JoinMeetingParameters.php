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

use BigBlueButton\Enum\MeetingLayout;
use BigBlueButton\Enum\Role;

/**
 * Class JoinMeetingParametersTest.
 *
 * @method string    getFullName()
 * @method $this     setFullName(string $fullName)
 * @method string    getMeetingID()
 * @method $this     setMeetingID(string $id)
 * @method int       getCreateTime()
 * @method $this     setCreateTime(int $createTime)
 * @method string    getUserID()
 * @method $this     setUserID(string $userID)
 * @method string    getWebVoiceConf()
 * @method $this     setWebVoiceConf(string $webVoiceConf)
 * @method string    getDefaultLayout()
 * @method $this     setDefaultLayout(string $defaultLayout)
 * @method string    getAvatarURL()
 * @method $this     setAvatarURL(string $avatarURL)
 * @method bool|null isRedirect()
 * @method $this     setRedirect(bool $redirect)
 * @method string    getErrorRedirectUrl()
 * @method $this     setErrorRedirectUrl(string $errorRedirectUrl)
 * @method bool|null isGuest()
 * @method $this     setGuest(bool $guest)
 * @method string    getRole()
 * @method $this     setRole(Role $role)
 * @method bool|null isExcludeFromDashboard()
 * @method $this     setExcludeFromDashboard(bool $excludeFromDashboard)
 * @method string    getEnforceLayout()
 * @method $this     setEnforceLayout(MeetingLayout $enforceLayout)
 * @method string    getWebcamBackgroundURL()
 * @method $this     setWebcamBackgroundURL(string $webcamBackgroundURL)
 */
class JoinMeetingParameters extends UserDataParameters
{
    protected ?int $createTime = null;
    protected ?string $userID = null;
    protected ?string $webVoiceConf = null;
    protected ?string $defaultLayout = null;
    protected ?string $avatarURL = null;
    protected ?bool $redirect = null;
    protected ?string $errorRedirectUrl = null;
    protected ?bool $guest = null;
    protected ?bool $excludeFromDashboard = null;
    protected ?MeetingLayout $enforceLayout = null;
    protected ?string $webcamBackgroundURL = null;

    public function __construct(protected string $meetingID, protected string $fullName, protected Role $role)
    {
    }
}
