<?php

namespace App\Model;

use ApertureCore\Model;

class Users  extends Model
{
    public string $mail;
    public string $password;
    public int $type;
}