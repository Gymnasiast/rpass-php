<?php
/**
 * Copyright © 2017 Tim Kuijsten
 * Copyright © 2017 Michael Steenbeek
 *
 * Permission to use, copy, modify, and/or distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 */
namespace Rpass;

class Rpass
{
    /*
     * Dutch three letter "words" that are both visually and phonetically
     * unambiguous.
     */
    const CHAR1 = "bdfhjklmnprstvwxz"; // drop c, g, q, y = 4 bpc
    const CHAR2 = "aeiou";             // vowels, 2.3 bpc
    const CHAR3 = "fhjklmnprstxz";     // drop b, c, d, g, q, v, w, y = 3.7 bpc

    private $value = '';

    public function __construct($bits = 40.0, $delimiter = ' ')
    {
        if ($bits < 5.0)
        {
            throw new \Exception('Not enough bits!');
        }

        $fbpc = log(strlen(self::CHAR1), 2);
        $sbpc = log(strlen(self::CHAR2), 2);
        $tbpc = log(strlen(self::CHAR3), 2);

        for ($numWords = 0; $bits > 0; $numWords++)
        {
            // random_int: "Generates cryptographically secure pseudo-random integers", according to the PHP documentation.
            // The original C implementation used arc4random_uniform().
            $this->value .= self::CHAR1[random_int(0, strlen(self::CHAR1) - 1)];
            $bits -= $fbpc;

            $this->value .= self::CHAR2[random_int(0, strlen(self::CHAR2) - 1)];
            $bits -= $sbpc;

            $this->value .= self::CHAR3[random_int(0, strlen(self::CHAR3) - 1)];
            $bits -= $tbpc;

            if ($bits > 0 && ($numWords % 2))
            {
                $this->value .= $delimiter;
            }
        }
    }

    public function __toString()
    {
        return $this->value;
    }
}