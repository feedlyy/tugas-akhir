<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('namaRuangan', function ($attribute, $value, $parameters, $validator) {
            /*return $value == 'foo';*/
            $count = DB::table('ruangans')->where('id_ruangan', $value)
                ->where('id_gedung', $parameters[0])
                ->count();

            return $count === 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }
}
