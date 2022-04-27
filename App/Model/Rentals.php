<?php

namespace App\Model;

use ApertureCore\Model;


class Rentals extends Model
{
    public string $title;
    public int $owner_id;
    public int $type;
    public int $surface;
    public string $description;
    public int $capacity;
    public int $price;
    public int $addresse_id;
}