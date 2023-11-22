<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

use Sunaoka\EmojiUtility\Emoji;

/**
 * @template TOptions of array{sort?: ?int}
 */
class EmojiSequences
{
    use ParserTrait;

    public const URL = 'https://unicode.org/Public/emoji/%s/emoji-sequences.txt';

    /**
     * Parse emoji-sequences.txt
     *
     * @param string   $path path of emoji-sequences.txt
     * @param TOptions $options
     *
     * @return array{date: string, version: string, url: string, emoji: array<int, array{codepoints: string, type: string, emoji: string, name: string, version: string}>}
     */
    public function parse(string $path, array $options = []): array
    {
        $contents = $this->load($path);

        $rows = explode("\n", trim($contents));

        $result = $this->getHeader($rows);
        $result['url'] = sprintf(self::URL, $result['version']);
        $result['emoji'] = $this->parseBody($rows, $result['version'], $options);

        return $result;
    }

    /**
     * @param string[] $rows
     * @param TOptions $options
     *
     * @return array<int, array{codepoints: string, type: string, emoji: string, name: string, version: string}>
     */
    private function parseBody(array $rows, string $emojiVersion, array $options = []): array
    {
        $result = [];

        foreach ($rows as $row) {
            if (Utility::isEmptyLine($row)) {
                continue;
            }

            switch ($emojiVersion) {
                case '2.0':
                    // Format: codepoints ; # (sequence) description
                    [$codepoints, $emoji, $name] = Utility::scan($row, '%[^#] # (%[^)]) %[^$]');
                    $type = '';
                    $version = '';
                    break;

                case '3.0':
                    // Format: code_point(s) ; type_field # version [count] name(s)
                    [$codepoints, $type, $version, , $emoji, $name] = Utility::scan($row, '%[^;]; %[^#] # %s [%d] (%[^)]) %[^$]');
                    break;

                default:
                    // Format: code_point(s) ; type_field ; description # comments
                    [$codepoints, $type, $name, $version, , $emoji] = Utility::scan($row, '%[^;] ; %[^;] ; %[^#] #%s [%d] (%[^)])');
            }

            if (str_contains($codepoints, '..')) {
                foreach (Utility::range(...explode('..', $codepoints)) as $points) {
                    $codepoints = strtoupper(dechex($points));
                    $result[] = $this->entity($codepoints, $type, null, $name, $version);
                }
            } else {
                $result[] = $this->entity($codepoints, $type, $emoji, $name, $version);
            }

            if (isset($options['sort'])) {
                $result = $this->sort($result, 'emoji', $options['sort']);
            }
        }

        return $result;
    }

    /**
     * @return array{codepoints: string, type: string, emoji: string, name: string, version: string}
     */
    private function entity(string $codepoints, string $type, ?string $emoji, string $name, string $version): array
    {
        return [
            'codepoints' => $codepoints,
            'type'       => $type,
            'emoji'      => $emoji ?? Emoji::fromCodePoints($codepoints),
            'name'       => $name,
            'version'    => $version,
        ];
    }
}
