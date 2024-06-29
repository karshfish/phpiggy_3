<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MinRule implements RuleInterface
{
    public function validate(array $data, string $field, array $parms): bool
    {
        if ($data[$field] < $parms[0]) {
            return false;
        } else {
            return true;
        }
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "You are under required age.";
    }
}
