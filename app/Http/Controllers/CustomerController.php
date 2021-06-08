<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customer as ResourcesCustomer;
use App\Http\Resources\CustomerCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate();
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
