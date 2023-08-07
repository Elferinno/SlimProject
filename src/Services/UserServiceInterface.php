<?php

namespace App\Services;

use App\models\User;

interface UserServiceInterface
{
    public function saveUser(User $user);
}
