<?php

namespace PhpTry;

use Exception;

abstract class Attempt
{
    public static function fromTry(callable $f, ...$args)
    {
        try {
            return new Success($f(...$args));
        } catch (Exception $error) {
            return new Failure($error);
        }
    }

    abstract public function product(Attempt ...$attempt);

    abstract public function forAll(callable $f);

    abstract public function map(callable $f);

    abstract public function flatMap(callable $f);

    abstract public function isSuccessful();

    abstract public function get();

    abstract public function getOrElse($default);

    abstract public function getOrCall(callable $f);
}
