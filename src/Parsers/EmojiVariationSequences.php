<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Parsers;

use Sunaoka\EmojiUtility\Emoji;

/**
 * @template TOptions of array{sort?: ?int}
 */
class EmojiVariationSequences
{
    use ParserTrait;

    public const URL_5_0 = 'https://unicode.org/Public/emoji/%s/emoji-variation-sequences.txt';

    public const URL_13_0 = 'https://unicode.org/Public/%s.0/ucd/emoji/emoji-variation-sequences.txt';

    /**
     * Parse emoji-variation-sequences.txt
     *
     * @param string   $path path of emoji-variation-sequences.txt
     * @param TOptions $options
     *
     * @return array{date: string, version: string, url: string, emoji: array<int, array{codepoints: string, variation: string, style: string, emoji: string, name: string, version: string}>}
     */
    public function parse(string $path, array $options = []): array
    {
        $contents = $this->load($path);

        $rows = explode("\n", trim($contents));

        $result = $this->getHeader($rows);
        if (version_compare($result['version'], '13.0') >= 0) {
            $result['url'] = sprintf(self::URL_13_0, $result['version']);
        } else {
            $result['url'] = sprintf(self::URL_5_0, $result['version']);
        }

        $result['emoji'] = $this->parseBody($rows, $options);

        return $result;
    }

    /**
     * @param string[] $rows
     * @param TOptions $options
     *
     * @return array<int, array{codepoints: string, variation: string, style: string, emoji: string, name: string, version: string}>
     */
    private function parseBody(array $rows, array $options = []): array
    {
        $result = [];

        foreach ($rows as $row) {
            if (Utility::isEmptyLine($row)) {
                continue;
            }

            [$codepoints, $variation, $style, $version, $name] = Utility::scan($row, '%s %s ; %[^;];  # (%[^)]) %[^$]');
            $result[] = [
                'codepoints' => "{$codepoints} {$variation}",
                'variation'  => $variation,
                'style'      => $style,
                'emoji'      => Emoji::fromCodePoints("{$codepoints} {$variation}"),
                'name'       => $name,
                'version'    => $version,
            ];

            if (isset($options['sort'])) {
                $result = $this->sort($result, 'emoji', $options['sort']);
            }
        }

        return $result;
    }
}
