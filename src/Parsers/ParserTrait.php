<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

use InvalidArgumentException;
use LogicException;

trait ParserTrait
{
    /**
     * @return string[]
     */
    protected function scan(string $string, string $format): array
    {
        /** @var string[] $result */
        $result = sscanf($string, $format);

        return array_map('trim', $result);
    }

    /**
     * @template T
     *
     * @param array<int, T> $array
     *
     * @return array<int, T>
     */
    protected function sort(array $array, string $key, int $order): array
    {
        $sort = [];
        foreach ($array as $row) {
            $sort[] = $row[$key];
        }

        array_multisort($sort, $order, SORT_REGULAR, $array);

        return $array;
    }

    /**
     * @param string[] $rows
     *
     * @return array{date: string, version: string}
     */
    protected function getHeader(array $rows): array
    {
        $result = [
            'date'    => null,
            'version' => null,
        ];

        foreach ($rows as $row) {
            if (($value = $this->getValue($row, '# Date:')) !== false) {
                $result['date'] = trim($value);
            }
            if (($value = $this->getValue($row, '# Version:')) !== false) {
                $result['version'] = trim($value);
            }

            // emoji-variation-sequences.txt 14.0 or later
            if (($value = $this->getValue($row, '# Used with Emoji Version')) !== false) {
                $result['version'] = (string)strstr($value, ' ', true);
            }

            if (isset($result['date'], $result['version'])) {
                return $result;
            }
        }

        throw new InvalidArgumentException('Date and/or Version not found.');
    }

    /**
     * @return string|false
     */
    protected function getValue(string $row, string $key)
    {
        if (!str_starts_with($row, $key)) {
            return false;
        }

        return substr($row, strlen($key) + 1);
    }

    protected function load(string $path): string
    {
        if (!is_readable($path)) {
            throw new LogicException("{$path}: No such file");
        }

        /** @var string */
        return file_get_contents($path);
    }

    protected function isEmptyLine(string $row): bool
    {
        $row = trim($row);
        return $row === '' || str_starts_with($row, '#');
    }


    /**
     * Generates an array of integers from start to end (inclusive) using their hexadecimal representation.
     *
     * @return int[]
     */
    private function range(string $start, string $end): array
    {
        /** @var int[] */
        return range(hexdec($start), hexdec($end));
    }
}
