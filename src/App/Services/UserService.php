<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException as VE;

class UserService
{
    public function __construct(private Database $db) {}
    public function isEmailtaken(string $email)
    {
        $emailCount = $this->db->query(
            'SELECT COUNT(*) FROM users WHERE email= :email',
            [
                'email' => $email
            ]
        )->count();
        if ($emailCount > 0) {
            throw new VE(['email' => 'email taken']);
        }
    }
    public function createUser(array $userinfo)
    {
        $hashed_pwd = password_hash(password: $userinfo['pwd'],  algo: PASSWORD_BCRYPT, options: ['cost' => 12]);
        $this->db->query(

            'INSERT INTO users (email, password, country,age, social_media_url)
        VALUES (:email, :password, :country, :age, :social_media_url)',
            [
                'email' => $userinfo['e-mail'],
                'password' => $hashed_pwd,
                'country' => $userinfo['Country'],
                'age' => $userinfo['Age'],
                "social_media_url" => $userinfo['SocialMediaURL']


            ]
        );
    }
    public function login(array $userinfo) {}
}
