<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{RequiredRule};

class ValidatorService
{
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator;
        $this->validator->addRules('Required', new RequiredRule);
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'e-mail' => ['Required'],
            'Age' => ['Required'],
            'Country' => ['Required'],
            'SocialMediaURL' => ['Required'],
            'pwd' => ['Required'],
            'conf_pwd' => ['Required'],
            'tos' => ['Required']

        ]);
    }
}
