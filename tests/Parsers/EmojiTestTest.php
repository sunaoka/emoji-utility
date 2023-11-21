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
        $this->assertCount(2822, $data['emoji']);
    }

    public function test_parse_5_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/5.0.txt');
        $this->assertCount(3377, $data['emoji']);
    }

    public function test_parse_11_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/11.0.txt');
        $this->assertCount(3570, $data['emoji']);
    }

    public function test_parse_12_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.0.txt');
        $this->assertCount(3836, $data['emoji']);
    }

    public function test_parse_12_1(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.1.txt');
        $this->assertCount(4022, $data['emoji']);
    }

    public function test_parse_13_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/13.0.txt');
        $this->assertCount(4168, $data['emoji']);
    }

    public function test_parse_13_1(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/13.1.txt');
        $this->assertCount(4590, $data['emoji']);
    }

    public function test_parse_14_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/14.0.txt');
        $this->assertCount(4702, $data['emoji']);
    }

    public function test_parse_15_0(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/15.0.txt');
        $this->assertCount(4733, $data['emoji']);
    }

    public function test_parse_15_1(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/15.1.txt');
        $this->assertCount(5034, $data['emoji']);
    }

    public function test_sort_none(): void
    {
        $parser = new EmojiTest();
        $data = $parser->parse(dirname(__DIR__) . '/data/emoji-test/12.0.txt');

        $codePoints = array_map(function($emoji) {
            return $emoji['code_point'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        $this->assertSame([
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

        $codePoints = array_map(function($emoji) {
            return $emoji['code_point'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        $this->assertSame([
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

        $codePoints = array_map(function($emoji) {
            return $emoji['code_point'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        $this->assertSame([
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
