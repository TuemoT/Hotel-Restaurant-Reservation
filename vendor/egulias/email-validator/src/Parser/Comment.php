<?php

namespace Egulias\EmailValidator\Parser;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Result\Result;
use Egulias\EmailValidator\Warning\QuotedPart;
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Parser\CommentStrategy\CommentStrategy;
use Egulias\EmailValidator\Result\Reason\UnclosedComment;
use Egulias\EmailValidator\Result\Reason\UnOpenedComment;
use Egulias\EmailValidator\Warning\Comment as WarningComment;

class Comment extends PartParser
{
    /**
     * @var int
     */
    private $openedParenthesis = 0;

    /**
     * @var CommentStrategy
     */
    private $commentStrategy;

    public function __construct(EmailLexer $lexer, CommentStrategy $commentStrategy)
    {
        $this->lexer = $lexer;
        $this->commentStrategy = $commentStrategy;
    }

    public function parse(): Result
    {
<<<<<<< HEAD
<<<<<<< HEAD
        if (((array) $this->lexer->token)['type'] === EmailLexer::S_OPENPARENTHESIS) {
            $this->openedParenthesis++;
            if($this->noClosingParenthesis()) {
                return new InvalidEmail(new UnclosedComment(), ((array) $this->lexer->token)['value']);
            }
        }

        if (((array) $this->lexer->token)['type'] === EmailLexer::S_CLOSEPARENTHESIS) {
            return new InvalidEmail(new UnOpenedComment(), ((array) $this->lexer->token)['value']);
=======
        if ($this->lexer->current->isA(EmailLexer::S_OPENPARENTHESIS)) {
            $this->openedParenthesis++;
            if ($this->noClosingParenthesis()) {
                return new InvalidEmail(new UnclosedComment(), $this->lexer->current->value);
            }
        }

        if ($this->lexer->current->isA(EmailLexer::S_CLOSEPARENTHESIS)) {
            return new InvalidEmail(new UnOpenedComment(), $this->lexer->current->value);
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
        if ($this->lexer->current->isA(EmailLexer::S_OPENPARENTHESIS)) {
            $this->openedParenthesis++;
            if ($this->noClosingParenthesis()) {
                return new InvalidEmail(new UnclosedComment(), $this->lexer->current->value);
            }
        }

        if ($this->lexer->current->isA(EmailLexer::S_CLOSEPARENTHESIS)) {
            return new InvalidEmail(new UnOpenedComment(), $this->lexer->current->value);
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
        }

        $this->warnings[WarningComment::CODE] = new WarningComment();

        $moreTokens = true;
        while ($this->commentStrategy->exitCondition($this->lexer, $this->openedParenthesis) && $moreTokens) {

            if ($this->lexer->isNextToken(EmailLexer::S_OPENPARENTHESIS)) {
                $this->openedParenthesis++;
            }
            $this->warnEscaping();
            if ($this->lexer->isNextToken(EmailLexer::S_CLOSEPARENTHESIS)) {
                $this->openedParenthesis--;
            }
            $moreTokens = $this->lexer->moveNext();
        }

<<<<<<< HEAD
<<<<<<< HEAD
        if($this->openedParenthesis >= 1) {
            return new InvalidEmail(new UnclosedComment(), ((array) $this->lexer->token)['value']);
        }
        if ($this->openedParenthesis < 0) {
            return new InvalidEmail(new UnOpenedComment(), ((array) $this->lexer->token)['value']);
=======
=======
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
        if ($this->openedParenthesis >= 1) {
            return new InvalidEmail(new UnclosedComment(), $this->lexer->current->value);
        }
        if ($this->openedParenthesis < 0) {
            return new InvalidEmail(new UnOpenedComment(), $this->lexer->current->value);
<<<<<<< HEAD
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
        }

        $finalValidations = $this->commentStrategy->endOfLoopValidations($this->lexer);

        $this->warnings = array_merge($this->warnings, $this->commentStrategy->getWarnings());

        return $finalValidations;
    }


    /**
     * @return bool
     */
    private function warnEscaping(): bool
    {
        //Backslash found
<<<<<<< HEAD
<<<<<<< HEAD
        if (((array) $this->lexer->token)['type'] !== EmailLexer::S_BACKSLASH) {
=======
        if (!$this->lexer->current->isA(EmailLexer::S_BACKSLASH)) {
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
        if (!$this->lexer->current->isA(EmailLexer::S_BACKSLASH)) {
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
            return false;
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB, EmailLexer::C_DEL))) {
            return false;
        }

        $this->warnings[QuotedPart::CODE] =
<<<<<<< HEAD
<<<<<<< HEAD
            new QuotedPart($this->lexer->getPrevious()['type'], ((array) $this->lexer->token)['type']);
=======
            new QuotedPart($this->lexer->getPrevious()->type, $this->lexer->current->type);
>>>>>>> 66597818 ( abdou a faire un poushe)
        return true;
    }

<<<<<<< HEAD
    private function noClosingParenthesis() : bool
=======
    private function noClosingParenthesis(): bool
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
            new QuotedPart($this->lexer->getPrevious()->type, $this->lexer->current->type);
        return true;
    }

    private function noClosingParenthesis(): bool
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    {
        try {
            $this->lexer->find(EmailLexer::S_CLOSEPARENTHESIS);
            return false;
        } catch (\RuntimeException $e) {
            return true;
        }
    }
}
