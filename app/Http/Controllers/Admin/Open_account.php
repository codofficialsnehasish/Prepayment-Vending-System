<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Meter;
use App\Models\Price_managements;
use App\Models\Accounts;

class Open_account extends Controller
{
    public function account_contents(){
        $customer = Customers::orderBy('name', 'asc')->get();
        $meter = Meter::leftJoin("meter_master","meter.meter_type","meter_master.id")
                ->get(["meter.*","meter_master.meter_type_name"]);
        $price_data = Price_managements::all();
        $alldata = Accounts::all();
        $alldata = Accounts::leftJoin("customer","account.customer_id","customer.id")
                ->leftJoin("meter","account.meter_id","meter.id")
                ->get(["customer.*","account.*","meter.*","account.id as accountid"]);
        $data['title'] = "Open An Account";
        $data['parent_title'] = "Daily Business";
        $data['customer'] = $customer;
        $data['meter'] = $meter;
        $data['price_data'] = $price_data;
        $data['alldata'] = $alldata;
        return view("admin/open_an_account/content")->with($data);
    }

    public function add_account_contents(Request $r){
        if(!empty($r->idedit)){
            $add_data = Accounts::find($r->idedit);
        }else{
            $add_data = new Accounts();
        }
        $add_data->customer_id = $r->customer_id;
        $add_data->meter_id = $r->meter_id;
        $add_data->price_id = $r->price_id;
        $add_data->save();
        return redirect()->back();
    }

    public function get_edit_data(Request $r){
        $account = Accounts::find($r->id);
        return $account;
    }

    public function delete_account_data(Request $r){
        $account = Accounts::find($r->id);
        $account->delete();
        echo "Data Deleted";
    }

}
