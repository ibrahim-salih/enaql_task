<?php

namespace App\Providers;

use App\View\Components\Admin\AddModal;
use App\View\Components\Admin\AddModalScript;
use App\View\Components\Admin\DeleteModal;
use App\View\Components\Admin\Datatable;
use App\View\Components\Admin\DatatableScript;
use App\View\Components\Admin\DeleteModalScript;
use App\View\Components\Admin\EditModal;
use App\View\Components\Admin\EditModalScript;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;


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
        Schema::defaultStringLength(191);
        Blade::component('admin-delete-modal',DeleteModal::class);
        Blade::component('admin-add-modal',AddModal::class);
        Blade::component('admin-edit-modal',EditModal::class);
        Blade::component('admin-datatable-table',Datatable::class);
        Blade::component('admin-datatable-script',DatatableScript::class);
        Blade::component('admin-delete-modal-script',DeleteModalScript::class);
        Blade::component('admin-add-modal-script',AddModalScript::class);
        Blade::component('admin-edit-modal-script',EditModalScript::class);
    }
}
