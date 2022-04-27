<?php

declare(strict_types=1);

use App\Orchid\Screens\Country\ListScreen as CountryListScreen;
use App\Orchid\Screens\Country\EditScreen as CountryEditScreen;

use App\Orchid\Screens\City\ListScreen as CityListScreen;
use App\Orchid\Screens\City\EditScreen as CityEditScreen;

use App\Orchid\Screens\Customer\ListScreen as CustomerListScreen;
use App\Orchid\Screens\Customer\EditScreen as CustomerEditScreen;
use App\Orchid\Screens\Customer\ShowScreen as CustomerShowScreen;

use App\Orchid\Screens\Display\ListScreen as DisplayListScreen;
use App\Orchid\Screens\Display\EditScreen as DisplayEditScreen;

use App\Orchid\Screens\Video\ListScreen as VideoListScreen;
use App\Orchid\Screens\Video\EditScreen as VideoEditScreen;

use App\Orchid\Screens\Order\ListScreen as OrderListScreen;
use App\Orchid\Screens\Order\EditScreen as OrderEditScreen;

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > Customer
Route::screen('customers', CustomerListScreen::class)
    ->name('platform.customers')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Заказчики'), route('platform.customers'));
    });
// Platform > Customers > Create
Route::screen('customers/create', CustomerEditScreen::class)
    ->name('platform.customers.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.customers')
            ->push(__('Создать'), route('platform.customers.create'));
    });
// Platform > Customers > Edit
Route::screen('customers/{customer}/edit', CustomerEditScreen::class)
    ->name('platform.customers.edit')
    ->breadcrumbs(function (Trail $trail, $customer) {
        return $trail
            ->parent('platform.customers')
            ->push(__('Заказчик'), route('platform.customers.edit', $customer));
    });

// Platform > Customers > Show
Route::screen('customers/{customer}/show', CustomerShowScreen::class)
    ->name('platform.customers.show')
    ->breadcrumbs(function (Trail $trail, $customer) {
        return $trail
            ->parent('platform.customers')
            ->push(__('Информация о заказчике'), route('platform.customers.show', $customer));
    });

// Platform > City
Route::screen('cities', CityListScreen::class)
    ->name('platform.cities')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Города'), route('platform.cities'));
    });
// Platform > Cities > Create
Route::screen('cities/create', CityEditScreen::class)
    ->name('platform.cities.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.cities')
            ->push(__('Создать'), route('platform.cities.create'));
    });
// Platform > Cities > Edit
Route::screen('cities/{city}/edit', CityEditScreen::class)
    ->name('platform.cities.edit')
    ->breadcrumbs(function (Trail $trail, $city) {
        return $trail
            ->parent('platform.cities')
            ->push(__('Город'), route('platform.cities.edit', $city));
    });

// Platform > Country
Route::screen('countries', CountryListScreen::class)
    ->name('platform.countries')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Страны'), route('platform.countries'));
    });
// Platform > Countries > Create
Route::screen('countries/create', CountryEditScreen::class)
    ->name('platform.countries.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.countries')
            ->push(__('Создать'), route('platform.countries.create'));
    });
// Platform > Countries > Edit
Route::screen('countries/{country}/edit', CountryEditScreen::class)
    ->name('platform.countries.edit')
    ->breadcrumbs(function (Trail $trail, $country) {
        return $trail
            ->parent('platform.countries')
            ->push(__('Страна'), route('platform.countries.edit', $country));
    });

// Platform > Display
Route::screen('displays', DisplayListScreen::class)
    ->name('platform.displays')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Экраны'), route('platform.displays'));
    });
// Platform > Display > Create
Route::screen('displays/create', DisplayEditScreen::class)
    ->name('platform.displays.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.displays')
            ->push(__('Создать'), route('platform.displays.create'));
    });
// Platform > Display > Edit
Route::screen('displays/{display}/edit', DisplayEditScreen::class)
    ->name('platform.displays.edit')
    ->breadcrumbs(function (Trail $trail, $display) {
        return $trail
            ->parent('platform.displays')
            ->push(__('Экраны'), route('platform.displays.edit', $display));
    });

// Platform > Video
Route::screen('videos', VideoListScreen::class)
    ->name('platform.videos')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Ролики'), route('platform.videos'));
    });
// Platform > Video > Create
Route::screen('videos/create', VideoEditScreen::class)
    ->name('platform.videos.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.videos')
            ->push(__('Создать'), route('platform.videos.create'));
    });
// Platform > Video > Edit
Route::screen('videos/{video}/edit', VideoEditScreen::class)
    ->name('platform.videos.edit')
    ->breadcrumbs(function (Trail $trail, $video) {
        return $trail
            ->parent('platform.videos')
            ->push(__('Ролики'), route('platform.videos.edit', $video));
    });

// Platform > Order
Route::screen('orders', OrderListScreen::class)
    ->name('platform.orders')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Заказы'), route('platform.orders'));
    });
// Platform > Order > Create
Route::screen('orders/create', OrderEditScreen::class)
    ->name('platform.orders.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.orders')
            ->push(__('Создать'), route('platform.orders.create'));
    });
// Platform > Order > Edit
Route::screen('orders/{order}/edit', OrderEditScreen::class)
    ->name('platform.orders.edit')
    ->breadcrumbs(function (Trail $trail, $order) {
        return $trail
            ->parent('platform.orders')
            ->push(__('Заказ'), route('platform.orders.edit', $order));
    });