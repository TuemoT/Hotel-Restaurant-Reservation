<?php

namespace Egulias\EmailValidator;

use Doctrine\Common\Lexer\AbstractLexer;
use Doctrine\Common\Lexer\Token;

<<<<<<< HEAD
<<<<<<< HEAD
/**
 * @extends AbstractLexer<int, string>
 */
class EmailLexer extends AbstractLexer
{
    //ASCII values
    public const S_EMPTY            = null;
=======
/** @extends AbstractLexer<int, string> */
class EmailLexer extends AbstractLexer
{
    //ASCII values
    public const S_EMPTY            = -1;
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
/** @extends AbstractLexer<int, string> */
class EmailLexer extends AbstractLexer
{
    //ASCII values
    public const S_EMPTY            = -1;
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    public const C_NUL              = 0;
    public const S_HTAB             = 9;
    public const S_LF               = 10;
    public const S_CR               = 13;
    public const S_SP               = 32;
    public const EXCLAMATION        = 33;
    public const S_DQUOTE           = 34;
    public const NUMBER_SIGN        = 35;
    public const DOLLAR             = 36;
    public const PERCENTAGE         = 37;
    public const AMPERSAND          = 38;
    public const S_SQUOTE           = 39;
    public const S_OPENPARENTHESIS  = 40;
    public const S_CLOSEPARENTHESIS = 41;
    public const ASTERISK           = 42;
    public const S_PLUS             = 43;
    public const S_COMMA            = 44;
    public const S_HYPHEN           = 45;
    public const S_DOT              = 46;
    public const S_SLASH            = 47;
    public const S_COLON            = 58;
    public const S_SEMICOLON        = 59;
    public const S_LOWERTHAN        = 60;
    public const S_EQUAL            = 61;
    public const S_GREATERTHAN      = 62;
    public const QUESTIONMARK       = 63;
    public const S_AT               = 64;
    public const S_OPENBRACKET      = 91;
    public const S_BACKSLASH        = 92;
    public const S_CLOSEBRACKET     = 93;
    public const CARET              = 94;
    public const S_UNDERSCORE       = 95;
    public const S_BACKTICK         = 96;
    public const S_OPENCURLYBRACES  = 123;
    public const S_PIPE             = 124;
    public const S_CLOSECURLYBRACES = 125;
    public const S_TILDE            = 126;
    public const C_DEL              = 127;
<<<<<<< HEAD
<<<<<<< HEAD
    public const INVERT_QUESTIONMARK= 168;
=======
    public const INVERT_QUESTIONMARK = 168;
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
    public const INVERT_QUESTIONMARK = 168;
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    public const INVERT_EXCLAMATION = 173;
    public const GENERIC            = 300;
    public const S_IPV6TAG          = 301;
    public const INVALID            = 302;
    public const CRLF               = 1310;
    public const S_DOUBLECOLON      = 5858;
    public const ASCII_INVALID_FROM = 127;
    public const ASCII_INVALID_TO   = 199;

    /**
     * US-ASCII visible characters not valid for atext (@link http://tools.ietf.org/html/rfc5322#section-3.2.3)
     *
     * @var array
     */
    protected $charValue = [
        '{'    => self::S_OPENCURLYBRACES,
        '}'    => self::S_CLOSECURLYBRACES,
        '('    => self::S_OPENPARENTHESIS,
        ')'    => self::S_CLOSEPARENTHESIS,
        '<'    => self::S_LOWERTHAN,
        '>'    => self::S_GREATERTHAN,
        '['    => self::S_OPENBRACKET,
        ']'    => self::S_CLOSEBRACKET,
        ':'    => self::S_COLON,
        ';'    => self::S_SEMICOLON,
        '@'    => self::S_AT,
        '\\'   => self::S_BACKSLASH,
        '/'    => self::S_SLASH,
        ','    => self::S_COMMA,
        '.'    => self::S_DOT,
        "'"    => self::S_SQUOTE,
        "`"    => self::S_BACKTICK,
        '"'    => self::S_DQUOTE,
        '-'    => self::S_HYPHEN,
        '::'   => self::S_DOUBLECOLON,
        ' '    => self::S_SP,
        "\t"   => self::S_HTAB,
        "\r"   => self::S_CR,
        "\n"   => self::S_LF,
        "\r\n" => self::CRLF,
        'IPv6' => self::S_IPV6TAG,
        ''     => self::S_EMPTY,
        '\0'   => self::C_NUL,
        '*'    => self::ASTERISK,
        '!'    => self::EXCLAMATION,
        '&'    => self::AMPERSAND,
        '^'    => self::CARET,
        '$'    => self::DOLLAR,
        '%'    => self::PERCENTAGE,
        '~'    => self::S_TILDE,
        '|'    => self::S_PIPE,
        '_'    => self::S_UNDERSCORE,
        '='    => self::S_EQUAL,
        '+'    => self::S_PLUS,
        '¿'    => self::INVERT_QUESTIONMARK,
        '?'    => self::QUESTIONMARK,
        '#'    => self::NUMBER_SIGN,
        '¡'    => self::INVERT_EXCLAMATION,
    ];

    public const INVALID_CHARS_REGEX = "/[^\p{S}\p{C}\p{Cc}]+/iu";

    public const VALID_UTF8_REGEX = '/\p{Cc}+/u';

    public const CATCHABLE_PATTERNS = [
        '[a-zA-Z]+[46]?', //ASCII and domain literal
        '[^\x00-\x7F]',  //UTF-8
        '[0-9]+',
        '\r\n',
        '::',
        '\s+?',
        '.',
    ];

    public const NON_CATCHABLE_PATTERNS = [
        '[\xA0-\xff]+',
    ];

    public const MODIFIERS = 'iu';

    /** @var bool */
    protected $hasInvalidTokens = false;

    /**
     * @var Token<int, string>
     */
    protected Token $previous;

    /**
     * The last matched/seen token.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @var array|Token
     *
     * @psalm-suppress NonInvariantDocblockPropertyType
     * @psalm-var array{value:string, type:null|int, position:int}|Token<int, string>
=======
     * @var Token<int, string>
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
     * @var Token<int, string>
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
     */
    public Token $current;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * The next token in the input.
     *
     * @var array|Token|null
     *
     * @psalm-suppress NonInvariantDocblockPropertyType
     * @psalm-var array{position: int, type: int|null|string, value: int|string}|Token<int, string>|null
=======
     * @var Token<int, string>
>>>>>>> 66597818 ( abdou a faire un poushe)
     */
    private Token $nullToken;

<<<<<<< HEAD
    /** @psalm-var array{value:'', type:null, position:0} */
    private static $nullToken = [
        'value' => '',
        'type' => null,
        'position' => 0,
    ];

=======
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
     * @var Token<int, string>
     */
    private Token $nullToken;

>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    /** @var string */
    private $accumulator = '';

    /** @var bool */
    private $hasToRecord = false;

    public function __construct()
    {
        /** @var Token<int, string> $nullToken */
        $nullToken = new Token('', self::S_EMPTY, 0);
        $this->nullToken = $nullToken;

        $this->current = $this->previous = $this->nullToken;
        $this->lookahead = null;
    }

<<<<<<< HEAD
<<<<<<< HEAD
    public function reset() : void
    {
        $this->hasInvalidTokens = false;
        parent::reset();
        $this->previous = $this->token = self::$nullToken;
=======
    public function reset(): void
    {
        $this->hasInvalidTokens = false;
        parent::reset();
        $this->current = $this->previous = $this->nullToken;
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
    public function reset(): void
    {
        $this->hasInvalidTokens = false;
        parent::reset();
        $this->current = $this->previous = $this->nullToken;
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    }

    /**
     * @param int $type
     * @throws \UnexpectedValueException
     * @return boolean
     *
     * @psalm-suppress InvalidScalarArgument
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function find($type) : bool
=======
    public function find($type): bool
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
    public function find($type): bool
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    {
        $search = clone $this;
        $search->skipUntil($type);

        if (!$search->lookahead) {
            throw new \UnexpectedValueException($type . ' not found');
        }
        return true;
    }

    /**
     * moveNext
     *
     * @return boolean
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function moveNext() : bool
    {
        if ($this->hasToRecord && $this->previous === self::$nullToken) {
            $this->accumulator .= ((array) $this->token)['value'];
        }

        $this->previous = (array) $this->token;

        if($this->lookahead === null) {
            $this->lookahead = self::$nullToken;
        }

        $hasNext = parent::moveNext();

        if ($this->hasToRecord) {
            $this->accumulator .= ((array) $this->token)['value'];
=======
    public function moveNext(): bool
    {
        if ($this->hasToRecord && $this->previous === $this->nullToken) {
            $this->accumulator .= $this->current->value;
        }

        $this->previous = $this->current;

        if ($this->lookahead === null) {
            $this->lookahead = $this->nullToken;
        }

        $hasNext = parent::moveNext();
        $this->current = $this->token ?? $this->nullToken;

        if ($this->hasToRecord) {
            $this->accumulator .= $this->current->value;
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
    public function moveNext(): bool
    {
        if ($this->hasToRecord && $this->previous === $this->nullToken) {
            $this->accumulator .= $this->current->value;
        }

        $this->previous = $this->current;

        if ($this->lookahead === null) {
            $this->lookahead = $this->nullToken;
        }

        $hasNext = parent::moveNext();
        $this->current = $this->token ?? $this->nullToken;

        if ($this->hasToRecord) {
            $this->accumulator .= $this->current->value;
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
        }

        return $hasNext;
    }

    /**
     * Retrieve token type. Also processes the token value if necessary.
     *
     * @param string $value
     * @throws \InvalidArgumentException
     * @return integer
     */
    protected function getType(&$value): int
    {
        $encoded = $value;

        if (mb_detect_encoding($value, 'auto', true) !== 'UTF-8') {
            $encoded = mb_convert_encoding($value, 'UTF-8', 'Windows-1252');
        }

        if ($this->isValid($encoded)) {
            return $this->charValue[$encoded];
        }

        if ($this->isNullType($encoded)) {
            return self::C_NUL;
        }

        if ($this->isInvalidChar($encoded)) {
            $this->hasInvalidTokens = true;
            return self::INVALID;
        }

        return self::GENERIC;
<<<<<<< HEAD
    }

<<<<<<< HEAD
    protected function isValid(string $value) : bool
    {
        return isset($this->charValue[$value]);
    }

    protected function isNullType(string $value) : bool
    {
        return $value === "\0";
=======
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    }

    protected function isValid(string $value): bool
    {
<<<<<<< HEAD
        return !preg_match(self::INVALID_CHARS_REGEX, $value);
    }

    protected function isUTF8Invalid(string $value) : bool
=======
        return isset($this->charValue[$value]);
    }

    protected function isNullType(string $value): bool
    {
        return $value === "\0";
    }

    protected function isInvalidChar(string $value): bool
    {
        return !preg_match(self::INVALID_CHARS_REGEX, $value);
    }

    protected function isUTF8Invalid(string $value): bool
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    {
        return preg_match(self::VALID_UTF8_REGEX, $value) !== false;
    }

<<<<<<< HEAD
    public function hasInvalidTokens() : bool
    {
        return $this->hasInvalidTokens;
    }

    /**
     * getPrevious
     *
     * @return array
     */
    public function getPrevious() : array
    {
        return $this->previous;
    }

    /**
     * Lexical catchable patterns.
     *
     * @return string[]
     */
    protected function getCatchablePatterns() : array
    {
        return self::CATCHABLE_PATTERNS;
    }

    /**
     * Lexical non-catchable patterns.
     *
     * @return string[]
     */
    protected function getNonCatchablePatterns() : array
    {
        return self::NON_CATCHABLE_PATTERNS;
    }

    protected function getModifiers() : string
    {
        return self::MODIFIERS;
=======
    protected function isValid(string $value): bool
    {
        return isset($this->charValue[$value]);
    }

    protected function isNullType(string $value): bool
    {
        return $value === "\0";
    }

    protected function isInvalidChar(string $value): bool
    {
        return !preg_match(self::INVALID_CHARS_REGEX, $value);
    }

    protected function isUTF8Invalid(string $value): bool
    {
        return preg_match(self::VALID_UTF8_REGEX, $value) !== false;
    }

    public function hasInvalidTokens(): bool
    {
        return $this->hasInvalidTokens;
    }

    /**
     * getPrevious
     *
     * @return Token<int, string>
     */
    public function getPrevious(): Token
    {
        return $this->previous;
    }

    /**
     * Lexical catchable patterns.
     *
     * @return string[]
     */
    protected function getCatchablePatterns(): array
    {
        return self::CATCHABLE_PATTERNS;
>>>>>>> 66597818 ( abdou a faire un poushe)
    }

    /**
=======
    public function hasInvalidTokens(): bool
    {
        return $this->hasInvalidTokens;
    }

    /**
     * getPrevious
     *
     * @return Token<int, string>
     */
    public function getPrevious(): Token
    {
        return $this->previous;
    }

    /**
     * Lexical catchable patterns.
     *
     * @return string[]
     */
    protected function getCatchablePatterns(): array
    {
        return self::CATCHABLE_PATTERNS;
    }

    /**
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
     * Lexical non-catchable patterns.
     *
     * @return string[]
     */
    protected function getNonCatchablePatterns(): array
    {
        return self::NON_CATCHABLE_PATTERNS;
    }

    protected function getModifiers(): string
    {
        return self::MODIFIERS;
    }

    public function getAccumulatedValues(): string
    {
        return $this->accumulator;
    }

    public function startRecording(): void
    {
        $this->hasToRecord = true;
    }

    public function stopRecording(): void
    {
        $this->hasToRecord = false;
    }

    public function clearRecorded(): void
    {
        $this->accumulator = '';
    }
}
