<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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

            'created_at' => $this->created_at->format('d-m-Y H:i:s'),

            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),

        ];
    }
}
