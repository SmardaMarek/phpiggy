<?php

namespace App\Config;

class Paths
{
    public static function getViewPath()
    {
        return __DIR__ . '/../views';
    }

    public static function getSourcePath()
    {
        return __DIR__ . '/../../';
    }

    public static function getRootPath()
    {
        return __DIR__ . '/../../../';
    }
}
