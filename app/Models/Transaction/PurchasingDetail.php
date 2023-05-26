<?php

namespace App\Models\Transaction;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product\Product;
use App\Models\Transaction\Purchasing;

class PurchasingDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'purchasing_detail';
    protected $guarded = ['id'];

    public function purchase()
    {
        return $this->belongsTo(Purchasing::class, 'purchasing_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
