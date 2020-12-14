<?php

namespace Leeto\Localization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelLocalization
 * @package Leeto\Localization\Models
 */
class ModelLocalization extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ["lang_id", "data", "modelable_type", "modelable_id"];

    /**
     * @var array
     */
    protected $casts = [
        "data" => "json",
    ];

    /**
     * Get the owning modelable model.
     */
    public function modelable()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function lang() {
        return $this->belongsTo(ModelLocalizationLanguage::class);
    }
}
