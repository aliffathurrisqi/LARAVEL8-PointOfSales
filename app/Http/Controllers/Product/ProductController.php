<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\ProductCategory;
use App\Models\Product\Product;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $data['titles'] = "Produk";
        $data['categories'] = ProductCategory::whereNull('deleted_at')->where('id' , "!=" , 1)->orderBy('name')->get();
        $data['products'] = Product::with(['category'])->join('view_kartu_stock', 'master_products.id', '=', 'view_kartu_stock.id')->whereNull('deleted_at')->get();
        return view('pages.product.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'code'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,png',
        ]);

        $item = New Product();
        $item->code = $request->code;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->created_by = 1;
        $item->category_id = $request->category_id;
        $item->deleted_by = NULL;
        $item->save();

        return redirect(route('product-index'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,png',
        ]);

        $item = Product::find($request->id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->category_id = $request->category_id;
        $item->save();

        return redirect(route('product-index'));
    }

    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
        ]);

        $item = Product::find($request->id);
        $item->deleted_at = Carbon::Now();
        $item->deleted_by = 1;
        $item->save();

        return redirect(route('product-index'));
    }

}
