<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
 
class Authentication extends Controller
{
    public function login(){
        $data['title'] = "Login";
        return view("admin/authentication/login")->with($data);
    }

    public function register_user(){
        $obj = new User();
        $obj->name = "Snehasish Bhurisrestha";
        $obj->email  = "admin@demo.com";
        $obj->password  = bcrypt("admin");
        $obj->save();
    }

    public function checkuser(Request $r){
        if(Auth::attempt(["email"=>$r->email,"password"=>$r->pass])){
            return redirect(url('/dashboard'));
        }else{
            return redirect(url('/login'))->with(["msg"=>"Invalid Login"]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url('/login'));
    }

    public function change_password(){
        $data['title'] = "Change Password";
        return view("admin/authentication/change_pass")->with($data);
    }

    public function change_pass(Request $r){
        $cp = $r->cp;
        $np = $r->np;
        $conpass = $r->conpass;
        if (Hash::check($cp, Auth::user()->password)) {
            if($np == $conpass){
                $obj = User::find(Auth::user()->id);
                $obj->password = bcrypt($np);
                $obj->update();
                Auth::logout();
                return redirect(url('/'));
            } else{
                return redirect(url('/changepass'))->with(["msg"=>"Not Matched Confirm Password"]);
            }
        } else {
            return redirect(url('/changepass'))->with(["msg"=>"Not Matched Current Password"]);
        }
    }
}
