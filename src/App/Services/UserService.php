<?php

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db)
    {
    }

    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            ['email' => $email]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ['Email is already registered']]);
        }
    }

    public function create(array $data)
    {
        $password = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $this->db->query(
            "INSERT INTO users (email, password, age, country, 
            social_media_url)
             VALUES (:email, :password, :age, :country, 
            :social_media_url)",
            [
                'email' => $data['email'],
                'password' => $password,
                'age' => $data['age'],
                'country' => $data['country'],
                'social_media_url' => $data['socialMediaURL'],
            ]
        );
        session_regenerate_id();
        $_SESSION['user'] = $this->db->id();
    }
    public function login(array $formData)
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']
        ])->find();
        $passwordsMatch = password_verify($formData['password'], $user['password'] ?? '');
        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Invalid login']]);
        }
        session_regenerate_id();
        $_SESSION['user'] = $user['id'];
    }

    public function logout()
    {
        // unset($_SESSION['user']);
        session_destroy();
        // session_regenerate_id();
        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
}
