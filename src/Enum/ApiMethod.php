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

namespace BigBlueButton\Enum;

/**
 * @psalm-immutable
 */
enum ApiMethod: string
{
    case CREATE = 'create';
    case JOIN = 'join';
    case ENTER = 'enter';
    case END = 'end';
    case IS_MEETING_RUNNING = 'isMeetingRunning';
    case GET_MEETING_INFO = 'getMeetingInfo';
    case GET_MEETINGS = 'getMeetings';
    case SIGN_OUT = 'signOut';
    case GET_RECORDINGS = 'getRecordings';
    case PUBLISH_RECORDINGS = 'publishRecordings';
    case DELETE_RECORDINGS = 'deleteRecordings';
    case UPDATE_RECORDINGS = 'updateRecordings';
    case GET_RECORDING_TEXT_TRACKS = 'getRecordingTextTracks';
    case PUT_RECORDING_TEXT_TRACK = 'putRecordingTextTrack';
    case HOOKS_CREATE = 'hooks/create';
    case HOOKS_LIST = 'hooks/list';
    case HOOKS_DESTROY = 'hooks/destroy';
    case INSERT_DOCUMENT = 'insertDocument';
    case SEND_CHAT_MESSAGE = 'sendChatMessage';
}
