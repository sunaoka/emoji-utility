<?php

declare(strict_types=1);

namespace Sunaoka\EmojiUtility\Tests\Parsers;

use PHPUnit\Framework\TestCase;
use Sunaoka\EmojiUtility\Parsers\EmojiTest;

class EmojiTestTest extends TestCase
{
    public function test_load_fail(): void
    {
        $this->expectExceptionMessage('fake.txt: No such file');

        $parser = new EmojiTest();
        $parser->parse('fake.txt');
    }

    public function test_parse_4_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/4.0.txt');

        self::assertSame('2016-11-16, 18:29:53 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('4.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & People',
            'subgroup'   => 'face-positive',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '',
        ], $data['emoji'][0]);
        self::assertCount(2822, $data['emoji']);

    }

    public function test_parse_5_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/5.0.txt');

        self::assertSame('2017-06-19, 11:13:24 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('5.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & People',
            'subgroup'   => 'face-positive',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '',
        ], $data['emoji'][0]);
        self::assertCount(3377, $data['emoji']);
    }

    public function test_parse_11_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/11.0.txt');

        self::assertSame('2018-02-07, 09:44:06 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('11.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & People',
            'subgroup'   => 'face-positive',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '',
        ], $data['emoji'][0]);
        self::assertCount(3570, $data['emoji']);
    }

    public function test_parse_12_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.0.txt');

        self::assertSame('2019-01-27, 15:43:01 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('12.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '',
        ], $data['emoji'][0]);
        self::assertCount(3836, $data['emoji']);
    }

    public function test_parse_12_1(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.1.txt');

        self::assertSame('2019-10-12, 00:43:03 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('12.1', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '2.0',
        ], $data['emoji'][0]);
        self::assertCount(4022, $data['emoji']);
    }

    public function test_parse_13_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/13.0.txt');

        self::assertSame('2020-01-21, 13:40:25 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('13.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '1.0',
        ], $data['emoji'][0]);
        self::assertCount(4168, $data['emoji']);
    }

    public function test_parse_13_1(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/13.1.txt');

        self::assertSame('2020-09-12, 22:19:50 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('13.1', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '1.0',
        ], $data['emoji'][0]);
        self::assertCount(4590, $data['emoji']);
    }

    public function test_parse_14_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/14.0.txt');

        self::assertSame('2021-08-26, 17:22:23 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('14.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '1.0',
        ], $data['emoji'][0]);
        self::assertCount(4702, $data['emoji']);
    }

    public function test_parse_15_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/15.0.txt');

        self::assertSame('2022-08-12, 20:24:39 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('15.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '1.0',
        ], $data['emoji'][0]);
        self::assertCount(4733, $data['emoji']);
    }

    public function test_parse_15_1(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/15.1.txt');

        self::assertSame('2023-06-05, 21:39:54 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('15.1', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '1.0',
        ], $data['emoji'][0]);
        self::assertCount(5034, $data['emoji']);
    }

    public function test_parse_16_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/16.0.txt');

        self::assertSame('2024-08-14, 23:51:54 GMT', $data['date']);
        self::assertSame(sprintf(EmojiTest::URL, $data['version']), $data['url']);
        self::assertSame('16.0', $data['version']);
        self::assertSame([
            'group'      => 'Smileys & Emotion',
            'subgroup'   => 'face-smiling',
            'codepoints' => '1F600',
            'status'     => 'fully-qualified',
            'emoji'      => '😀',
            'name'       => 'grinning face',
            'version'    => '1.0',
        ], $data['emoji'][0]);
        self::assertCount(5042, $data['emoji']);
    }

    public function test_sort_none(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.0.txt');

        $codePoints = array_map(function ($emoji) {
            return $emoji['codepoints'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        self::assertSame([
            '1F970',
            '1F60D',
            '1F929',
            '1F618',
            '1F617',
            '263A FE0F',
            '263A',
            '1F61A',
            '1F619',
        ], $codePoints);
    }

    public function test_sort_asc(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.0.txt', ['sort' => SORT_ASC]);

        $codePoints = array_map(function ($emoji) {
            return $emoji['codepoints'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        self::assertSame([
            '263A',
            '263A FE0F',
            '1F60D',
            '1F617',
            '1F618',
            '1F619',
            '1F61A',
            '1F929',
            '1F970',
        ], $codePoints);
    }

    public function test_sort_desc(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.0.txt', ['sort' => SORT_DESC]);

        $codePoints = array_map(function ($emoji) {
            return $emoji['codepoints'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        self::assertSame([
            '1F970',
            '1F929',
            '1F61A',
            '1F619',
            '1F618',
            '1F617',
            '1F60D',
            '263A FE0F',
            '263A',
        ], $codePoints);
    }
}
