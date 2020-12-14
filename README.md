# laravel-model-localization

## Install
- composer require lee-to/laravel-model-localization

- php artisan vendor:publish --provider="Leeto\Localization\Providers\LocalizationServiceProvider"
- php artisan migrate

## Integration with laravel-admin
- set admin path in admin config 
- add extension to admin config 
'extensions' => [
    \Leeto\Localization\Admin\Extensions\LocalizationExtension::class
],
- add to admin route Route::resource('languages', \Leeto\Localization\Admin\Controllers\LanguagesController::class);
- add to admin menu ["class" =>\Leeto\Localization\Admin\Controllers\LanguagesController::class, "title" => "Languages"],