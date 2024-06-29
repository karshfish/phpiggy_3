<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule
};

class ValidatorService
{
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator;
        $this->validator->addRules('Required', new RequiredRule);
        $this->validator->addRules('Email', new EmailRule);
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'e-mail' => ['Required', 'Email'],
            'Age' => ['Required', 'min:18'],
            'Country' => ['Required'],
            'SocialMediaURL' => ['Required'],
            'pwd' => ['Required'],
            'conf_pwd' => ['Required'],
            'tos' => ['Required']

        ]);
    }
}
