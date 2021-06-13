<?php

namespace App\Http\Controllers;

// use App\Filters\CustomerFilters;

use App\Filters\CustomerFilters;
use App\Http\Resources\Customer as ResourcesCustomer;
// use App\Http\Resources\CustomerCollection;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomerController extends Controller
{

    public const PER_PAGE = 10;
    public const DEFAULT_SORT_FIELD = 'created_at';
    public const DEFAULT_SORT_ORDER = 'asc';
    protected $customer;

    protected array $sortFields = ['name', 'customer_id', 'order_value'];
    
    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    
    /**
     * Display a listing of the cutomer resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : AnonymousResourceCollection
    {
        $sortFieldInput = $request->input('sort_field', self::DEFAULT_SORT_FIELD);

        $sortField = in_array($sortFieldInput, $this->sortFields) ? $sortFieldInput : self::DEFAULT_SORT_FIELD;

        $sortOrder = $request->input('sort_order', self::DEFAULT_SORT_ORDER);

        $searchInput = $request->input('search');

        $query = $this->customer->orderBy($sortField, $sortOrder);
        
        $perPage = $request->input('per_page', self::PER_PAGE);

        if (!is_null($searchInput)) {
            $searchQuery = "%$searchInput%";
            $query = $query->where('customer_id', 'like', $searchQuery)->orWhere('name', 'like', $searchQuery)->orWhere('order_value', 'like', $searchQuery)->orWhere('created_at', 'like', $searchQuery);
            # code...
        }


        $customers = $query->paginate((int)$perPage);
        return ResourcesCustomer::collection($customers);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $input = $request->all();

            $validator = $request->validate([
    
                'name' => 'required',
                'customer_id' => 'required',
                'order_value' => 'required'
    
            ]);
    
            $customer = Customer::create($input);
            return response(['message'=>'Customer created successfully.', 'data'=> new ResourcesCustomer($customer)], 200);
       
        }catch(\Exception $ex){
            return response(['message'=>$ex->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try{
            $customer = Customer::find($id);
            return response(['message'=>'Success', 'data'=>new ResourcesCustomer($customer)], 200);

       
        }catch(\Exception $ex){
            return response(['message'=>$ex->getMessage()], 400);
        }

    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
