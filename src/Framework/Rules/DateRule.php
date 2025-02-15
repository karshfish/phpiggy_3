<?php

declare(strict_types=1);

namespace Framework\Rules;

use InvalidArgumentException as IAE;

use Framework\Contracts\RuleInterface;


class DateRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (empty($params[0])) {
            throw new IAE('Date format is not specified');
        }
        $parsedDate = date_parse_from_format($params[0], $data[$field]);
        return $parsedDate['warning_count'] === 0 && $parsedDate['error_count'] === 0;
    }
    public function getMessage(array $data, string $field, array $params): string
    {
        return "Invalid Date";
    }
}
