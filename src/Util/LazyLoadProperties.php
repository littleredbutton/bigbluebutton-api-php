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
namespace BigBlueButton\Util;

trait LazyLoadProperties
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * @return $this|mixed|null
     */
    public function __call(string $name, array $arguments)
    {
        if (!preg_match('/^get[A-Z]/', $name)) {
            throw new \BadFunctionCallException($name . ' does not exist');
        }

        $property       = \lcfirst(substr($name, 3));
        $resolverMethod = 'lazyResolve'.$property;

        if (!method_exists($this, $resolverMethod)) {
            throw new \BadFunctionCallException($property . ' does not exist');
        }

        if (array_key_exists($property, $this->cache)) {
            return $this->cache[$property];
        } else {
            return $this->cache[$property] = $this->{$resolverMethod}();
        }
    }
}
