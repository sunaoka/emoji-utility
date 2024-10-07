<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility;

class Emoji
{
    /**
     * Converts an array of Unicode code points to a UTF-8 string.
     *
     * @param string|string[] $codepoints The array of Unicode code points or a string of space-separated code points to convert.
     *
     * @return string The UTF-8 string representation of the code points, or null if $codepoints is not an array or string.
     */
    public static function fromCodePoints($codepoints): string
    {
        if (is_string($codepoints)) {
            $codepoints = explode(' ', $codepoints);
        }

        $result = [];
        foreach ($codepoints as $codepoint) {
            $result[] = self::codePointsToUTF8String((int) hexdec($codepoint));
        }

        return implode('', $result);
    }


    /**
     * Converts a Unicode code point to a UTF-8 string.
     *
     * @param int $codepoint The Unicode code point to convert.
     *
     * @return string The UTF-8 string representation of the code point.
     */
    public static function codePointsToUTF8String(int $codepoint): string
    {
        if ($codepoint > 0x10000) {
            # 4 bytes
            return chr(0xF0 | (($codepoint & 0x1C0000) >> 18)) .
                chr(0x80 | (($codepoint & 0x3F000) >> 12)) .
                chr(0x80 | (($codepoint & 0xFC0) >> 6)) .
                chr(0x80 | ($codepoint & 0x3F));
        }

        if ($codepoint > 0x800) {
            # 3 bytes
            return chr(0xE0 | (($codepoint & 0xF000) >> 12)) .
                chr(0x80 | (($codepoint & 0xFC0) >> 6)) .
                chr(0x80 | ($codepoint & 0x3F));
        }

        if ($codepoint > 0x80) {
            # 2 bytes
            return chr(0xC0 | (($codepoint & 0x7C0) >> 6)) .
                chr(0x80 | ($codepoint & 0x3F));
        }

        # 1 byte
        return chr($codepoint);
    }
}
