<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::get();
        return view('pages.admin.product.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'thumbnail' => 'required|image'
        ]);

        $path = Storage::put('/products', $request->file('thumbnail'));
        Product::create([
            'user_id' => \Auth::id(),
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')) . '-' . strtolower(Str::random(8)),
            'product_category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'thumbnail_path' => $path
        ]);
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::get();
        return view('pages.admin.product.edit', compact('product', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'thumbnail' => 'image'
        ]);

        if($request->file('thumbnail')){
            Storage::delete($product->thumbnail_path);
            $path = Storage::put('/products', $request->file('thumbnail'));
            $product->update([
                'thumbnail_path' => $path
            ]);
        }

        $product->update([
            'name' => $request->get('name'),
            'product_category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock')
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function getProductDatatable()
    {
        $query = Product::with('category')->withCount('orderDetails');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('_price', function (Product $product) {
                return "<div class=\"badge badge-primary\">\${$product->price}</div>";
            })
            ->addColumn('_stock', function (Product $product) {
                $type = $product->stock === 0 ? 'danger' : 'success';
                return "<div class=\"badge badge-$type\">{$product->stock}</div>";
            })
            ->addColumn('_order_count', function (Product $product) {
                $type = $product->order_details_count === 0 ? 'danger' : 'success';
                return "<div class=\"badge badge-$type\">{$product->order_details_count} Orders</div>";
            })
            ->addColumn('_action', function (Product $product) {
                $editUrl = route('admin.product.edit', $product);
                $deleteUrl = route('admin.product.destroy', $product);
                return "<a href=\"{$editUrl}\" class=\"btn btn-warning mr-2\">Edit</a>" .
                    "<button data-url=\"{$deleteUrl}\" class=\"btn btn--delete btn-danger\">Delete</button>";
            })
            ->rawColumns(['_price', '_stock', '_order_count', '_action'])
            ->make(true);
    }
}
