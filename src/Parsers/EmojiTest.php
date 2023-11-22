<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

class EmojiTest
{
    use ParserTrait;

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
                        [$codePoints, $status, $emoji, $version, $name] = $this->scan($row, '%[^;]; %[^#] # %[^ ] E%[^ ] %[^$]');
                    } else {
                        // Format: code points; status # emoji name
                        [$codePoints, $status, $emoji, $name] = $this->scan($row, '%[^;]; %[^#] # %[^ ] %[^$]');
                        $version = null;
                    }

                    $subgroups[] = [
                        'group'      => $group,
                        'subgroup'   => $subgroup,
                        'codepoints' => $codePoints,
                        'status'     => $status,
                        'emoji'      => $emoji,
                        'name'       => $name,
                        'version'    => $version === null ? (float)$version : null,
                    ];
                }
                if (isset($options['sort'])) {
                    $subgroups = $this->sort($subgroups, 'emoji', $options['sort']);
                }
                $result[] = $subgroups;
            }
        }

        return array_merge(...$result);
    }
}
