<?php

namespace App\Filters;

use Illuminate\Http\Request;

class CustomerFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function name($term = '')
    {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    public function order_value($term = '')
    {
        return $this->builder->where('order_value', 'LIKE', "%$term%");
    }

    public function customer_id($term = '')
    {
        
        return $this->builder->where('customer_id', 'LIKE', "%$term%");
    }

    public function created_at($term = '')
    {
        
        return $this->builder->where('created_at', 'LIKE', "%$term%");
    }

    public function sort($type = null)
    {
        return $this->builder->orderBy('id', (!$type || $type == 'asc') ? 'desc' : 'asc');
    }


}