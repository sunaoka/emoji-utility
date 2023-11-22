<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

class Utility
{
    /**
     * @return string[]
     */
    public static function scan(string $string, string $format): array
    {
        /** @var string[] $result */
        $result = sscanf($string, $format);

        return array_map('trim', $result);
    }

    public static function isEmptyLine(string $row): bool
    {
        $row = trim($row);
        return $row === '' || str_starts_with($row, '#');
    }

    /**
     * Generates an array of integers from start to end (inclusive) using their hexadecimal representation.
     *
     * @return int[]
     */
    public static function range(string $start, string $end): array
    {
        /** @var int[] */
        return range(hexdec($start), hexdec($end));
    }
}
