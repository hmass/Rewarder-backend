<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Voucher extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,

            'customer_id' => $this->customer_id,

            'name' => $this->name,

            'order_value' => $this->order_value,

            'voucher_value' => $this->voucher? $this->voucher->voucher_value : 0,

            'redeemed' => $this->voucher ? $this->Voucher->redeemed : 'n/a',

            'created_at' => $this->created_at->format('d-m-Y H:i:s'),

            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),

        ];
        // return [

        //     'id' => $this->id,

        //     'customer_id' => $this->Customer->customer_id,

        //     'name' => $this->Customer->name,

        //     'order_value' => $this->Customer->order_value,

        //     'voucher_value' => $this->voucher_value,

        //     'redeemed' => $this->redeemed,

        //     'created_at' => $this->created_at->format('d-m-Y H:i:s'),

        //     'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),

        // ];
    }
}
