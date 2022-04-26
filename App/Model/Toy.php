<?php

namespace App\Model;

use ApertureCore\Model;

class Toy extends Model
{
    public string $name;
    public string $description;
    public int $brand_id;
    public float $price;
    public string $image;
}