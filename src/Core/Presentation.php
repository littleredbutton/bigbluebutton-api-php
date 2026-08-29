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

abstract class Presentation
{
    protected ?string $filename = null;

    protected ?bool $current = null;

    protected ?bool $downloadable = null;

    protected ?bool $removable = null;

    public function addDocumentToXML(SimpleXMLElementExtended $module): ?SimpleXMLElementExtended
    {
        $document = $module->addChild('document');

        if (\is_bool($this->downloadable)) {
            $document->addAttribute('downloadable', $this->downloadable ? 'true' : 'false');
        }

        if (\is_bool($this->removable)) {
            $document->addAttribute('removable', $this->removable ? 'true' : 'false');
        }

        if (\is_bool($this->current)) {
            $document->addAttribute('current', $this->current ? 'true' : 'false');
        }

        return $document;
    }

    abstract public function getArrayKey(): string;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getCurrent(): ?bool
    {
        return $this->current;
    }

    public function setCurrent(bool $current): self
    {
        $this->current = $current;

        return $this;
    }

    public function getDownloadable(): ?bool
    {
        return $this->downloadable;
    }

    public function setDownloadable(bool $downloadable): self
    {
        $this->downloadable = $downloadable;

        return $this;
    }

    public function getRemovable(): ?bool
    {
        return $this->removable;
    }

    public function setRemovable(bool $removable): self
    {
        $this->removable = $removable;

        return $this;
    }
}
