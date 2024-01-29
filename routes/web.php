<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Authentication;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Admin\Meter_manage;
use App\Http\Controllers\Admin\Customer_manage;
use App\Http\Controllers\Admin\Excelupload;
use App\Http\Controllers\Admin\Meter_type_master;
use App\Http\Controllers\Admin\Price_management;

use App\Http\Controllers\Site\Home;


//======================= Site Routes =====================

Route::get("/",[Home::class,"gohome"]);






//====================== Admin Routes =======================




//======================= Login Routes =====================

Route::get("/login",[Authentication::class,"login"])->name("login");
Route::post("/checkuser",[Authentication::class,"checkuser"]);
Route::get("/logout",[Authentication::class,"logout"]);
Route::get("/register_user",[Authentication::class,"register_user"]);
Route::get("/changepass",[Authentication::class,"change_password"])->middleware("auth");
Route::post("/changep",[Authentication::class,"change_pass"]);

//============================ User Routes ==============================

Route::get("/register",[Admin::class,"register"])->middleware("admin");
Route::post("/adduser",[Admin::class,"adduser"]);
Route::get("/showuser",[Admin::class,"show_user"])->middleware("auth");
Route::get("/del_user/{id}",[Admin::class,"del_user"])->middleware("admin");
Route::get("/edit_user/{id}",[Admin::class,"edit_user"])->middleware("admin");
Route::post("/updateuser",[Admin::class,"update_user"]);


//======================= Dashboard Routes ======================

Route::get("/dashboard",[Dashboard::class,"godashboard"])->middleware("auth");


//======================= Settings Routes ======================

Route::get("/settings-contents",[Settings::class,"content"]);
Route::post("/add-content",[Settings::class,"add_content"]);


//======================= Meter Manage Routes ======================

Route::get("/meter-manage",[Meter_manage::class,"meter"]);
Route::post("/meter",[Meter_manage::class,"add_meter"]);
Route::get("/meter-data/{id}",[Meter_manage::class,"meter_data"]);
Route::get("/meter-manage/delete/{id}",[Meter_manage::class,"delete_meter"]);


//======================= Meter Type Master Routes ======================

Route::get("/meter-type-master",[Meter_type_master::class,"meter_master"]);
Route::post("/meter-type-data",[Meter_type_master::class,"add_meter_master"]);
Route::get("/meter-master-data/{id}",[Meter_type_master::class,"meter_master_data"]);
Route::get("/meter-type-master/delete/{id}",[Meter_type_master::class,"delete_meter_master"]);

Route::post("/import-meter",[Excelupload::class,"import_meter_excel"]);


//======================= Customer Manage Routes ======================

Route::get("/customer-manage",[Customer_manage::class,"customer_manage"]);
Route::post("/customer",[Customer_manage::class,"add_customer"]);
Route::get("/customar-data/{id}",[Customer_manage::class,"customer_data"]);
Route::get("/customer-manage/delete/{id}",[Customer_manage::class,"delete_customer"]);

Route::post("/import-customer",[Excelupload::class,"import_customer_excel"]);


//======================= Price Management Routes ======================

Route::get("/price-management",[Price_management::class,"price_manage"]);
Route::post("/price-data",[Price_management::class,"add_price_data"]);
Route::get("/price-manage-data/{id}",[Price_management::class,"price_management_data"]);
Route::get("/price-management/delete/{id}",[Price_management::class,"delete_price_manage"]);