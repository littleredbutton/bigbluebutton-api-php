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

use BigBlueButton\Enum\Role;

/**
 * Class Meeting.
 */
class Meeting
{
    private readonly string $meetingId;

    private readonly string $meetingName;

    private readonly float $creationTime;

    private readonly string $creationDate;

    private readonly int $voiceBridge;

    private readonly string $dialNumber;

    private readonly bool $hasBeenForciblyEnded;

    private readonly bool $isRunning;

    private readonly int $participantCount;

    private readonly int $listenerCount;

    private readonly int $voiceParticipantCount;

    private readonly int $videoCount;

    private readonly int $duration;

    private readonly bool $hasUserJoined;

    private readonly string $internalMeetingId;

    private readonly bool $isRecording;

    private readonly float $startTime;
    private readonly string $parentMeetingID;

    private readonly float $endTime;

    private readonly int $maxUsers;

    private readonly int $moderatorCount;

    /**
     * @var Attendee[]
     */
    private ?array $attendees = null;

    /** @var array<string,string>|null */
    private ?array $metas = null;

    private readonly bool $isBreakout;

    public function __construct(protected \SimpleXMLElement $rawXml)
    {
        $this->meetingId = $this->rawXml->meetingID->__toString();
        $this->meetingName = $this->rawXml->meetingName->__toString();
        $this->creationTime = (float) $this->rawXml->createTime;
        $this->creationDate = $this->rawXml->createDate->__toString();
        $this->voiceBridge = (int) $this->rawXml->voiceBridge;
        $this->dialNumber = $this->rawXml->dialNumber->__toString();
        $this->hasBeenForciblyEnded = $this->rawXml->hasBeenForciblyEnded->__toString() === 'true';
        $this->isRunning = $this->rawXml->running->__toString() === 'true';
        $this->participantCount = (int) $this->rawXml->participantCount;
        $this->listenerCount = (int) $this->rawXml->listenerCount;
        $this->voiceParticipantCount = (int) $this->rawXml->voiceParticipantCount;
        $this->videoCount = (int) $this->rawXml->videoCount;
        $this->duration = (int) $this->rawXml->duration;
        $this->hasUserJoined = $this->rawXml->hasUserJoined->__toString() === 'true';
        $this->internalMeetingId = $this->rawXml->internalMeetingID->__toString();
        $this->parentMeetingID = $this->rawXml->parentMeetingID->__toString();
        $this->isRecording = $this->rawXml->recording->__toString() === 'true';
        $this->startTime = (float) $this->rawXml->startTime;
        $this->endTime = (float) $this->rawXml->endTime;
        $this->maxUsers = (int) $this->rawXml->maxUsers->__toString();
        $this->moderatorCount = (int) $this->rawXml->moderatorCount->__toString();
        $this->isBreakout = $this->rawXml->isBreakout->__toString() === 'true';
    }

    public function getMeetingId(): string
    {
        return $this->meetingId;
    }

    public function getMeetingName(): string
    {
        return $this->meetingName;
    }

    public function getCreationTime(): float
    {
        return $this->creationTime;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getVoiceBridge(): int
    {
        return $this->voiceBridge;
    }

    public function getDialNumber(): string
    {
        return $this->dialNumber;
    }

    public function hasBeenForciblyEnded(): bool
    {
        return $this->hasBeenForciblyEnded;
    }

    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    public function getParticipantCount(): int
    {
        return $this->participantCount;
    }

    public function getListenerCount(): int
    {
        return $this->listenerCount;
    }

    public function getVoiceParticipantCount(): int
    {
        return $this->voiceParticipantCount;
    }

    public function getVideoCount(): int
    {
        return $this->videoCount;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function hasUserJoined(): bool
    {
        return $this->hasUserJoined;
    }

    public function getInternalMeetingId(): string
    {
        return $this->internalMeetingId;
    }

    public function getParentMeetingID(): string
    {
        return $this->parentMeetingID;
    }

    public function isRecording(): bool
    {
        return $this->isRecording;
    }

    public function getStartTime(): float
    {
        return $this->startTime;
    }

    public function getEndTime(): float
    {
        return $this->endTime;
    }

    public function getMaxUsers(): int
    {
        return $this->maxUsers;
    }

    public function getModeratorCount(): int
    {
        return $this->moderatorCount;
    }

    /**
     * @return Attendee[]
     */
    public function getAttendees(): array
    {
        if ($this->attendees === null) {
            $this->attendees = [];
            foreach ($this->rawXml->attendees->attendee as $attendeeXml) {
                $this->attendees[] = new Attendee($attendeeXml);
            }
        }

        return $this->attendees;
    }

    /**
     * Moderators of Meeting - Subset of Attendees.
     *
     * @return Attendee[]
     */
    public function getModerators(): array
    {
        $attendees = $this->getAttendees();

        $moderators = array_filter($attendees, static fn ($attendee) => $attendee->getRole() === Role::MODERATOR->value);

        return array_values($moderators);
    }

    /**
     * Viewers of Meeting - Subset of Attendees.
     *
     * @return Attendee[]
     */
    public function getViewers(): array
    {
        $attendees = $this->getAttendees();

        $viewers = array_filter($attendees, static fn ($attendee) => $attendee->getRole() === Role::VIEWER->value);

        return array_values($viewers);
    }

    /** @return array<string,string> */
    public function getMetas(): array
    {
        if ($this->metas === null) {
            $this->metas = [];
            foreach ($this->rawXml->metadata->children() as $metadataXml) {
                $this->metas[$metadataXml->getName()] = $metadataXml->__toString();
            }
        }

        return $this->metas;
    }

    public function isBreakout(): bool
    {
        return $this->isBreakout;
    }
}
