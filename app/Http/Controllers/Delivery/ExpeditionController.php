<?php

namespace App\Http\Controllers\Delivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;

use App\Models\Delivery\Expedition;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

class ExpeditionController extends Controller
{
    // public function index()
    // {
    //     $data['titles'] = "Kategori Produk";
    //     $data['categories'] = ProductCategory::whereNull('deleted_at')->where('id' , "!=" , 1)->get();
    //     return view('pages.product_category.index', $data);
    // }

    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'name'=>'required',
    //         // 'image'=>'file|image|mimes:jpg,jpeg,png',
    //     ]);

    //     $item = New ProductCategory();
    //     $item->name = $request->name;
    //     $item->save();

    //     return redirect(route('product-category'));
    // }

    // public function update(Request $request)
    // {
    //     $this->validate($request,[
    //         'id'=>'required',
    //         'name'=>'required',
    //         // 'image'=>'file|image|mimes:jpg,jpeg,png',
    //     ]);

    //     $item = ProductCategory::find($request->id);
    //     $item->name = $request->name;
    //     $item->save();

    //     return redirect(route('product-category'));
    // }

    // public function destroy(Request $request)
    // {
    //     $this->validate($request,[
    //         'id'=>'required',
    //     ]);

    //     DB::statement("UPDATE master_products SET category_id = 1 WHERE category_id = ".$request->id);

    //     $item = ProductCategory::find($request->id);
    //     $item->deleted_at = Carbon::Now();
    //     $item->save();

    //     return redirect(route('product-category'));
    // }

    public function import()
    {
        $response = Http::get('https://api.binderbyte.com/v1/list_courier?api_key=9ed0416b315f28fdeb338b44f69e94ef2a8785a02f1ebbbf9f24f49f2fabe84b');
        $apis = json_decode($response->body());

        foreach($apis as $data){
            $item = new Expedition();
            $item->name = $data->description;
            $item->code = $data->code;
            $item->save();
        }
    }

}
