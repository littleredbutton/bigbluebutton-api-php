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
    /** @var array<string,array{filename: string, downloadable: bool|null, removable: bool|null}> */
    private array $presentations = [];

    public function __construct(protected string $meetingID)
    {
    }

    public function addPresentation(string $nameOrUrl, ?string $content = null, ?string $filename = null, ?bool $downloadable = null, ?bool $removable = null): self
    {
        $this->presentations[$nameOrUrl] = [
            'filename' => $filename,
            'content' => !$content ?: base64_encode($content),
            'downloadable' => $downloadable,
            'removable' => $removable,
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

            foreach ($this->presentations as $nameOrUrl => $data) {
                $document = $module->addChild('document');

                if (str_starts_with($nameOrUrl, 'http')) {
                    $document->addAttribute('url', $nameOrUrl);
                } else {
                    $document->addAttribute('name', $nameOrUrl);
                    /* @phpstan-ignore-next-line */
                    $document[0] = $data['content'];
                }

                if (isset($data['filename'])) {
                    $document->addAttribute('filename', $data['filename']);
                }

                if (\is_bool($data['downloadable'])) {
                    $document->addAttribute('downloadable', $data['downloadable'] ? 'true' : 'false');
                }

                if (\is_bool($data['removable'])) {
                    $document->addAttribute('removable', $data['removable'] ? 'true' : 'false');
                }
            }
            $result = $xml->asXML();
        }

        return $result;
    }
}
