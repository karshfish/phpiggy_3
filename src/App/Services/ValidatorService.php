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
    MatchRule
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
}
