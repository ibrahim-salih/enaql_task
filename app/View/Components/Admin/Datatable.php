<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Datatable extends Component
{
    public $columns;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.datatable' , [
            'columns' => $this->columns
        ]);
    }
}
