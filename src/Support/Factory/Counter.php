<?php

namespace App\Support\Factory;

class Counter
{
    public function __construct(
        private int $count = 0
    ) {
    }

    public function setCount(int $count): static
    {
        $this->count = $count;

        return $this;
    }

    public function count(callable $fn): array|object
    {
        $items = [];
        $counter = 0;

        do {
            $item = $fn();
            $items[] = $item;
        } while (++$counter < $this->count);

        return $this->count ? $items : $item;
    }
}
