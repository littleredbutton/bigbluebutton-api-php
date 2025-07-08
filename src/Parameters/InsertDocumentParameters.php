<?php

declare(strict_types=1);

/**
 * This file is part of littleredbutton/bigbluebutton-api-php.
 *
 * littleredbutton/bigbluebutton-api-php is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * littleredbutton/bigbluebutton-api-php is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with littleredbutton/bigbluebutton-api-php. If not, see <http://www.gnu.org/licenses/>.
 */

namespace BigBlueButton\Parameters;

/**
 * @method string getMeetingID()
 * @method $this  setMeetingID(string $id)
 */
final class InsertDocumentParameters extends MetaParameters
{
    /** @var array<string,array{filename: string, downloadable: bool|null, removable: bool|null, current: bool|null}> */
    private array $presentations = [];

    public function __construct(protected string $meetingID)
    {
    }

    public function addPresentation(string $url, string $filename, ?bool $downloadable = null, ?bool $removable = null, ?bool $current = null): self
    {
        $this->presentations[$url] = [
            'filename' => $filename,
            'downloadable' => $downloadable,
            'removable' => $removable,
            'current' => $current,
        ];

        return $this;
    }

    public function removePresentation(string $url): self
    {
        unset($this->presentations[$url]);

        return $this;
    }

    public function getPresentationsAsXML(): string|false
    {
        $result = '';

        if (!empty($this->presentations)) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><modules/>');
            $module = $xml->addChild('module');
            $module->addAttribute('name', 'presentation');

            foreach ($this->presentations as $url => $content) {
                $presentation = $module->addChild('document');
                $presentation->addAttribute('url', $url);
                $presentation->addAttribute('filename', $content['filename']);

                if (\is_bool($content['downloadable'])) {
                    $presentation->addAttribute('downloadable', $content['downloadable'] ? 'true' : 'false');
                }

                if (\is_bool($content['removable'])) {
                    $presentation->addAttribute('removable', $content['removable'] ? 'true' : 'false');
                }

                if (\is_bool($content['current'])) {
                    $presentation->addAttribute('current', $content['current'] ? 'true' : 'false');
                }
            }
            $result = $xml->asXML();
        }

        return $result;
    }
}
