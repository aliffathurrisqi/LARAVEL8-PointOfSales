<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\ProductCategory;
use App\Models\Product\Product;
use App\Models\Transaction\Purchasing;
use App\Models\Transaction\PurchasingDetail;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchasingController extends Controller
{
    public function index()
    {
        $data['titles'] = "Stock In";
        $data['purchases'] = Purchasing::with(['details'])->whereNull('deleted_at')->filter(request(['from', 'to']))->orderBy('purchase_date', 'desc')->get();
        return view('pages.purchasing.index', $data);
    }

    public function create()
    {
        $data['titles'] = "Create Stock In";
        $data['products'] = Product::with(['category'])->whereNull('deleted_at')->get();
        return view('pages.purchasing.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'purchase_date'=>'required',
            'code'=>'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,png',
        ]);

        $item = New Purchasing();
        $item->code = $request->code;
        $item->purchase_date = $request->purchase_date;
        $item->created_by = 1;
        $item->deleted_by = NULL;
        $item->save();

        if($item->save()){
            foreach ($request->product_id as $key => $value) {
                if ($request->quantity[$key] && $request->price[$key]) {

                    $detail = New PurchasingDetail();
                    $detail->product_id = $request->product_id[$key];
                    $detail->price = $request->price[$key];
                    $detail->quantity = $request->quantity[$key];
                    $detail->purchasing_id = $item->id;
                    $detail->save();

                }
            }
        }

        return redirect(route('transaction-purchasing'));
    }

    public function edit($id)
    {
        $data['titles'] = "Edit Stock In";
        // $data['purchases'] = Purchasing::with(['details'])->where('id', $id)->get();
        $data['purchases'] = Purchasing::find($id);
        $data['products'] = Product::with(['category'])->whereNull('deleted_at')->get();
        return view('pages.purchasing.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'purchase_date'=>'required',
            'code'=>'required',
            // 'image'=>'file|image|mimes:jpg,jpeg,png',
        ]);

        $item = Purchasing::find($request->id);
        $item->code = $request->code;
        $item->purchase_date = $request->purchase_date;
        $item->save();

        DB::statement("DELETE FROM purchasing_detail WHERE purchasing_id = $request->id");

        if($item->save()){
            foreach ($request->product_id as $key => $value) {
                if ($request->quantity[$key] && $request->price[$key]) {

                    $detail = New PurchasingDetail();
                    $detail->product_id = $request->product_id[$key];
                    $detail->price = $request->price[$key];
                    $detail->quantity = $request->quantity[$key];
                    $detail->purchasing_id = $request->id;
                    $detail->save();

                }
            }
        }

        return redirect(route('transaction-purchasing'));
    }

    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
        ]);

        $item = Purchasing::find($request->id);
        $item->code = $item->code."- DELETE";
        $item->deleted_at = Carbon::Now();
        $item->deleted_by = 1;
        $item->save();

        return redirect(route('transaction-purchasing'));
    }

}
