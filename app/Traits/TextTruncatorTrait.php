<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait TextTruncatorTrait
{
    public static function truncateText($text, $length = 150)
    {
        return Str::limit(strip_tags($text), $length);
    }
}