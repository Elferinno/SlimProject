<?php

namespace App\Services;

use App\models\User;
use PDO;
use Respect\Validation\Validator as v;

class UserService implements UserServiceInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function saveUser(User $user): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (Name)
                                        VALUES (:name);');

        $stmt->bindValue(':name', $user->getName());

        $stmt->execute();
        $lastUserId = $this->pdo->lastInsertId();

        return $lastUserId;
    }
    public function updateUser(User $user): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET Name = :name WHERE ID = :userId;');

        $stmt->bindValue(':userId', $user->getUserId());
        $stmt->bindValue(':name', $user->getName());

        $stmt->execute();
    }

    public function validateUserId(string $userId): bool
    {
        return v::notEmpty()->numericVal()->validate($userId);
    }
}
