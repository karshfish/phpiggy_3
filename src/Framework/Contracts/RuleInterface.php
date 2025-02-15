<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface RuleInterface
{
    public function validate(array $data, string $field, array $params): bool; //see if the field is validated
    public function getMessage(array $data, string $field, array $params): string; //to gnerate an error mesage
}
