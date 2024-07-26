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

use BigBlueButton\Enum\Role;

/**
 * Class JoinMeetingParametersTest.
 *
 * @method string    getFullName()
 * @method $this     setFullName(string $fullName)
 * @method string    getMeetingID()
 * @method $this     setMeetingID(string $id)
 * @method string    getCreateTime()
 * @method $this     setCreateTime(string $createTime)
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
 * @method $this     setRole(string $role)
 * @method bool|null isExcludeFromDashboard()
 * @method $this     setExcludeFromDashboard(bool $excludeFromDashboard)
 */
class JoinMeetingParameters extends UserDataParameters
{
    /* @deprecated and will be removed in 6.0. Use BigBlueButton\Enum\Role::MODERATOR instead */
    public const MODERATOR = Role::MODERATOR;

    /* @deprecated and will be removed in 6.0. Use BigBlueButton\Enum\Role::VIEWER instead */
    public const VIEWER = Role::VIEWER;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $meetingID;

    /**
     * @var int
     */
    protected $createTime;

    /**
     * @var string
     */
    protected $userID;

    /**
     * @var string
     */
    protected $webVoiceConf;

    /**
     * @var string
     */
    protected $defaultLayout;

    /**
     * @var string
     */
    protected $avatarURL;

    /**
     * @var bool
     */
    protected $redirect;

    /**
     * @var string
     */
    protected $errorRedirectUrl;

    /**
     * @var string
     */
    protected $clientURL;

    /**
     * @var bool
     */
    protected $guest;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var bool
     */
    protected $excludeFromDashboard;

    public function __construct(string $meetingID, string $fullName, Role $role)
    {
        $this->meetingID = $meetingID;
        $this->fullName = $fullName;
        $this->role = $role;
    }

    /**
     * @deprecated and will be removed in 6.0. Old BigBlueButton flash client parameter.
     */
    public function getClientURL(): ?string
    {
        return $this->clientURL;
    }

    /**
     * @deprecated and will be removed in 6.0. Old BigBlueButton flash client parameter.
     *
     * @return $this
     */
    public function setClientURL(string $clientURL): self
    {
        $this->clientURL = $clientURL;

        return $this;
    }
}
