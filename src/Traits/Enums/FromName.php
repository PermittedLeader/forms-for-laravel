<?php

namespace Permittedleader\Forms\Traits\Enums;

trait FromName
{
    public static function fromName($name)
    {
        return constant("self::$name");
    }
}
