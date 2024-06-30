<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class InRule implements RuleInterface
{
    public function validate(array $data, string $field, array $parms): bool
    {
        return in_array($data[$field], $parms);
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "Invalid Country please select from the list.";
    }
}
