<?php

namespace PhpTry;

abstract class Attempts
{
    public static function map(callable $f, ...$attempts)
    {
        $results = [];
        foreach ($attempts as $attempt) {
            if (is_object($attempt) && ($attempt instanceof Attempt)) {
                if ($attempt->isSuccessful()) {
                    $attempt = $attempt->get();
                } else {
                    // First failure.
                    return $attempt;
                }
            }

            $results[] = $attempt;
        }

        return new Success($f(...$results));
    }
}
