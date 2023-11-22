<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Tests\Parsers;

use PHPUnit\Framework\TestCase;
use Sunaoka\EmojiUtility\Parsers\EmojiSequences;

class EmojiSequencesTest extends TestCase
{
    public function test_load_fail(): void
    {
        $this->expectExceptionMessage('fake.txt: No such file');

        $parser = new EmojiSequences();
        $parser->parse('fake.txt');
    }

    public function test_load_2_0(): void
    {
        $parser = new EmojiSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-sequences/2.0.txt');

        self::assertSame('2015-11-11', $data['date']);
        self::assertSame(sprintf(EmojiSequences::URL, $data['version']), $data['url']);
        self::assertSame('2.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 20E3',
            'type'       => '',
            'emoji'      => '#️⃣',
            'name'       => 'keycap number sign',
            'version'    => '',
        ], $data['emoji'][0]);
        self::assertCount(589, $data['emoji']);
    }

    public function test_load_3_0(): void
    {
        $parser = new EmojiSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-sequences/3.0.txt');

        self::assertSame('2016-06-02, 09:26:10 GMT', $data['date']);
        self::assertSame(sprintf(EmojiSequences::URL, $data['version']), $data['url']);
        self::assertSame('3.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0F 20E3',
            'type'       => 'Emoji_Combining_Sequence',
            'emoji'      => '#️⃣',
            'name'       => 'Keycap NUMBER SIGN',
            'version'    => '3.0',
        ], $data['emoji'][0]);
        self::assertCount(684, $data['emoji']);
    }

    public function test_load_12_0(): void
    {
        $parser = new EmojiSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-sequences/12.0.txt');

        self::assertSame('2019-01-15, 12:17:16 GMT', $data['date']);
        self::assertSame(sprintf(EmojiSequences::URL, $data['version']), $data['url']);
        self::assertSame('12.0', $data['version']);
        self::assertSame([
            'codepoints' => '231A',
            'type'       => 'Basic_Emoji',
            'emoji'      => '⌚',
            'name'       => 'watch',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(2116, $data['emoji']);
    }
}
