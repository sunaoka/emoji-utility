<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

/**
 * @template TOptions of array{sort?: ?int}
 */
class EmojiTest
{
    use ParserTrait;

    public const URL = 'https://unicode.org/Public/emoji/%s/emoji-test.txt';

    /**
     * Parse emoji-test.txt
     *
     * @param string   $path path of emoji-test.txt
     * @param TOptions $options
     *
     * @return array{date: string, version: string, url: string, emoji: array<int, array{group: string, subgroup: string, codepoints: string, status: string, emoji: string, name: string, version: string}>}
     */
    public function parse(string $path, array $options = []): array
    {
        $contents = $this->load($path);

        $blocks = explode("\n\n", trim($contents));

        $result = $this->parseHeader(array_shift($blocks));
        $result['emoji'] = $this->parseBody($blocks, $result['version'], $options);

        return $result;
    }

    /**
     * @return array{date: string, version: string, url: string}
     */
    private function parseHeader(string $block): array
    {
        $rows = explode("\n", $block);

        $result = $this->getHeader($rows);
        $result['url'] = sprintf(self::URL, $result['version']);

        return $result;
    }

    /**
     * @param string[] $blocks
     * @param TOptions $options
     *
     * @return array<int, array{group: string, subgroup: string, codepoints: string, status: string, emoji: string, name: string, version: string}>
     */
    private function parseBody(array $blocks, string $emojiVersion, array $options = []): array
    {
        $result = [];
        $group = '';
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
                    if (version_compare($emojiVersion, '12.1') >= 0) {
                        // Format: code points; status # emoji EX.X name
                        [$codepoints, $status, $emoji, $version, $name] = Utility::scan($row, '%[^;]; %[^#] # %[^ ] E%[^ ] %[^$]');
                    } else {
                        // Format: code points; status # emoji name
                        [$codepoints, $status, $emoji, $name] = Utility::scan($row, '%[^;]; %[^#] # %[^ ] %[^$]');
                        $version = '';
                    }

                    $subgroups[] = [
                        'group'      => $group,
                        'subgroup'   => $subgroup,
                        'codepoints' => $codepoints,
                        'status'     => $status,
                        'emoji'      => $emoji,
                        'name'       => $name,
                        'version'    => $version,
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
