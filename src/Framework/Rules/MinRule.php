<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException as IAE;

class MinRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (empty($params[0])) {
            throw new IAE("Minimum length not specified");
        }
        $length = $params[0];
        return $data[$field] >= $length;
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "You are under required age. Must be at least {$params[0]}";
    }
}
