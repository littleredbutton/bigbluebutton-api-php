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

namespace BigBlueButton\Util;

use BigBlueButton\Enum\ApiMethod;
use BigBlueButton\Enum\HashingAlgorithm;

/**
 * Class UrlBuilder.
 *
 * @internal
 */
final class UrlBuilder
{
    public function __construct(
        private readonly string $securitySalt,
        private readonly string $bbbServerBaseUrl,
        private readonly HashingAlgorithm $hashingAlgorithm,
    ) {
    }

    /**
     * Builds an API method URL that includes the url + params + its generated checksum.
     */
    public function buildUrl(string|ApiMethod $method = '', string $params = '', bool $append = true): string
    {
        if ($method instanceof ApiMethod) {
            $method = $method->value;
        }

        return $this->bbbServerBaseUrl.'api/'.$method.($append ? '?'.$this->buildQs($method, $params) : '');
    }

    /**
     * Builds a query string for an API method URL that includes the params + its generated checksum.
     */
    public function buildQs(string $method = '', string $params = ''): string
    {
        // Avoid extra & if we have no params at all
        if ('' !== $params) {
            $checksumParam = '&checksum=';
        } else {
            $checksumParam = 'checksum=';
        }

        return $params.$checksumParam.hash($this->hashingAlgorithm->value, $method.$params.$this->securitySalt);
    }
}
