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

use BigBlueButton\Responses\PutRecordingTextTrackResponse;
use BigBlueButton\TestCase;

final class PutRecordingTextTrackResponseTest extends TestCase
{
    public function testUploadSuccess(): void
    {
        $json = '{
              "response": {
                "messageKey": "upload_text_track_success",
                "message": "Text track uploaded successfully",
                "recordId": "baz",
                "returncode": "SUCCESS"
              }
            }';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertTrue($response->success());
        $this->assertEquals('baz', $response->getRecordID());
        $this->assertTrue($response->isUploadTrackSuccess());
    }

    public function testUploadFailed(): void
    {
        $json = '{
              "response": {
                "messageKey": "upload_text_track_failed",
                "message": "Text track upload failed.",
                "recordId": "baz",
                "returncode": "FAILED"
              }
            }';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertTrue($response->failed());
        $this->assertEquals('baz', $response->getRecordID());
        $this->assertTrue($response->isUploadTrackFailed());
    }

    public function testUploadEmpty(): void
    {
        $json = '{
              "response": {
                "messageKey": "empty_uploaded_text_track",
                "message": "Empty uploaded text track.",
                "returncode": "FAILED"
              }
            }';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertTrue($response->failed());
        $this->assertTrue($response->isUploadTrackEmpty());
    }

    public function testNoRecordings(): void
    {
        $json = '{
              "response": {
                "messageKey": "noRecordings",
                "message": "No recording was found for meeting-id-1234.",
                "returncode": "FAILED"
              }
            }';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertTrue($response->failed());
        $this->assertTrue($response->isNoRecordings());
    }

    public function testInvalidLang(): void
    {
        $json = '{
              "response": {
                "messageKey": "invalidLang",
                "message": "Malformed lang param, received=english",
                "returncode": "FAILED"
              }
            }';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertTrue($response->failed());
        $this->assertTrue($response->isInvalidLang());
    }

    public function testInvalidKind(): void
    {
        $json = '{
              "response": {
                "messageKey": "invalidKind",
                "message": "Invalid kind parameter, expected=\'subtitles|captions\' actual=somethingelse",
                "returncode": "FAILED"
              }
            }';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertTrue($response->failed());
        $this->assertTrue($response->isInvalidKind());
    }

    public function testHandleMissingJsonKeys(): void
    {
        $json = '{}';

        $response = new PutRecordingTextTrackResponse($json);

        $this->assertFalse($response->success());
        $this->assertFalse($response->failed());
        $this->assertFalse($response->hasChecksumError());
        $this->assertEquals('', $response->getRecordID());
        $this->assertFalse($response->isUploadTrackSuccess());
        $this->assertFalse($response->isUploadTrackFailed());
        $this->assertFalse($response->isUploadTrackEmpty());
        $this->assertFalse($response->isNoRecordings());
        $this->assertFalse($response->isInvalidLang());
        $this->assertFalse($response->isInvalidKind());
    }
}
