all: emoji-test.txt emoji-variation-sequences.txt emoji-sequences.txt

emoji-test.txt:
	curl --no-progress-meter https://unicode.org/Public/emoji/4.0/emoji-test.txt  -o emoji-test/4.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/5.0/emoji-test.txt  -o emoji-test/5.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/11.0/emoji-test.txt -o emoji-test/11.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/12.0/emoji-test.txt -o emoji-test/12.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/12.1/emoji-test.txt -o emoji-test/12.1.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/13.0/emoji-test.txt -o emoji-test/13.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/13.1/emoji-test.txt -o emoji-test/13.1.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/14.0/emoji-test.txt -o emoji-test/14.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/15.0/emoji-test.txt -o emoji-test/15.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/15.1/emoji-test.txt -o emoji-test/15.1.txt

emoji-variation-sequences.txt:
	curl --no-progress-meter https://unicode.org/Public/emoji/5.0/emoji-variation-sequences.txt  -o emoji-variation-sequences/5.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/11.0/emoji-variation-sequences.txt -o emoji-variation-sequences/11.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/12.0/emoji-variation-sequences.txt -o emoji-variation-sequences/12.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/12.1/emoji-variation-sequences.txt -o emoji-variation-sequences/12.1.txt
	curl --no-progress-meter https://unicode.org/Public/13.0.0/ucd/emoji/emoji-variation-sequences.txt -o emoji-variation-sequences/13.0.txt
	curl --no-progress-meter https://unicode.org/Public/14.0.0/ucd/emoji/emoji-variation-sequences.txt -o emoji-variation-sequences/14.0.txt
	curl --no-progress-meter https://unicode.org/Public/15.0.0/ucd/emoji/emoji-variation-sequences.txt -o emoji-variation-sequences/15.0.txt
	curl --no-progress-meter https://unicode.org/Public/15.1.0/ucd/emoji/emoji-variation-sequences.txt -o emoji-variation-sequences/15.1.txt

emoji-sequences.txt:
	curl --no-progress-meter https://unicode.org/Public/emoji/2.0/emoji-sequences.txt  -o emoji-sequences/2.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/3.0/emoji-sequences.txt  -o emoji-sequences/3.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/4.0/emoji-sequences.txt  -o emoji-sequences/4.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/5.0/emoji-sequences.txt  -o emoji-sequences/5.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/11.0/emoji-sequences.txt -o emoji-sequences/11.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/12.0/emoji-sequences.txt -o emoji-sequences/12.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/12.1/emoji-sequences.txt -o emoji-sequences/12.1.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/13.0/emoji-sequences.txt -o emoji-sequences/13.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/13.1/emoji-sequences.txt -o emoji-sequences/13.1.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/14.0/emoji-sequences.txt -o emoji-sequences/14.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/15.0/emoji-sequences.txt -o emoji-sequences/15.0.txt
	curl --no-progress-meter https://unicode.org/Public/emoji/15.1/emoji-sequences.txt -o emoji-sequences/15.1.txt

clean:
	$(RM) emoji-test/*.txt
	$(RM) emoji-variation-sequences/*.txt

.PHONY: all emoji-test.txt emoji-variation-sequences.txt emoji-sequences.txt clean
