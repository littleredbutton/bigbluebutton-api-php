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

namespace BigBlueButton\Parameters;

/**
 * Class BaseParameters.
 */
abstract class BaseParameters
{
    /** @var array<string> */
    protected array $ignoreProperties = [];

    /**
     * @param array<mixed> $arguments
     *
     * @return $this|bool|mixed|null
     */
    public function __call(string $name, array $arguments)
    {
        if (!preg_match('/^(get|is|set)[A-Z]/', $name)) {
            throw new \BadFunctionCallException($name.' does not exist');
        }
        if (str_starts_with($name, 'get')) {
            return $this->getter(lcfirst(substr($name, 3)));
        }

        if (str_starts_with($name, 'is')) {
            return $this->booleanGetter(lcfirst(substr($name, 2)));
        }

        if (str_starts_with($name, 'set')) {
            return $this->setter(lcfirst(substr($name, 3)), $arguments);
        }

        return null;
    }

    protected function getter(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \BadFunctionCallException($name.' is not a valid property');
    }

    protected function booleanGetter(string $name): ?bool
    {
        $value = $this->getter($name);

        if (!\is_bool($this->$name) && $this->$name !== null) {
            throw new \BadFunctionCallException($name.' is not a boolean property');
        }

        return $value;
    }

    /** @param array<mixed> $arguments */
    protected function setter(string $name, array $arguments): static
    {
        if (!property_exists($this, $name)) {
            throw new \BadFunctionCallException($name.' is not a valid property');
        }

        $property = new \ReflectionProperty($this, $name);
        $type = $property->getType();

        // Construct enum on demand
        if ($type instanceof \ReflectionNamedType && enum_exists($type->getName()) && !\is_object($arguments[0])) {
            /* @phpstan-ignore-next-line */
            $arguments[0] = ($type->getName())::from($arguments[0]);
        }
        $this->$name = $arguments[0];

        return $this;
    }

    /** @return array<string,mixed> */
    protected function getProperties(): array
    {
        return array_filter(get_object_vars($this), fn ($name) => $name !== 'ignoreProperties' && !\in_array(
            $name,
            $this->ignoreProperties,
            true
        ), \ARRAY_FILTER_USE_KEY);
    }

    /** @return array<string,string> */
    protected function getHTTPQueryArray(): array
    {
        $properties = $this->getProperties();
        $properties = array_filter($properties, fn ($value) => $value !== null);

        return array_map(static function ($value) {
            if (\is_bool($value)) {
                return $value ? 'true' : 'false';
            }

            if ($value instanceof \BackedEnum) {
                $value = $value->value;
            }

            return $value;
        }, $properties);
    }

    public function getHTTPQuery(): string
    {
        return http_build_query($this->getHTTPQueryArray(), '', '&', \PHP_QUERY_RFC3986);
    }
}
