<?php

namespace Framework\Rules;

use InvalidArgumentException as IAE;

use Framework\Contracts\RuleInterface;

declare(strict_types=1);
class DateRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (empty($params[0])) {
            throw new IAE('Date format is not specified');
        }
        $parsedDate = date_parse_from_format($params[0], $data[$field]);
    }
    public function getMessage(array $data, string $field, array $params): string {}
}
