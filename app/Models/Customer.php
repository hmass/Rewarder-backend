<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;


class Customer extends Model
{
    use HasFactory;
    // use Filterable;
        /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'customer_id','name', 'order_value'

    ];


    public function voucher()
    {
        return $this->hasOne(Voucher::class);
    }
}
