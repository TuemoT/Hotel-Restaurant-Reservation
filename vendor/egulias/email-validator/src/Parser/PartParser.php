<?php

namespace Egulias\EmailValidator\Parser;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Result\Reason\ConsecutiveDot;
use Egulias\EmailValidator\Result\Result;
use Egulias\EmailValidator\Result\ValidEmail;
use Egulias\EmailValidator\Warning\Warning;

abstract class PartParser
{
    /**
     * @var Warning[]
     */
    protected $warnings = [];

    /**
     * @var EmailLexer
     */
    protected $lexer;

    public function __construct(EmailLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    abstract public function parse(): Result;

    /**
     * @return Warning[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    protected function parseFWS(): Result
    {
        $foldingWS = new FoldingWhiteSpace($this->lexer);
        $resultFWS = $foldingWS->parse();
        $this->warnings = array_merge($this->warnings, $foldingWS->getWarnings());
        return $resultFWS;
    }

    protected function checkConsecutiveDots(): Result
    {
<<<<<<< HEAD
<<<<<<< HEAD
        if (((array) $this->lexer->token)['type'] === EmailLexer::S_DOT && $this->lexer->isNextToken(EmailLexer::S_DOT)) {
            return new InvalidEmail(new ConsecutiveDot(), ((array) $this->lexer->token)['value']);
=======
        if ($this->lexer->current->isA(EmailLexer::S_DOT) && $this->lexer->isNextToken(EmailLexer::S_DOT)) {
            return new InvalidEmail(new ConsecutiveDot(), $this->lexer->current->value);
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
        if ($this->lexer->current->isA(EmailLexer::S_DOT) && $this->lexer->isNextToken(EmailLexer::S_DOT)) {
            return new InvalidEmail(new ConsecutiveDot(), $this->lexer->current->value);
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
        }

        return new ValidEmail();
    }

    protected function escaped(): bool
    {
        $previous = $this->lexer->getPrevious();

<<<<<<< HEAD
<<<<<<< HEAD
        return $previous && $previous['type'] === EmailLexer::S_BACKSLASH
            &&
            ((array) $this->lexer->token)['type'] !== EmailLexer::GENERIC;
=======
        return $previous->isA(EmailLexer::S_BACKSLASH)
            && !$this->lexer->current->isA(EmailLexer::GENERIC);
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
        return $previous->isA(EmailLexer::S_BACKSLASH)
            && !$this->lexer->current->isA(EmailLexer::GENERIC);
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    }
}
