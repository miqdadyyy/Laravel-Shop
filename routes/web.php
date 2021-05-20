<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/redirector', function () {
    if (Auth::guest()) return redirect()->route('homepage');
    else if (Auth::user()->hasRole('admin')) return redirect()->route('admin.transaction.index');
    else if (Auth::user()->hasRole('member')) return redirect()->route('member.transaction.index');
    return redirect()->route('homepage');
})->name('redirector');

Route::get('/', [\App\Http\Controllers\HomepageController::class, 'index'])->name('homepage');
Route::get('/shop/{category:slug?}/', [\App\Http\Controllers\HomepageController::class, 'productList'])->name('homepage.product-list');
Route::get('/shop/product/{product:slug}', [\App\Http\Controllers\HomepageController::class, 'productDetail'])->name('homepage.product-detail');

Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function () {
    Route::get('/transaction', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/{order:invoice}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transaction.show');

    Route::get('/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customers/{user}', [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customer.show');

    Route::resource('/product', \App\Http\Controllers\Admin\ProductController::class);

    Route::get('/api/transaction', [\App\Http\Controllers\Admin\TransactionController::class, 'getTransactionDatatable'])->name('datatable.transaction');
    Route::get('/api/product', [\App\Http\Controllers\Admin\ProductController::class, 'getProductDatatable'])->name('datatable.product');
    Route::get('/api/customer', [\App\Http\Controllers\Admin\CustomerController::class, 'getCustomerDatatable'])->name('datatable.customer');
});

Route::group(['prefix' => 'member', 'as' => 'member.', 'middleware' => 'role:member'], function () {
    Route::get('/transaction', [\App\Http\Controllers\Member\TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/{order:invoice}', [\App\Http\Controllers\Member\TransactionController::class, 'show'])->name('transaction.show');

    Route::get('/api/transaction', [\App\Http\Controllers\Member\TransactionController::class, 'getTransactionDatatable'])->name('datatable.transaction');
});

Route::post('/_webhook/stripe/success', [\App\Http\Controllers\WebhookController::class, 'stripePaymentSuccess']);
