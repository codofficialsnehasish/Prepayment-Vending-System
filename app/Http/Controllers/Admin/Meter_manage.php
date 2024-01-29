<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Meter;
use App\Models\Meter_master;
 
class Meter_manage extends Controller
{
    public function meter(){
        $meter = Meter::leftJoin("meter_master","meter.meter_type","meter_master.id")
                ->get(["meter.*","meter_master.meter_type_name"]);
        $metermaster = Meter_master::all();
        $data['title'] = "Meter Manage";
        $data['alldata'] = $meter;
        $data['meter_master'] = $metermaster;
        return view("admin/meter_manage/content")->with($data);
    }
    public function add_meter(Request $r){
        if(!empty($r->idedit)){
            $meter = Meter::find($r->idedit);
        }else{
            $meter = new Meter();
        }
        $meter->meter_no = $r->meter_no;
        $meter->meter_type = $r->meter_type;
        $meter->save();
        return redirect(url('/meter-manage'));
    }
    public function meter_data(Request $r){
        $meter = Meter::find($r->id);
        return $meter;
    }
    public function delete_meter(Request $r){
        $meter = Meter::find($r->id);
        $meter->delete();
        echo "Data Deleted";
    }
}