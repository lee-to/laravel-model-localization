<?php
namespace Leeto\Localization\Admin\Extensions;

use Illuminate\Database\Eloquent\Model;

use Leeto\Admin\Components\Fields\ID;
use Leeto\Admin\Extensions\Extension;
use Leeto\Localization\Models\ModelLocalizationLanguage;
use Leeto\Localization\Traits\Localization;

/**
 * Class LocalizationExtension
 * @package Leeto\Localization\Admin\Extensions
 */
class LocalizationExtension extends Extension
{
    /**
     * @return array
     */
    public function formFields()
    {
        $defaultLang = ModelLocalizationLanguage::where(["code" => app()->getLocale()])->first();
        $defaultLangId = request("model_localization_language") ? request("model_localization_language") : ($defaultLang ? $defaultLang->id : null);

        return [
            ID::make("lang_id")->index(false)->default($defaultLangId)
        ];
    }

    /**
     * @param Model $item
     * @return mixed
     */
    public function editTabs(Model $item)
    {
        if(request()->route()->getActionMethod() != "create" && (in_array(Localization::class, class_uses_recursive($item)))) {
            foreach (ModelLocalizationLanguage::all() as $lang) {
                $this->tabs[] = ["id" => $lang->id, "name" => $lang->name, "active" => $lang->code == app()->getLocale(), "query" => [
                    "model_localization_language" => $lang->id,
                    "model_localization_language_code" => $lang->code
                ]];
            }
        }


        return parent::editTabs($item);
    }
}