<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class DatatableScript extends Component
{
    public $columns;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columns,$route)
    {
        $this->columns = $columns;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.datatable-script');
    }
}
