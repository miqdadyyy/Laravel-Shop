<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class TransactionTable extends Component
{
    public $datatableApiUrl;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user = null)
    {
        if($user){
            $this->datatableApiUrl = route('admin.datatable.transaction', ['user' => $user]);
        } else {
            $this->datatableApiUrl = Auth::user()->hasRole('admin') ? route('admin.datatable.transaction') : route('member.datatable.transaction');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.transaction-table');
    }
}
