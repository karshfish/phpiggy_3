<?php

namespace Framework\Rules;

use InvalidArgumentException as IAE;

use Framework\Contracts\RuleInterface;

class LengthMaxRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    if (empty($params)) {
      throw new IAE('Maximum number of characters is specified');
    }
    $max = (int) $params[0];
    return strlen($data[$field]) < $max;
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return 'Exceeded max number of characters';
  }
}
