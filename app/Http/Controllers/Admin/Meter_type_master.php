<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Meter_master;

class Meter_type_master extends Controller
{
    public function meter_master(){
        $meter_master = Meter_master::all();
        $data['title'] = "Meter Type Master";
        $data['alldata'] = $meter_master;
        return view("admin/meter_type_master/content")->with($data);
    }
    public function add_meter_master(Request $r){
        if(!empty($r->idedit)){
            $meter = Meter_master::find($r->idedit);
        }else{
            $meter = new Meter_master();
        }
        $meter->meter_type_name = $r->meter_type_name;
        $meter->save();
        return redirect(url('/meter-type-master'));
    }
    public function meter_master_data(Request $r){
        $meter = Meter_master::find($r->id);
        return $meter;
    }
    public function delete_meter_master(Request $r){
        $meter = Meter_master::find($r->id);
        $meter->delete();
        echo "Data Deleted";
    }
}
