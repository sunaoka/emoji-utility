<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Tests\Parsers;

use PHPUnit\Framework\TestCase;
use Sunaoka\EmojiUtility\Parsers\EmojiVariationSequences;

class EmojiVariationSequencesTest extends TestCase
{
    public function test_load_fail(): void
    {
        $this->expectExceptionMessage('fake.txt: No such file');

        $parser = new EmojiVariationSequences();
        $parser->parse('fake.txt');
    }

    public function test_load_5_0(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/5.0.txt');

        self::assertSame('2017-02-18, 13:49:18 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_5_0, $data['version']), $data['url']);
        self::assertSame('5.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(702, $data['emoji']);
    }

    public function test_load_11_0(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/11.0.txt');

        self::assertSame('2018-02-07, 07:55:18 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_5_0, $data['version']), $data['url']);
        self::assertSame('11.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(706, $data['emoji']);
    }

    public function test_load_12_0(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/12.0.txt');

        self::assertSame('2019-01-15, 12:10:05 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_5_0, $data['version']), $data['url']);
        self::assertSame('12.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(706, $data['emoji']);
    }

    public function test_load_12_1(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/12.1.txt');

        self::assertSame('2019-10-12, 21:18:36 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_5_0, $data['version']), $data['url']);
        self::assertSame('12.1', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(706, $data['emoji']);
    }


    public function test_load_13_0(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/13.0.txt');

        self::assertSame('2020-01-21, 07:15:05 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_13_0, $data['version']), $data['url']);
        self::assertSame('13.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(708, $data['emoji']);
    }

    public function test_load_14_0(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/14.0.txt');

        self::assertSame('2021-06-08, 05:19:16 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_13_0, $data['version']), $data['url']);
        self::assertSame('14.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(708, $data['emoji']);
    }

    public function test_load_15_0(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/15.0.txt');

        self::assertSame('2022-05-13, 21:54:24 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_13_0, $data['version']), $data['url']);
        self::assertSame('15.0', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(708, $data['emoji']);
    }

    public function test_load_15_1(): void
    {
        $parser = new EmojiVariationSequences();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-variation-sequences/15.1.txt');

        self::assertSame('2023-02-01, 02:22:54 GMT', $data['date']);
        self::assertSame(sprintf(EmojiVariationSequences::URL_13_0, $data['version']), $data['url']);
        self::assertSame('15.1', $data['version']);
        self::assertSame([
            'codepoints' => '0023 FE0E',
            'variation'  => 'FE0E',
            'style'      => 'text style',
            'emoji'      => '#︎',
            'name'       => 'NUMBER SIGN',
            'version'    => '1.1',
        ], $data['emoji'][0]);
        self::assertCount(742, $data['emoji']);
    }
}
