<?php

namespace App\models;

class User
{
    private ?int $userId;
    private string $name;

    public function __construct($userId, $name)
    {
        $this->userId = $userId;
        $this->name = $name;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return "User ID: " . $this->userId . ", Name: " . $this->name;
    }
}
