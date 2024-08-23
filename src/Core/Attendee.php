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

namespace BigBlueButton\Core;

class Attendee
{
    private readonly string $userId;

    private readonly string $fullName;

    private readonly string $role;

    private readonly bool $isPresenter;

    private readonly bool $isListeningOnly;

    private readonly bool $hasJoinedVoice;

    private readonly bool $hasVideo;

    /** @var array<string,string> */
    private array $customData = [];

    private readonly string $clientType;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->userId = $xml->userID->__toString();
        $this->fullName = $xml->fullName->__toString();
        $this->role = $xml->role->__toString();
        $this->isPresenter = $xml->isPresenter->__toString() === 'true';
        $this->isListeningOnly = $xml->isListeningOnly->__toString() === 'true';
        $this->hasJoinedVoice = $xml->hasJoinedVoice->__toString() === 'true';
        $this->hasVideo = $xml->hasVideo->__toString() === 'true';
        $this->clientType = $xml->clientType->__toString();

        if ($xml->customdata) {
            foreach ($xml->customdata->children() as $data) {
                $this->customData[$data->getName()] = $data->__toString();
            }
        }
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function isPresenter(): bool
    {
        return $this->isPresenter;
    }

    public function isListeningOnly(): bool
    {
        return $this->isListeningOnly;
    }

    public function hasJoinedVoice(): bool
    {
        return $this->hasJoinedVoice;
    }

    public function hasVideo(): bool
    {
        return $this->hasVideo;
    }

    public function getClientType(): string
    {
        return $this->clientType;
    }

    /** @return array<string,string> */
    public function getCustomData(): array
    {
        return $this->customData;
    }
}
