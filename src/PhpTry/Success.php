<?php

namespace PhpTry;

final class Success extends Attempt
{
    /** @var mixed */
    private $result;

    /**
     * @param mixed $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    public function product(Attempt ...$attempts)
    {
        $results = [$this->result];
        foreach ($attempts as $attempt) {
            if ($attempt->isSuccessful()) {
                $results[] = $attempt->get();
            } else {
                // First failure.
                return $attempt;
            }
        }

        return new static($results);
    }

    public function forAll(callable $f)
    {
        $f($this->result);

        return $this;
    }

    public function map(callable $f)
    {
        return new static($f($this->result));
    }

    public function flatMap(callable $f)
    {
        // Must return another Try.
        return $f($this->result);
    }

    public function isSuccessful()
    {
        return true;
    }

    public function get()
    {
        return $this->result;
    }

    public function getOrElse($default)
    {
        return $this->result;
    }

    public function getOrCall(callable $f)
    {
        return $this->result;
    }
}
