<?php

namespace App\Model;

use ApertureCore\Model;

class Bookings extends Model
{
    public int $user_id;
    public int $rental_id;
    public string $chek_in;
    public string $chek_out;
    public Adresses $adresses;
    public array $equipement;
    public array $rentals;
}