<?php

namespace App\Model;

use ApertureCore\Model;


class Rentals extends Model
{
    public string $title;
    public int $owner_id;
    public int $type;
    public int $surface;
    public int $capacity;
    public string $description;
    public float $price;
    public Adresses $adresses;
    public array $equipement;
}