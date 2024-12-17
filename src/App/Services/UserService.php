<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException as VE;

class UserService
{
    public function __construct(private Database $db)
    {
    }
    public function isEmailtaken(string $email)
    {
        $emailCount = $this->db->query(
            "
        SELECT COUNT(*) FROM users WHERE email= :email",
            [
                'email' => $email
            ]
        )->count();
        if ($emailCount > 0) {
            throw new VE(['email' => 'email taken']);
        }
    }
}
