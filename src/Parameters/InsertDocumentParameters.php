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

use BigBlueButton\Core\Presentation;
use BigBlueButton\Core\UrlPresentation;
use BigBlueButton\Util\SimpleXMLElementExtended;

/**
 * @method string getMeetingID()
 * @method $this  setMeetingID(string $id)
 */
final class InsertDocumentParameters extends MetaParameters
{
    /** @var array<string,Presentation> */
    private array $presentations = [];

    public function __construct(protected string $meetingID)
    {
    }

    public function addPresentation(string|Presentation $urlOrPresentation, ?string $filename = null, ?bool $downloadable = null, ?bool $removable = null): self
    {
        if ($urlOrPresentation instanceof Presentation) {
            $this->presentations[$urlOrPresentation->getArrayKey()] = $urlOrPresentation;

            return $this;
        }

        @trigger_error(\sprintf('Calling addPresentation in "%s" with any parameters other than a single Presentation object is deprecated and will throw an exception in 7.0.', self::class), \E_USER_DEPRECATED);

        $presentation = new UrlPresentation($urlOrPresentation);

        if ($filename !== null) {
            $presentation->setFilename($filename);
        }
        if ($downloadable !== null) {
            $presentation->setDownloadable($downloadable);
        }
        if ($removable !== null) {
            $presentation->setRemovable($removable);
        }

        $this->presentations[$presentation->getArrayKey()] = $presentation;

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
            $xml = new SimpleXMLElementExtended('<?xml version="1.0" encoding="UTF-8"?><modules/>');
            $module = $xml->addChild('module');
            $module->addAttribute('name', 'presentation');

            foreach ($this->presentations as $content) {
                if ($content instanceof Presentation) {
                    $content->addDocumentToXML($module);
                }
            }
            $result = $xml->asXML();
        }

        return $result;
    }
}
