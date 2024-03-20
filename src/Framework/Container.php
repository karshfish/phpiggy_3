<?php

declare(strict_types=1);

namespace Framework;

class Container
{
    private array $definintions = [];
    public function addDefinitions(array $newDefinitions)
    {
        $this->definintions = [...$this->definintions, ...$newDefinitions];
        dd($this->definintions);
    }
}
