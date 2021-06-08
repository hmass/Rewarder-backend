<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
     /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'customer_id','validity', 'voucher_value','redeemed'

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
