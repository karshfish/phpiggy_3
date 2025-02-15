<?php
#this file is an Interface to create custom rule that will be applied to our field upon submission 
declare(strict_types=1);

namespace Framework\Contracts;

interface RuleInterface
{
    public function validate(array $data, string $field, array $params): bool; //see if the field is validated
    public function getMessage(array $data, string $field, array $params): string; //to gnerate an error mesage
}
