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

namespace BigBlueButton\Core;

/* @deprecated and will be removed in 6.0. Use \BigBlueButton\Enum\ApiMethod instead */
final class ApiMethod
{
    public const CREATE = \BigBlueButton\Enum\ApiMethod::CREATE;
    public const JOIN = \BigBlueButton\Enum\ApiMethod::JOIN;
    public const END = \BigBlueButton\Enum\ApiMethod::END;
    public const IS_MEETING_RUNNING = \BigBlueButton\Enum\ApiMethod::IS_MEETING_RUNNING;
    public const GET_MEETING_INFO = \BigBlueButton\Enum\ApiMethod::GET_MEETING_INFO;
    public const GET_MEETINGS = \BigBlueButton\Enum\ApiMethod::GET_MEETINGS;
    public const GET_RECORDINGS = \BigBlueButton\Enum\ApiMethod::GET_RECORDINGS;
    public const PUBLISH_RECORDINGS = \BigBlueButton\Enum\ApiMethod::PUBLISH_RECORDINGS;
    public const DELETE_RECORDINGS = \BigBlueButton\Enum\ApiMethod::DELETE_RECORDINGS;
    public const UPDATE_RECORDINGS = \BigBlueButton\Enum\ApiMethod::UPDATE_RECORDINGS;
    public const GET_RECORDING_TEXT_TRACKS = \BigBlueButton\Enum\ApiMethod::GET_RECORDING_TEXT_TRACKS;
    public const PUT_RECORDING_TEXT_TRACK = \BigBlueButton\Enum\ApiMethod::PUT_RECORDING_TEXT_TRACK;
    public const HOOKS_CREATE = \BigBlueButton\Enum\ApiMethod::HOOKS_CREATE;
    public const HOOKS_LIST = \BigBlueButton\Enum\ApiMethod::HOOKS_LIST;
    public const HOOKS_DESTROY = \BigBlueButton\Enum\ApiMethod::HOOKS_DESTROY;
    public const INSERT_DOCUMENT = \BigBlueButton\Enum\ApiMethod::INSERT_DOCUMENT;
}
