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

namespace BigBlueButton;

use BigBlueButton\Core\ApiMethod;
use BigBlueButton\Enum\HashingAlgorithm;
use BigBlueButton\Exceptions\ConfigException;
use BigBlueButton\Exceptions\NetworkException;
use BigBlueButton\Exceptions\ParsingException;
use BigBlueButton\Http\Transport\TransportInterface;
use BigBlueButton\Http\Transport\TransportResponse;
use BigBlueButton\Parameters\DeleteRecordingsParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\GetRecordingTextTracksParameters;
use BigBlueButton\Parameters\HooksCreateParameters;
use BigBlueButton\Parameters\HooksDestroyParameters;
use BigBlueButton\Parameters\HooksListParameters;
use BigBlueButton\Parameters\InsertDocumentParameters;
use BigBlueButton\Parameters\PublishRecordingsParameters;
use BigBlueButton\Parameters\PutRecordingTextTrackParameters;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class BigBlueButtonTest.
 */
final class BigBlueButtonTest extends TestCase
{
    /** @var MockObject */
    private $transport;

    /**
     * @var BigBlueButton
     */
    private $bbb;

    /**
     * Setup test class.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->transport = $this->createMock(TransportInterface::class);
        $this->bbb = new BigBlueButton('http://localhost/', null, $this->transport);
    }

    public function testMissingUrl()
    {
        $this->expectException(ConfigException::class);

        $previousEnvironmentValue = getenv('BBB_SERVER_BASE_URL');
        putenv('BBB_SERVER_BASE_URL=');

        try {
            new BigBlueButton('');
        } finally {
            putenv('BBB_SERVER_BASE_URL='.$previousEnvironmentValue);
        }
    }

    public function testNetworkFailure()
    {
        $this->expectException(NetworkException::class);

        $this->transport->method('request')->willThrowException(new NetworkException());

        $params = $this->generateCreateParams();

        $this->bbb->createMeeting($this->getCreateMock($params));
    }

    public function testInvalidXMLResponse()
    {
        $this->expectException(ParsingException::class);

        $this->transport->method('request')->willReturn(new TransportResponse('foobar', null));

        $params = $this->generateCreateParams();

        $this->bbb->createMeeting($this->getCreateMock($params));
    }

    public function testJSessionId()
    {
        $id = 'foobar';
        $this->transport->method('request')->willReturn(new TransportResponse('<x></x>', $id));

        $params = $this->generateCreateParams();

        $this->bbb->createMeeting($this->getCreateMock($params));

        $this->assertEquals($id, $this->bbb->getJSessionId());
    }

    public function testApiVersion()
    {
        $apiVersion = '2.0';
        $xml = "<response>
            <returncode>SUCCESS</returncode>
            <version>2.0</version>
            <apiVersion>$apiVersion</apiVersion>
            <bbbVersion/>
        </response>";
        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->getApiVersion();

        $this->assertEquals($apiVersion, $response->getVersion());
    }

    public function testIsConnectionWorking()
    {
        $xmlSuccess = '<response>
            <returncode>SUCCESS</returncode>
            <running>false</running>
        </response>';
        $xmlFailure = '<response>
            <returncode>FAILED</returncode>
            <running>false</running>
        </response>';
        $xmlChecksumError = '<response>
            <returncode>FAILED</returncode>
            <messageKey>checksumError</messageKey>
        </response>';

        $this->transport->method('request')->willReturnOnConsecutiveCalls(
            new TransportResponse($xmlSuccess, null),
            new TransportResponse($xmlFailure, null),
            new TransportResponse($xmlChecksumError, null),
            new TransportResponse('', null)
        );

        $this->assertTrue($this->bbb->isConnectionWorking(), 'Connection is working');

        $this->assertFalse($this->bbb->isConnectionWorking(), 'Connection is not working, because failure is returned');

        $this->assertFalse($this->bbb->isConnectionWorking(), 'Connection is not working, because checksum error');
        $this->assertEquals(BigBlueButton::CONNECTION_ERROR_SECRET, $this->bbb->getConnectionError());

        $this->assertFalse($this->bbb->isConnectionWorking(), 'Connection is not working, because XML is invalid');
        $this->assertEquals(BigBlueButton::CONNECTION_ERROR_BASEURL, $this->bbb->getConnectionError());
    }

    /* Create Meeting */

    /**
     * Test create meeting URL.
     */
    public function testCreateMeetingUrl()
    {
        $params = $this->generateCreateParams();
        $url = $this->bbb->getCreateMeetingUrl($this->getCreateMock($params));

        $this->assertUrlContainsAllRequestParameters($url, $params);
    }

    /* Join Meeting */

    /**
     * Test create join meeting URL.
     */
    public function testCreateJoinMeetingUrl()
    {
        $joinMeetingParams = $this->generateJoinMeetingParams();
        $joinMeetingMock = $this->getJoinMeetingMock($joinMeetingParams);

        $url = $this->bbb->getJoinMeetingURL($joinMeetingMock);

        foreach ($joinMeetingParams as $key => $value) {
            if (\is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $this->assertStringContainsString(rawurlencode($key).'='.rawurlencode($value), $url);
        }
    }

    public function testJoinMeeting()
    {
        $joinMeetingParams = $this->generateJoinMeetingParams();
        $params = $this->getJoinMeetingMock($joinMeetingParams);
        $xml = "<response>
            <returncode>SUCCESS</returncode>
            <messageKey>successfullyJoined</messageKey>
            <message>You have joined successfully.</message>
            <meeting_id>{$params->getMeetingID()}</meeting_id>
            <user_id>{$params->getUserID()}</user_id>
            <auth_token>14mm5y3eurjw</auth_token>
            <session_token>ai1wqj8wb6s7rnk0</session_token>
            <url>https://yourserver.com/client/BigBlueButton.html?sessionToken=ai1wqj8wb6s7rnk0</url>
        </response>";

        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->joinMeeting($params);

        $this->assertEquals($params->getMeetingID(), $response->getMeetingId());
        $this->assertEquals($params->getUserID(), $response->getUserId());
        $this->assertEquals('14mm5y3eurjw', $response->getAuthToken());
        $this->assertEquals('ai1wqj8wb6s7rnk0', $response->getSessionToken());
        $this->assertEquals('', $response->getGuestStatus());
        $this->assertEquals('https://yourserver.com/client/BigBlueButton.html?sessionToken=ai1wqj8wb6s7rnk0', $response->getUrl());
        $this->assertTrue($response->isSuccessfullyJoined());
        $this->assertFalse($response->isSessionInvalid());
        $this->assertFalse($response->isServerError());
        $this->assertFalse($response->isGuestDeny());
    }

    /* End Meeting */

    /**
     * Test generate end meeting URL.
     */
    public function testCreateEndMeetingUrl()
    {
        $params = $this->generateEndMeetingParams();
        $url = $this->bbb->getEndMeetingURL($this->getEndMeetingMock($params));
        foreach ($params as $key => $value) {
            if (\is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $this->assertStringContainsString(rawurlencode($key).'='.rawurlencode($value), $url);
        }
    }

    public function testEndMeeting()
    {
        $data = $this->generateEndMeetingParams();
        $params = $this->getEndMeetingMock($data);
        $xml = '<response>
            <returncode>SUCCESS</returncode>
            <messageKey>sentEndMeetingRequest</messageKey>
            <message>foobar</message>
        </response>';

        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->endMeeting($params);

        $this->assertEquals('foobar', $response->getMessage());
        $this->assertTrue($response->isEndMeetingRequestSent());
    }

    /* Get Meetings */

    public function testGetMeetingsUrl()
    {
        $url = $this->bbb->getMeetingsUrl();
        $this->assertStringContainsString(ApiMethod::GET_MEETINGS, $url);
    }

    public function testGetMeetings()
    {
        $xml = '<response>
            <returncode>SUCCESS</returncode>
            <meetings>
                <meeting>
                    <meetingName>Demo Meeting</meetingName>
                    <meetingID>Demo Meeting ID</meetingID>
                    <internalMeetingID>12345</internalMeetingID>
                    <createTime>1531241258036</createTime>
                    <createDate>Tue Jul 10 16:47:38 UTC 2018</createDate>
                    <voiceBridge>70066</voiceBridge>
                    <dialNumber>613-555-1234</dialNumber>
                    <attendeePW>ap</attendeePW>
                    <moderatorPW>mp</moderatorPW>
                    <running>false</running>
                    <duration>0</duration>
                    <hasUserJoined>false</hasUserJoined>
                    <recording>false</recording>
                    <hasBeenForciblyEnded>false</hasBeenForciblyEnded>
                    <startTime>1531241258074</startTime>
                    <endTime>0</endTime>
                    <participantCount>0</participantCount>
                    <listenerCount>0</listenerCount>
                    <voiceParticipantCount>0</voiceParticipantCount>
                    <videoCount>0</videoCount>
                    <maxUsers>0</maxUsers>
                    <moderatorCount>0</moderatorCount>
                    <attendees />
                    <metadata />
                    <isBreakout>false</isBreakout>
                </meeting>
            </meetings>
        </response>';

        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->getMeetings();

        $this->assertCount(1, $response->getMeetings());
        $this->assertEquals('Demo Meeting', $response->getMeetings()[0]->getMeetingName());
        $this->assertEquals('Demo Meeting ID', $response->getMeetings()[0]->getMeetingId());
        $this->assertEquals('12345', $response->getMeetings()[0]->getInternalMeetingId());
        $this->assertEquals(1531241258036, $response->getMeetings()[0]->getCreationTime());
        $this->assertEquals('Tue Jul 10 16:47:38 UTC 2018', $response->getMeetings()[0]->getCreationDate());
        $this->assertEquals('70066', $response->getMeetings()[0]->getVoiceBridge());
        $this->assertEquals('613-555-1234', $response->getMeetings()[0]->getDialNumber());
        $this->assertEquals('ap', $response->getMeetings()[0]->getAttendeePassword());
        $this->assertEquals('mp', $response->getMeetings()[0]->getModeratorPassword());
        $this->assertFalse($response->getMeetings()[0]->isRunning());
        $this->assertEquals(0, $response->getMeetings()[0]->getDuration());
        $this->assertFalse($response->getMeetings()[0]->hasUserJoined());
    }

    /* Get meeting info */

    public function testGetRecordingsUrl()
    {
        $url = $this->bbb->getRecordingsUrl(new GetRecordingsParameters());
        $this->assertStringContainsString(ApiMethod::GET_RECORDINGS, $url);
    }

    public function testPublishRecordingsUrl()
    {
        $url = $this->bbb->getPublishRecordingsUrl(new PublishRecordingsParameters($this->faker->sha1, true));
        $this->assertStringContainsString(ApiMethod::PUBLISH_RECORDINGS, $url);
    }

    public function testDeleteRecordingsUrl()
    {
        $url = $this->bbb->getDeleteRecordingsUrl(new DeleteRecordingsParameters($this->faker->sha1));
        $this->assertStringContainsString(ApiMethod::DELETE_RECORDINGS, $url);
    }

    public function testUpdateRecordingsUrl()
    {
        $params = $this->generateUpdateRecordingsParams();
        $url = $this->bbb->getUpdateRecordingsUrl($this->getUpdateRecordingsParamsMock($params));
        foreach ($params as $key => $value) {
            if (\is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $this->assertStringContainsString(rawurlencode($key).'='.rawurlencode($value), $url);
        }
    }

    public function testBuildUrl(): void
    {
        // Test with default hash algorithm (sha1)
        $bigBlueButton = new BigBlueButton('https://bbb.example/bigbluebutton/', 'S3cr3t', null, HashingAlgorithm::SHA_1);

        $this->assertSame(
            'https://bbb.example/bigbluebutton/api/foo?foo=bar&baz=bazinga&checksum=694ad46bc5a79a572bab6c8b9a939527c39ac7f6',
            $bigBlueButton->buildUrl('foo', 'foo=bar&baz=bazinga'),
            'URL is not ok'
        );

        // Test with different hash algorithm (sha256)
        $bigBlueButton = new BigBlueButton('https://bbb.example/bigbluebutton/', 'S3cr3t', null, HashingAlgorithm::SHA_256);

        $this->assertSame(
            'https://bbb.example/bigbluebutton/api/foo?foo=bar&baz=bazinga&checksum=0ce0d779a8220be9824c7eab055b36b59ac504ba899a76d7c528b8473960025e',
            $bigBlueButton->buildUrl('foo', 'foo=bar&baz=bazinga'),
            'URL is not ok'
        );
    }

    public function testGetInsertDocument(): void
    {
        $params = new InsertDocumentParameters('foobar');

        $this->assertStringContainsString('http://localhost/api/insertDocument?meetingID=foobar', $this->bbb->getInsertDocumentUrl($params));

        $this->transport->method('request')->willReturn(new TransportResponse('<response><returncode>SUCCESS</returncode></response>', null));

        $response = $this->bbb->insertDocument($params);

        $this->assertTrue($response->success());
    }

    public function testGetRecordingTextTracks(): void
    {
        $params = new GetRecordingTextTracksParameters('foobar');

        $json = '{
              "response": {
                "returncode": "SUCCESS",
                "tracks": [
                  {
                    "href": "https://captions.example.com/textTrack/0ab39e419c9bcb63233168daefe390f232c71343/183f0bf3a0982a127bdb8161e0c44eb696b3e75c-1554230749920/subtitles_en-US.vtt",
                    "kind": "subtitles",
                    "label": "English",
                    "lang": "en-US",
                    "source": "upload"
                  },
                  {
                    "href": "https://captions.example.com/textTrack/95b62d1b762700b9d5366a9e71d5fcc5086f2723/183f0bf3a0982a127bdb8161e0c44eb696b3e75c-1554230749920/subtitles_pt-BR.vtt",
                    "kind": "subtitles",
                    "label": "Brazil",
                    "lang": "pt-BR",
                    "source": "upload"
                  }
                ]
              }
            }';
        $this->transport->method('request')->willReturn(new TransportResponse($json, null));

        $response = $this->bbb->getRecordingTextTracks($params);

        $this->assertTrue($response->success());
        $this->assertSame('SUCCESS', $response->getReturnCode());

        $tracks = $response->getTracks();
        $this->assertCount(2, $tracks);
        $this->assertArrayHasKey(0, $tracks);
        $this->assertArrayHasKey(1, $tracks);

        $this->assertSame('https://captions.example.com/textTrack/0ab39e419c9bcb63233168daefe390f232c71343/183f0bf3a0982a127bdb8161e0c44eb696b3e75c-1554230749920/subtitles_en-US.vtt', $tracks[0]->getHref());
        $this->assertSame('subtitles', $tracks[0]->getKind());
        $this->assertSame('English', $tracks[0]->getLabel());
        $this->assertSame('en-US', $tracks[0]->getLang());
        $this->assertSame('upload', $tracks[0]->getSource());

        $this->assertSame('https://captions.example.com/textTrack/95b62d1b762700b9d5366a9e71d5fcc5086f2723/183f0bf3a0982a127bdb8161e0c44eb696b3e75c-1554230749920/subtitles_pt-BR.vtt', $tracks[1]->getHref());
        $this->assertSame('subtitles', $tracks[1]->getKind());
        $this->assertSame('Brazil', $tracks[1]->getLabel());
        $this->assertSame('pt-BR', $tracks[1]->getLang());
        $this->assertSame('upload', $tracks[1]->getSource());
    }

    public function testPutRecordingTextTrack(): void
    {
        $params = new PutRecordingTextTrackParameters('foobar', 'subtitles', 'en-US', 'English');

        $json = '{
              "response": {
                "messageKey": "upload_text_track_success",
                "message": "Text track uploaded successfully",
                "recordId": "baz",
                "returncode": "SUCCESS"
              }
            }';
        $this->transport->method('request')->willReturn(new TransportResponse($json, null));

        $response = $this->bbb->putRecordingTextTrack($params);

        $this->assertTrue($response->success());
        $this->assertNull($response->getMessageKey());
        $this->assertNull($response->getMessage());
        $this->assertSame('baz', $response->getRecordID());
        $this->assertSame('SUCCESS', $response->getReturnCode());
    }

    public function testHooksCreate(): void
    {
        $params = new HooksCreateParameters($this->faker->url);

        $xml = '<response>
          <returncode>SUCCESS</returncode>
          <hookID>1</hookID>
          <permanentHook>false</permanentHook>
          <rawData>false</rawData>
        </response>';

        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->hooksCreate($params);

        $this->assertTrue($response->success());
        $this->assertSame(1, $response->getHookId());
        $this->assertFalse($response->isPermanentHook());
        $this->assertFalse($response->hasRawData());
    }

    public function testHooksList(): void
    {
        $params = new HooksListParameters();

        $xml = '<response>
          <returncode>SUCCESS</returncode>
          <hooks>
            <hook>
              <hookID>1</hookID>
              <callbackURL><![CDATA[http://postcatcher.in/catchers/abcdefghijk]]></callbackURL>
              <meetingID><![CDATA[my-meeting]]></meetingID>
              <permanentHook>false</permanentHook>
              <rawData>false</rawData>
            </hook>
            <hook>
              <hookID>2</hookID>
              <callbackURL><![CDATA[http://postcatcher.in/catchers/1234567890]]></callbackURL>
              <permanentHook>false</permanentHook>
              <rawData>false</rawData>
            </hook>
          </hooks>
        </response>';

        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->hooksList($params);

        $this->assertTrue($response->success());
        $this->assertCount(2, $response->getHooks());

        // Hook for a single meeting
        $meetingHook = $response->getHooks()[0];
        $this->assertSame(1, $meetingHook->getHookId());
        $this->assertSame('http://postcatcher.in/catchers/abcdefghijk', $meetingHook->getCallbackURL());
        $this->assertSame('my-meeting', $meetingHook->getMeetingID());
        $this->assertFalse($meetingHook->isPermanentHook());
        $this->assertFalse($meetingHook->hasRawData());

        // Global hook
        $globalHook = $response->getHooks()[1];
        $this->assertSame(2, $globalHook->getHookId());
        $this->assertSame('http://postcatcher.in/catchers/1234567890', $globalHook->getCallbackURL());
        $this->assertFalse($globalHook->isPermanentHook());
        $this->assertFalse($globalHook->hasRawData());
    }

    public function testHookDestroy(): void
    {
        $params = new HooksDestroyParameters(1);

        $xml = '<response>
          <returncode>SUCCESS</returncode>
          <removed>true</removed>
        </response>';

        $this->transport->method('request')->willReturn(new TransportResponse($xml, null));

        $response = $this->bbb->hooksDestroy($params);

        $this->assertTrue($response->success());
        $this->assertTrue($response->removed());
    }
}
