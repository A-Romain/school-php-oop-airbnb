<?php

namespace App\Model;

use ApertureCore\Model;

class Bookings extends Model
{
    public int $user_id;
    public int $tental_id;
    public string $chek_in;
    public string $chek_out;
}