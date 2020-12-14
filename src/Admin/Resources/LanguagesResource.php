<?php

namespace Leeto\Localization\Admin\Resources;

use Leeto\Localization\Models\ModelLocalizationLanguage;

use Leeto\Admin\Components\Fields\ID;
use Leeto\Admin\Components\Fields\Text;
use Leeto\Admin\Components\Filters\TextFilter;

use Leeto\Admin\Resources\Resource;


/**
 * Class LanguagesResource
 * @package Leeto\Localization\Admin\Resources
 */
class LanguagesResource extends Resource
{
    /**
     * @var string
     */
    public static $model = ModelLocalizationLanguage::class;

    /**
     * @var string
     */
    public $title = "Languages";

    /**
     * @return array
     */
    public function fields()
	{
		return [
            ID::make("id")->sortable(),
            Text::make("name")->required(),
            Text::make("code")->required(),
        ];
	}

    /**
     * @param $item
     * @return array
     */
    public function rules($item) {
	    return [
            "name" => "required",
            "code" => "required",
	    ];
    }

    /**
     * @return array
     */
    public function search()
    {
        return ["id", "name", "code"];
    }

    /**
     * @return array
     */
    public function filters()
    {
        return [
            TextFilter::make("name"),
            TextFilter::make("code"),
        ];
    }

    /**
     * @return array
     */
    public function attributes() {
	    return [
            "id" => "ID",
            "name" => "Name",
            "code" => "Code",
        ];
    }
}
