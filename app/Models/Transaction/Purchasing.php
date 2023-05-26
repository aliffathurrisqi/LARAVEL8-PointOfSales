<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Transaction\PurchasingDetail;

class Purchasing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'purchasing';
    protected $guarded = ['id'];
    protected $casts = ['purchase_date'=>'datetime'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['from'] ?? false, function ($query, $from) {
            return $query->where('purchase_date', '>=', $from);
        });

        $query->when($filters['to'] ?? false, function ($query, $to) {
            return $query->where('purchase_date', '<=', $to);
        });
    }

    public function details()
    {
        return $this->hasMany(PurchasingDetail::class, 'purchasing_id', 'id');
    }

    public function details_products(){
        return PurchasingDetail::with(['products'])->where('deleted_at', NULL)->where('purchasing_id',$this->id)->get();
    }

    public function details_total(){
        $details = PurchasingDetail::with(['products'])->where('deleted_at', NULL)->where('purchasing_id',$this->id)->get();

        $i = 0;

        foreach($details as $item){
            $i += $item->price * $item->quantity;
        }

        return $i;
    }

}
