<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    MinRule,
    InRule,
    URLRule,
    MatchRule,
    LengthMaxRule,
    NumericRule
};

class ValidatorService
{
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator;
        $this->validator->addRules('Required', new RequiredRule);
        $this->validator->addRules('Email', new EmailRule);
        $this->validator->addRules('min', new MinRule);
        $this->validator->addRules('In', new InRule);
        $this->validator->addRules('URL', new URLRule);
        $this->validator->addRules('Match', new MatchRule);
        $this->validator->addRules('LengthMax', new LengthMaxRule);
        $this->validator->addRules('isNumeric', new NumericRule);
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'e-mail' => ['Required', 'Email'],
            'Age' => ['Required', 'min:18'],
            'Country' => ['Required', "In:USA,Canada,Mexico"],
            'SocialMediaURL' => ['Required', "URL"],
            'pwd' => ['Required'],
            'conf_pwd' => ['Required', "Match:pwd"],
            'tos' => ['Required']

        ]);
    }
    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['Required', 'Email'],
            'password' => ['Required']
        ]);
    }
    public function validateCreate(array $formData)
    {
        $this->validator->validate($formData, [
            'description' => ['Required', 'LengthMax:255'],
            'amount' => ['Required', 'isNumeric'],
            'date' => ['Required']
        ]);
    }
}
