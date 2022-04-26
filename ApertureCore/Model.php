<?php

namespace ApertureCore;

use PDO;

abstract class Model
{
    public int $id;

    protected static PDO $pdoInstance;

    public function __construct( array $data_row = [])
    {

        foreach ($data_row as $column => $value ){
            if ( !property_exists($this, $column)) continue;

            $this->$column = $value;
    }
    }
}