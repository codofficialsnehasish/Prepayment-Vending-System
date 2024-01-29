<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Price_managements;
 
class Price_management extends Controller
{
    public function price_manage(){
        $price_data = Price_managements::all();
        $data['title'] = "Price Management";
        $data['alldata'] = $price_data;
        return view("admin/price_management/content")->with($data);
    }
    public function add_price_data(Request $r){
        if(!empty($r->idedit)){
            $price_data = Price_managements::find($r->idedit);
        }else{
            $price_data = new Price_managements();
        }
        $price_data->price = $r->price;
        $price_data->currency = $r->currency;
        $price_data->tax = $r->tax;
        $price_data->save();
        return redirect(url('/price-management'));
    }
    public function price_management_data(Request $r){
        $price_data = Price_managements::find($r->id);
        return $price_data;
    }
    public function delete_price_manage(Request $r){
        $price_data = Price_managements::find($r->id);
        $price_data->delete();
        echo "Data Deleted";
    }
}