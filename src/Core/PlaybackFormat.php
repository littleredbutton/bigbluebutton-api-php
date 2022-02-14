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
namespace BigBlueButton\Core;

use BigBlueButton\Util\LazyLoadProperties;

class PlaybackFormat
{
    use LazyLoadProperties;

    /** @var string */
    private $type;

    /** @var string */
    private $url;

    /** @var int */
    private $processingTime;

    /** @var int */
    private $length;

    /** @var array */
    private $imagePreviews;

    /** @var \SimpleXMLElement */
    private $imagePreviewsRaw;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->type               = $xml->type->__toString();
        $this->url                = $xml->url->__toString();
        $this->processingTime     = (int) $xml->processingTime->__toString();
        $this->length             = (int) $xml->length->__toString();

        $this->imagePreviewsRaw   = $xml->preview->images;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getProcessingTime(): int
    {
        return $this->processingTime;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function hasImagePreviews(): bool
    {
        return !!$this->imagePreviewsRaw;
    }

    /**
     *
     * @return array<int, array{width: int, height: int, alt: string, url: string}>
     */
    private function lazyResolveImagePreviews(): array
    {
        $imagePreviews = [];
        if ($this->imagePreviewsRaw) {
            foreach ($this->imagePreviewsRaw->children() as $image) {
                $attributes = $image->attributes();

                $imagePreviews[] = [
                    'width'  => (int) $attributes->width->__toString(),
                    'height' => (int) $attributes->height->__toString(),
                    'alt'    => $attributes->alt->__toString(),
                    'url'    => $image->__toString(),
                ];
            }
        }

        return $imagePreviews;
    }
}
