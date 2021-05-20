<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.admin.customer.index');
    }

    public function show(User $user)
    {
        return view('pages.admin.customer.show', compact('user'));
    }

    public function getCustomerDatatable()
    {
        $query = User::withCount('orders');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('joined_at', function (User $user) {
                return $user->created_at->format('d F Y');
            })
            ->addColumn('_action', function (User $user) {
                $url = route('admin.customer.show', $user);
                return "<a href=\"{$url}\" class=\"btn btn-secondary\">Detail</a>";
            })
            ->rawColumns(['_action'])
            ->make(true);
    }
}
