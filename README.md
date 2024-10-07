# Parsing unicode emoji text file using PHP

[![Latest Stable Version](https://poser.pugx.org/sunaoka/emoji-utility/v/stable)](https://packagist.org/packages/sunaoka/emoji-utility)
[![License](https://poser.pugx.org/sunaoka/emoji-utility/license)](https://packagist.org/packages/sunaoka/emoji-utility)
[![PHP](https://img.shields.io/packagist/php-v/sunaoka/emoji-utility)](composer.json)
[![Test](https://github.com/sunaoka/emoji-utility/actions/workflows/test.yml/badge.svg)](https://github.com/sunaoka/emoji-utility/actions/workflows/test.yml)
[![codecov](https://codecov.io/gh/sunaoka/emoji-utility/branch/develop/graph/badge.svg)](https://codecov.io/gh/sunaoka/emoji-utility)

---

Library to parse `emoji-test.txt`
(`emoji-test.txt` file provides data for testing which emoji forms should be in keyboards and which should also be displayed/processed).

## Installation

```bash
composer require sunaoka/emoji-utility
```

## Usage

```php
<?php

use Sunaoka\EmojiUtility\Parsers\EmojiTest;

$parser = new EmojiTest();
$data = $parser->parse('emoji-test.txt');

var_dump($data);
```

output is ...

```text
array(4) {
  ["date"]    => string(24) "2023-06-05, 21:39:54 GMT"
  ["version"] => string(4)  "15.1"
  ["url"]     => string(52) "https://unicode.org/Public/emoji/15.1/emoji-test.txt"
  ["emoji"]   => array(5034) {
    [0] => array(7) {
      ["group"]      => string(17) "Smileys & Emotion"
      ["subgroup"]   => string(12) "face-smiling"
      ["codepoints"] => string(5)  "1F600"
      ["status"]     => string(15) "fully-qualified"
      ["emoji"]      => string(4)  "😀"
      ["name"]       => string(13) "grinning face"
      ["version"]    => string(3)  "1.0"
    }
    :
    :
  }
}
```

## Options

### sort

see: [Arrays > Predefined Constants > Sorting order flags](https://php.net/array.constants).

```php
<?php

use Sunaoka\EmojiUtility\Parsers\EmojiTest;

$options = [
    'sort' => SORT_ASC,
];

$parser = new EmojiTest();
$data = $parser->parse('emoji-test.txt', $options);
```

## emoji-test.txt

| Version | URL                                                  |
| ------: | ---------------------------------------------------- |
|    16.0 | https://unicode.org/Public/emoji/16.0/emoji-test.txt |
|    15.1 | https://unicode.org/Public/emoji/15.1/emoji-test.txt |
|    15.0 | https://unicode.org/Public/emoji/15.0/emoji-test.txt |
|    14.0 | https://unicode.org/Public/emoji/14.0/emoji-test.txt |
|    13.1 | https://unicode.org/Public/emoji/13.1/emoji-test.txt |
|    13.0 | https://unicode.org/Public/emoji/13.0/emoji-test.txt |
|    12.1 | https://unicode.org/Public/emoji/12.1/emoji-test.txt |
|    12.0 | https://unicode.org/Public/emoji/12.0/emoji-test.txt |
|    11.0 | https://unicode.org/Public/emoji/11.0/emoji-test.txt |
|     5.0 | https://unicode.org/Public/emoji/5.0/emoji-test.txt  |
|     4.0 | https://unicode.org/Public/emoji/4.0/emoji-test.txt  |
