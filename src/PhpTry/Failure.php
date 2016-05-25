<?php

namespace PhpTry;

use Exception;

final class Failure extends Attempt
{
    /** @var Exception */
    private $error;

    /**
     * @param Exception $error
     */
    public function __construct(Exception $error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }

    public function product(Attempt ...$attempt)
    {
        return $this;
    }

    public function forAll(callable $f)
    {
        return $this;
    }

    public function map(callable $f)
    {
        return $this;
    }

    public function flatMap(callable $f)
    {
        return $this;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function get()
    {
        // http://lurkmore.to/ССЗБ
        throw $this->error;
    }

    public function getOrElse($default)
    {
        return $default;
    }

    public function getOrCall(callable $f)
    {
        // TODO Error?
        return $f();
    }
}
