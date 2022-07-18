<?php

namespace MrGabriCavi\LaravelGoogleTokenGuard\Models;

use Illuminate\Database\Eloquent\Model;

abstract class GoogleTokenBaseModel extends Model
{
    /**
     * @return string
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
