<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\Meter;
use App\Models\Meter_master;
use App\Models\Customers;
use Excel;
use DB;

class Excelupload extends Controller
{
    function import_customer_excel(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);
        $path = ($request->file('select_file')->getPathName());
        $data = Excel::toArray([], $request->file('select_file'));
        if(count($data) > 0){
            $count = 0;
            foreach($data as $value){
                foreach($value as $row){
                    if($count++ <2){
                        continue;
                    }else{
                        if(Customers::where("phone",'=',$row[2])->count() > 0){
                            return redirect()->back()->with('error', 'Duplicate phone number, please check excel.');
                        }else{
                            $insert_data[] = array(
                                'name' => $row[0],
                                'address' => $row[1],
                                'phone' => $row[2],
                            );
                        }
                    }
                }
            }
            if(!empty($insert_data)){
                $res = DB::table('customer')->insert($insert_data);
            }
            if($res){
                return redirect()->back()->with('success', 'Excel Data Imported successfully.');
            }else{
                return redirect()->back()->with('error', 'Excel Data are not Imported.');
            }
        }else{
            return redirect()->back()->with('error', 'No Data Avaliable on Excel.');
        }
    }

    function import_meter_excel(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);
        $path = ($request->file('select_file')->getPathName());
        $data = Excel::toArray([], $request->file('select_file'));
        if(count($data) > 0){
            foreach($data as $value){
                foreach($value as $row){
                    if(is_numeric($row[0])){
                        $result_data = Meter_master::where("meter_type_name","=",$row[1])->get("id");
                        if($result_data != "[]"){
                            $insert_data[] = array(
                                    'meter_no' => $row[0],
                                    'meter_type' => $result_data[0]->id
                                );
                        }else{
                            $add_new = new Meter_master();
                            $add_new->meter_type_name = $row[1];
                            $add_new->save();
                            $insert_data[] = array(
                                'meter_no' => $row[0],
                                'meter_type' => $add_new->id
                            );
                        }
                    }
                }
            }
            if(!empty($insert_data)){
                $res = DB::table('meter')->insert($insert_data);
            }
            if($res){
                return redirect()->back()->with('success', 'Excel Data Imported successfully.');
            }else{
                return redirect()->back()->with('error', 'Excel Data are not Imported.');
            }
        }else{
            return redirect()->back()->with('error', 'No Data Avaliable on Excel.');
        }
    }


    function import_account_excel(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);
        $path = ($request->file('select_file')->getPathName());
        $data = Excel::toArray([], $request->file('select_file'));
        // print_r($data);
        // die;
        if(count($data) > 0){
            $count = 0;
            foreach($data as $value){
                foreach($value as $row){
                    if($count++ < 2){
                        continue;
                    }else{
                        if(!empty(Meter::where("meter_no",'=',$row[1])->get()[0]->id)){
                            $insert_data[] = array(
                                'customer_id' => $row[0],
                                'meter_id' => Meter::where("meter_no",'=',$row[1])->get()[0]->id,
                                'price_id' => $row[2],
                            );
                        }else{
                            return redirect()->back()->with(['error'=>'Meter not avaliable']);
                        }
                    }
                }
            }
            if(!empty($insert_data)){
                $res = DB::table('account')->insert($insert_data);
            }
            if($res){
                return redirect()->back()->with('success', 'Excel Data Imported successfully.');
            }else{
                return redirect()->back()->with('error', 'Excel Data are not Imported.');
            }
        }else{
            return redirect()->back()->with('error', 'No Data Avaliable on Excel.');
        }
    }
}
