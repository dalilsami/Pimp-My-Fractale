<?php

class complex
{
    public $float = 0;
    public $imaginary = 0;

    public function add_complex($a, $b)
    {
        $c = new complex();

        $c->float = $a->float + $b->float;
        $c->imaginary = $a->imaginary + $b->imaginary;
        return $c;
    }

    public function mult_complex($a, $b)
    {
        $c = new complex();

        $c->float = $a->float * $b->float - $a->imaginary * $b->imaginary;
        $c->imaginary = $a->float * $b->imaginary + $a->imaginary * $b->float;
        return $c;
    }

    public function pow_complex($a, $p)
    {
        if ($p == 1)
            return $a;
        return $this->mult_complex($a, $this->pow_complex($a, $p - 1));
    }
}