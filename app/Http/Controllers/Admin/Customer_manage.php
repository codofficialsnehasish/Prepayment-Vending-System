<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Customers;
 
class Customer_manage extends Controller
{
    public function customer_manage(){
        $customer = Customers::orderBy('name', 'asc')->get();
        $data['title'] = "Customer Manage";
        $data['alldata'] = $customer;
        return view("admin/customer_manage/content")->with($data);
    }
    public function add_customer(Request $r){
        if(!empty($r->idedit)){
            $customer = Customers::find($r->idedit);
        }else{
            $customer = new Customers();
        }
        $customer->name = $r->name;
        $customer->address = $r->address;
        $customer->phone = $r->phone;
        $customer->save();
        return redirect(url('/customer-manage'));
    }
    public function customer_data(Request $r){
        $customer = Customers::find($r->id);
        return $customer;
    }
    public function delete_customer(Request $r){
        $customer = Customers::find($r->id);
        $customer->delete();
        echo "Data Deleted";
    }
}