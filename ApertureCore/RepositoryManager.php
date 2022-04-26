<?php

namespace ApertureCore;

trait RepositoryManager
{
    private static ?self $manager = null ;


    public static function getRm(): self
    {
        if (is_null(self::$manager)) self::$manager = new self();

        return self::$manager;
    }



    #region fonctions du singleton
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
    #endregion
}