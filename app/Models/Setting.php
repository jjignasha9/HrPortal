<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key','value'];

    public static function get(string $key, $default = null)
    {
        $val = cache()->remember("setting_{$key}", 3600, fn() => optional(static::where('key',$key)->first())->value);
        return $val !== null ? $val : $default;
    }
}
