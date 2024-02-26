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

namespace BigBlueButton\Responses;

/**
 * Class DeleteRecordingsResponse.
 */
class DeleteRecordingsResponse extends BaseResponse
{
    /** @deprecated and will be removed in 6.0. Use KEY_NOT_FOUND instead  */
    public const KEY_INVALID_ID = 'InvalidRecordingId';

    public const KEY_NOT_FOUND = 'notFound';

    public function isDeleted(): bool
    {
        return $this->rawXml->deleted->__toString() == 'true';
    }

    /** @deprecated and will be removed in 6.0. Use isNotFound instead  */
    public function isInvalidId(): bool
    {
        return $this->getMessageKey() === self::KEY_INVALID_ID;
    }

    public function isNotFound(): bool
    {
        return $this->getMessageKey() === self::KEY_NOT_FOUND;
    }
}
