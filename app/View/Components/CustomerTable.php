<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomerTable extends Component
{
    public $datatableApiUrl;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->datatableApiUrl = route('admin.datatable.customer');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.customer-table');
    }
}
