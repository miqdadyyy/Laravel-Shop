<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        return view('pages.admin.transaction.index');
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('pages.admin.transaction.show', compact('order'));
    }

    public function getTransactionDatatable(Request $request)
    {
        $query = Order::with('user');
        if($user = $request->get('user')){
            $query->where('user_id', $user);
        }
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('order_at', function (Order $order) {
                return $order->created_at->format('d F Y, H:i');
            })
            ->addColumn('_payment', function (Order $order) {
                $method = ucfirst($order->payment_method);
                return "<div class=\"badge badge-primary\">{$method}</div>";
            })
            ->addColumn('_status', function (Order $order) {
                return $order->status === 'paid' ? '<div class="badge badge-success">Paid</div>' : '<div class="badge badge-secondary">Pending</div>';
            })
            ->addColumn('_action', function (Order $order) {
                $url = route('admin.transaction.show', $order);
                return "<a href=\"{$url}\" class=\"btn btn-secondary\">Detail</a>";
            })
            ->rawColumns(['_status', '_action', '_payment'])
            ->make(true);
    }
}
