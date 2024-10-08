<?php

declare(strict_types=1);

/**
 * Copyright (c) 2015 Michael Dowling, https://github.com/mtdowling <mtdowling@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace BigBlueButton\Http;

/**
 * Value object for HTTP cookies,
 * based on https://github.com/guzzle/guzzle/blob/master/src/Cookie/SetCookie.php.
 *
 * @internal
 */
final class SetCookie implements \Stringable
{
    /** @var array<string,string|bool|int|null> */
    private static array $defaults = [
        'Name' => null,
        'Value' => null,
        'Domain' => null,
        'Path' => '/',
        'Max-Age' => null,
        'Expires' => null,
        'Secure' => false,
        'Discard' => false,
        'HttpOnly' => false,
    ];

    /**
     * @var array<string,string|bool|int|null> Cookie data
     */
    private ?array $data;

    /**
     * Create a new SetCookie object from a string.
     *
     * @param string $cookie Set-Cookie header string
     */
    public static function fromString(string $cookie): self
    {
        // Create the default return array
        $data = self::$defaults;
        // Explode the cookie string using a series of semicolons
        $pieces = array_filter(array_map('trim', explode(';', $cookie)));
        // The name of the cookie (first kvp) must exist and include an equal sign.
        if (!isset($pieces[0]) || !str_contains($pieces[0], '=')) {
            return new self($data);
        }

        // Add the cookie pieces into the parsed data array
        foreach ($pieces as $part) {
            $cookieParts = explode('=', $part, 2);
            $key = trim($cookieParts[0]);
            $value = isset($cookieParts[1])
                ? trim($cookieParts[1], " \n\r\t\0\x0B")
                : true;

            // Only check for non-cookies when cookies have been found
            if (!isset($data['Name'])) {
                $data['Name'] = $key;
                $data['Value'] = $value;
            } else {
                foreach (array_keys(self::$defaults) as $search) {
                    if (!strcasecmp($search, $key)) {
                        $data[$search] = $value;

                        continue 2;
                    }
                }
                $data[$key] = $value;
            }
        }

        return new self($data);
    }

    /**
     * @param array<string,string|int> $data Array of cookie data provided by a Cookie parser
     */
    public function __construct(array $data = [])
    {
        $this->data = array_replace(self::$defaults, $data);
        // Extract the Expires value and turn it into a UNIX timestamp if needed
        if (!$this->getExpires() && $this->getMaxAge()) {
            // Calculate the Expires date
            $this->setExpires(time() + $this->getMaxAge());
        } elseif (null !== ($expires = $this->getExpires()) && !is_numeric($expires)) {
            $this->setExpires($expires);
        }
    }

    public function __toString(): string
    {
        $str = $this->data['Name'].'='.$this->data['Value'].'; ';
        foreach ($this->data as $k => $v) {
            if ($k !== 'Name' && $k !== 'Value' && $v !== null && $v !== false) {
                if ($k === 'Expires') {
                    $str .= 'Expires='.gmdate('D, d M Y H:i:s \G\M\T', (int) $v).'; ';
                } else {
                    $str .= ($v === true ? $k : "{$k}={$v}").'; ';
                }
            }
        }

        return rtrim($str, '; ');
    }

    /** @return array<string,string|bool|int|null> */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Get the cookie name.
     */
    public function getName(): string
    {
        return $this->data['Name'];
    }

    /**
     * Set the cookie name.
     *
     * @param string $name Cookie name
     */
    public function setName(string $name): void
    {
        $this->data['Name'] = $name;
    }

    /**
     * Get the cookie value.
     */
    public function getValue(): ?string
    {
        return $this->data['Value'];
    }

    /**
     * Set the cookie value.
     *
     * @param string $value Cookie value
     */
    public function setValue(string $value): void
    {
        $this->data['Value'] = $value;
    }

    /**
     * Get the domain.
     */
    public function getDomain(): ?string
    {
        return $this->data['Domain'];
    }

    /**
     * Set the domain of the cookie.
     */
    public function setDomain(string $domain): void
    {
        $this->data['Domain'] = $domain;
    }

    /**
     * Get the path.
     */
    public function getPath(): string
    {
        return $this->data['Path'];
    }

    /**
     * Set the path of the cookie.
     *
     * @param string $path Path of the cookie
     */
    public function setPath(string $path): void
    {
        $this->data['Path'] = $path;
    }

    /**
     * Maximum lifetime of the cookie in seconds.
     */
    public function getMaxAge(): ?int
    {
        return $this->data['Max-Age'] === null ? null : (int) $this->data['Max-Age'];
    }

    /**
     * Set the max-age of the cookie.
     *
     * @param int $maxAge Max age of the cookie in seconds
     */
    public function setMaxAge(int $maxAge): void
    {
        $this->data['Max-Age'] = $maxAge;
    }

    /**
     * The UNIX timestamp when the cookie Expires.
     */
    public function getExpires(): int|string|null
    {
        return $this->data['Expires'];
    }

    /**
     * Set the unix timestamp for which the cookie will expire.
     *
     * @param int|string $timestamp unix timestamp or any English textual datetime description
     */
    public function setExpires(int|string $timestamp): void
    {
        $this->data['Expires'] = is_numeric($timestamp)
            ? (int) $timestamp
            : strtotime($timestamp);
    }

    /**
     * Get whether or not this is a secure cookie.
     */
    public function getSecure(): ?bool
    {
        return $this->data['Secure'];
    }

    /**
     * Set whether or not the cookie is secure.
     *
     * @param bool $secure Set to true or false if secure
     */
    public function setSecure(bool $secure): void
    {
        $this->data['Secure'] = $secure;
    }

    /**
     * Get whether or not this is a session cookie.
     */
    public function getDiscard(): ?bool
    {
        return $this->data['Discard'];
    }

    /**
     * Set whether or not this is a session cookie.
     *
     * @param bool $discard Set to true or false if this is a session cookie
     */
    public function setDiscard(bool $discard): void
    {
        $this->data['Discard'] = $discard;
    }

    /**
     * Get whether or not this is an HTTP only cookie.
     */
    public function getHttpOnly(): bool
    {
        return (bool) $this->data['HttpOnly'];
    }

    /**
     * Set whether or not this is an HTTP only cookie.
     *
     * @param bool $httpOnly Set to true or false if this is HTTP only
     */
    public function setHttpOnly(bool $httpOnly): void
    {
        $this->data['HttpOnly'] = $httpOnly;
    }

    /**
     * Check if the cookie matches a path value.
     *
     * A request-path path-matches a given cookie-path if at least one of
     * the following conditions holds:
     *
     * - The cookie-path and the request-path are identical.
     * - The cookie-path is a prefix of the request-path, and the last
     *   character of the cookie-path is %x2F ("/").
     * - The cookie-path is a prefix of the request-path, and the first
     *   character of the request-path that is not included in the cookie-
     *   path is a %x2F ("/") character.
     *
     * @param string $requestPath Path to check against
     */
    public function matchesPath(string $requestPath): bool
    {
        $cookiePath = $this->getPath();

        // Match on exact matches or when path is the default empty "/"
        if ($cookiePath === '/' || $cookiePath === $requestPath) {
            return true;
        }

        // Ensure that the cookie-path is a prefix of the request path.
        if (!str_starts_with($requestPath, $cookiePath)) {
            return false;
        }

        // Match if the last character of the cookie-path is "/"
        if (str_ends_with($cookiePath, '/')) {
            return true;
        }

        // Match if the first character not included in cookie path is "/"
        return $requestPath[\strlen($cookiePath)] === '/';
    }

    /**
     * Check if the cookie matches a domain value.
     *
     * @param string $domain Domain to check against
     */
    public function matchesDomain(string $domain): bool
    {
        $cookieDomain = $this->getDomain();
        if (null === $cookieDomain) {
            return true;
        }

        // Remove the leading '.' as per spec in RFC 6265.
        // https://tools.ietf.org/html/rfc6265#section-5.2.3
        $cookieDomain = ltrim($cookieDomain, '.');

        // Domain not set or exact match.
        if (!$cookieDomain || !strcasecmp($domain, $cookieDomain)) {
            return true;
        }

        // Matching the subdomain according to RFC 6265.
        // https://tools.ietf.org/html/rfc6265#section-5.1.3
        if (filter_var($domain, \FILTER_VALIDATE_IP)) {
            return false;
        }

        return (bool) preg_match('/\.'.preg_quote($cookieDomain, '/').'$/', $domain);
    }

    /**
     * Check if the cookie is expired.
     */
    public function isExpired(): bool
    {
        return $this->getExpires() !== null && time() > $this->getExpires();
    }

    /**
     * Check if the cookie is valid according to RFC 6265.
     *
     * @return bool|string Returns true if valid or an error message if invalid
     */
    public function validate(): bool|string
    {
        $name = $this->getName();
        if ($name === '') {
            return 'The cookie name must not be empty';
        }

        // Check if any of the invalid characters are present in the cookie name
        if (preg_match(
            '/[\x00-\x20\x22\x28-\x29\x2c\x2f\x3a-\x40\x5c\x7b\x7d\x7f]/',
            $name
        )) {
            return 'Cookie name must not contain invalid characters: ASCII '
                .'Control characters (0-31;127), space, tab and the '
                .'following characters: ()<>@,;:\"/?={}';
        }

        // Value must not be null. 0 and empty string are valid. Empty strings
        // are technically against RFC 6265, but known to happen in the wild.
        $value = $this->getValue();
        if ($value === null) {
            return 'The cookie value must not be empty';
        }

        // Domains must not be empty, but can be 0. "0" is not a valid internet
        // domain, but may be used as server name in a private network.
        $domain = $this->getDomain();
        if ($domain === null || $domain === '') {
            return 'The cookie domain must not be empty';
        }

        return true;
    }
}
