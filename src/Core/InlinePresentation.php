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

use BigBlueButton\Util\SimpleXMLElementExtended;

final class InlinePresentation extends Presentation
{
    public function __construct(private readonly string $content, string $filename)
    {
        $this->filename = $filename;
    }

    public function getArrayKey(): string
    {
        return $this->filename;
    }

    public function addDocumentToXML(SimpleXMLElementExtended $module): ?SimpleXMLElementExtended
    {
        $document = parent::addDocumentToXML($module);

        /* @phpstan-ignore-next-line */
        $document[0] = base64_encode($this->content);

        if (isset($this->filename)) {
            $document->addAttribute('name', $this->filename);
        }

        return $document;
    }
}
