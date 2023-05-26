<?php

namespace App\Models\Delivery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product\ProductCategory;

class Expedition extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'master_ekspedisi';
    protected $guarded = ['id'];

    // public function category()
    // {
    //     return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    // }
}
