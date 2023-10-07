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
 * @method string    getConfigToken()
 * @method $this     setConfigToken(string $configToken)
 * @method string    getDefaultLayout()
 * @method $this     setDefaultLayout(string $defaultLayout)
 * @method string    getAvatarURL()
 * @method $this     setAvatarURL(string $avatarURL)
 * @method bool|null isRedirect()
 * @method $this     setRedirect(bool $redirect)
 * @method string    getClientURL()
 * @method $this     setClientURL(string $clientURL)
 * @method bool|null isGuest()
 * @method $this     setGuest(bool $guest)
 * @method string    getRole()
 * @method $this     setRole(string $role)
 * @method bool|null isExcludeFromDashboard()
 * @method $this     setExcludeFromDashboard(bool $excludeFromDashboard)
 */
class JoinMeetingParameters extends UserDataParameters
{
    public const MODERATOR = 'MODERATOR';
    public const VIEWER = 'VIEWER';

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $meetingID;

    /**
     * @var string|null
     */
    protected $password;

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
    protected $configToken;

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

    public function __construct(string $meetingID, string $fullName, string $password = null)
    {
        if (\func_num_args() === 3) {
            @trigger_error(sprintf('Passing $password parameter to constructor of "%s" is deprecated since 5.1 and will be removed in 6.0. Use "%s::setRole()" to set the designated role for the joining user instead.', self::class, self::class), \E_USER_DEPRECATED);
        }

        $this->meetingID = $meetingID;
        $this->fullName = $fullName;
        $this->password = $password;
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
