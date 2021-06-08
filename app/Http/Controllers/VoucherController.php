<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerCollection;
use App\Http\Resources\Voucher as ResourcesVoucher;
use App\Http\Resources\VoucherCollection;
use App\Models\Customer;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(DB::table('vouchers')->count() != 0){
            $vouchers = Customer::with('voucher')->paginate(15);
            return ResourcesVoucher::collection($vouchers);
        }
        
       
    }



    // method to generate vouchers from customer base
    public function generateVoucher()

    {

        try {

            $customers = Customer::all();

            //loop through each customer creating a voucher for each
            foreach ($customers as $c) {

                if ($c->voucher) {
                    
                } else {
                    if ($c->order_value < 1000) {
                    }
    
                    if ($c->order_value >= 1000 && $c->order_value <= 5000) {
                        $voucher = new Voucher();
                        $voucher->voucher_value = 100;
                        $voucher->validity = 1;
                        $voucher->redeemed = "No";
    
                        $voucher->customer_id = $c->id;
                        $voucher->save();
                    }
    
                    if ($c->order_value > 5000 && $c->order_value <= 10000) {
                        $voucher = new Voucher();
                        $voucher->voucher_value = 500;
                        $voucher->validity = 5;
                        $voucher->redeemed = "No";
    
                        $voucher->customer_id = $c->id;
                        $voucher->save();
                    }
                    if ($c->order_value > 10000) {
                        $voucher = new Voucher();
                        $voucher->voucher_value = 1000;
                        $voucher->validity = 10;
                        $voucher->redeemed = "No";
    
                        $voucher->customer_id = $c->id;
                        $voucher->save();
                    }
                }
                
            }
            $success['data'] =  null;
            return response(['message'=>'vouchers generated successfully'], 200);

        } catch (\Exception $ex) {
            return response(['message'=>$ex->getMessage()], 400);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
