<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

use LogicException;

class EmojiTest
{
    private const URL = 'https://unicode.org/Public/emoji/%s/emoji-test.txt';

    /**
     * Parse emoji-test.txt
     *
     * @param string $path path of emoji-test.txt
     * @param array{sort?: ?int}  $options
     *
     * @return array
     */
    public function parse(string $path, array $options = []): array
    {
        $contents = $this->load($path);

        $blocks = explode("\n\n", trim($contents));

        $result = $this->parseHeader(array_shift($blocks));
        $result['emoji'] = $this->parseBody($blocks, $result['version'], $options);

        return $result;
    }

    private function parseHeader(string $block): array
    {
        $result = [];
        $rows = explode("\n", $block);
        foreach ($rows as $row) {
            if (($value = $this->getValue($row, '# Date:')) !== false) {
                $result['date'] = $value;
            }
            if (($value = $this->getValue($row, '# Version:')) !== false) {
                $result['version'] = $value;
                $result['url'] = sprintf(self::URL, $value);
            }
        }
        return $result;
    }

    private function parseBody(array $blocks, string $emojiVersion, array $options = []): array
    {
        $result = [];
        $group = null;
        foreach ($blocks as $block) {
            $rows = explode("\n", trim($block));

            if (($value = $this->getValue($rows[0], '# group:')) !== false) {
                $group = $value;
                continue;
            }

            if (($subgroup = $this->getValue($rows[0], '# subgroup:')) !== false) {
                array_shift($rows);
                $subgroups = [];
                foreach ($rows as $row) {
                    if ($emojiVersion >= 12.1) {
                        // Format: code points; status # emoji EX.X name
                        [$codePoint, $status, $emoji, $version, $name] = sscanf($row, '%[^;]; %[^#] # %[^ ] E%[^ ] %[^$]');
                    } else {
                        // Format: code points; status # emoji name
                        [$codePoint, $status, $emoji, $name] = sscanf($row, '%[^;]; %[^#] # %[^ ] %[^$]');
                        $version = '';
                    }

                    $subgroups[] = [
                        'group'      => $group,
                        'subgroup'   => $subgroup,
                        'code_point' => trim($codePoint),
                        'status'     => trim($status),
                        'emoji'      => trim($emoji),
                        'name'       => trim($name),
                        'version'    => (float)trim($version),
                    ];
                }
                if (isset($options['sort'])) {
                    $subgroups = $this->sort($subgroups, 'emoji', $options['sort']);
                }
                $result = array_merge($result, $subgroups);
            }
        }

        return $result;
    }

    private function sort(array $array, string $key, int $sortOrder): array
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
    private function getValue(string $row, string $key)
    {
        if (strpos($row, $key) !== 0) {
            return false;
        }

        return substr($row, strlen($key) + 1);
    }

    private function load(string $path): string
    {
        if (! is_readable($path)) {
            throw new LogicException("{$path}: No such file");
        }

        /** @var string */
        return file_get_contents($path);
    }
}
