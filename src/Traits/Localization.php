<?php
namespace Leeto\Localization\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Leeto\Localization\Models\ModelLocalization;
use Leeto\Localization\Models\ModelLocalizationLanguage;

/**
 * Trait Localization
 * @package Leeto\Localization\Traits
 */
trait Localization
{
    /**
     * @var
     */
    protected $localizationData;

    /**
     * @var bool
     */
    protected $hasLocalization = true;

    /* Relationships */

    /**
     * Get the entity's localizations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function localizations()
    {
        return $this->morphMany(ModelLocalization::class, 'modelable');
    }

    /**
     *
     */
    protected static function booted()
    {
        static::created(function ($item) {
            $item->makeLocalization(request("lang_id"));
        });

        static::updated(function ($item) {
            $item->makeLocalization(request("lang_id"));
        });
    }

    /**
     * @param $lang_id
     * @return bool|Model
     */
    public function makeLocalization($lang_id) {
        if(is_null($lang_id)) {
            return false;
        }

        $lang = ModelLocalizationLanguage::findOrFail($lang_id);

        if(!isset($this->localizationFields) || !$this->localizationFields) {
            return false;
        }

        return $this->localizations()->updateOrCreate(["lang_id" => $lang->id], [
            "lang_id" => $lang->id,
            "data" => $this->only($this->localizationFields),
        ]);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $lang = request("model_localization_language_code") ? request("model_localization_language_code") : app()->getLocale();

        if($this->hasLocalization && isset($this->localizationFields) && $this->localizationFields && in_array($name, $this->localizationFields) ) {
            $this->localizationData = $this->localizationData ? $this->localizationData : $this->localizations()->whereHas("lang", function (Builder $query) use ($lang) {
                return $query->where(["code" => $lang]);
            })->first();

            if($this->localizationData) {
                $data = !is_array($this->localizationData->data) ? json_decode($this->localizationData->data, true) : $this->localizationData->data;

                if(isset($data[$name]) && !is_array($data[$name])) {
                    return $data[$name];
                }
            } else {
                $this->hasLocalization = false;
            }
        }

        return parent::__get($name);
    }
}