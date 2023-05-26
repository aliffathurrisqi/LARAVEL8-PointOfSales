<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $data['titles'] = "Kategori Produk";
        $data['categories'] = ProductCategory::whereNull('deleted_at')->where('id' , "!=" , 1)->get();
        return view('pages.product_category.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,png',
        ]);

        $item = New ProductCategory();
        $item->name = $request->name;
        $item->save();

        return redirect(route('product-category'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
            'name'=>'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,png',
        ]);

        $item = ProductCategory::find($request->id);
        $item->name = $request->name;
        $item->save();

        return redirect(route('product-category'));
    }

    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
        ]);

        DB::statement("UPDATE master_products SET category_id = 1 WHERE category_id = ".$request->id);

        $item = ProductCategory::find($request->id);
        $item->deleted_at = Carbon::Now();
        $item->save();

        return redirect(route('product-category'));
    }

}
