<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

use LogicException;

trait ParserTrait
{
    protected function scan(string $string, string $format): array
    {
        $result = sscanf($string, $format);
        return array_map('trim', $result);
    }

    protected function sort(array $array, string $key, int $sortOrder): array
    {
        $sort = [];
        foreach ($array as $row) {
            $sort[] = $row[$key];
        }
        array_multisort($sort, $sortOrder, SORT_REGULAR, $array);
        return $array;
    }

    /**
     * @return string|false
     */
    protected function getValue(string $row, string $key)
    {
        if (strpos($row, $key) !== 0) {
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
}
