<?php

namespace App\Model;

use ApertureCore\Model;

class Users extends Model
{
    public string $email;
    public string $password;
    public string $type;
}