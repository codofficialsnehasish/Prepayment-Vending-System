<?php
    if (!function_exists('get_logo')) {
        function get_logo(){
            $logo = DB::table('settings')->select('logo')->get()[0]->logo;
            return $logo;
        }
    }

    if (!function_exists('get_icon')) {
        function get_icon(){
            $icon = DB::table('settings')->select('fabicon')->get()[0]->fabicon;
            return $icon;
        }
    }

    if (!function_exists('app_name')) {
        function app_name(){
            $name = DB::table('settings')->select('application_name')->get()[0]->application_name;
            return $name;
        }
    }

    if (!function_exists('copyright')) {
        function copyright(){
            $name = DB::table('settings')->select('copyright')->get()[0]->copyright;
            return $name;
        }
    }

    if (!function_exists('description')) {
        function description(){
            $site_description = DB::table('settings')->select('site_description')->get()[0]->site_description;
            return $site_description;
        }
    }

    if (!function_exists('get_all_data_according_to_date')) {
        function get_all_data_according_to_date($date){
            $data = DB::table('results_data')->whereDate("date",$date)->get();
            return $data;
        }
    }