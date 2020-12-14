<?php

namespace Leeto\Localization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelLocalizationLanguage
 * @package Leeto\Localization\Models
 */
class ModelLocalizationLanguage extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ["name", "code"];
}
