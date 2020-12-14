<?php

namespace Leeto\Localization\Admin\Controllers;

use Leeto\Localization\Admin\Resources\LanguagesResource;

use Leeto\Admin\Controllers\Controller;
use Leeto\Admin\Traits\ControllerTrait;

/**
 * Class LanguagesController
 * @package Leeto\Localization\Admin\Controllers
 */
class LanguagesController extends Controller
{
    use ControllerTrait;

    /**
     * LanguagesController constructor.
     */
    public function __construct()
    {
        $this->resource = new LanguagesResource();
    }
}
