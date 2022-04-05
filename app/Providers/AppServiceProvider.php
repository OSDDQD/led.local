<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Screen\TD;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TD::macro('bool', function () {

            $column = $this->column;
        
            $this->render(function ($datum) use ($column) {
                return view('columns.bool',[
                    'bool' => $datum->$column
                ]);
            });
        
            return $this;
        });
    }
}
