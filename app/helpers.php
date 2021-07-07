<?php

use App\Profile;
use App\User;
use App\Farmer;
use App\Inventory;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

if (!function_exists('subdomain_title')) {
    function subdomain_title($case)
    {
        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));

        switch($case){
            case 'ucfirst':
                $subdomain = ucfirst(config('app.name').' '.$subdomain);
                break;
            case 'ucwords':
                $subdomain = ucwords(config('app.name').' '.$subdomain);
                break;
            default:
                $subdomain = strtoupper(config('app.name').' '.$subdomain);
                break;
        }

        return $subdomain;
    }
}
if (!function_exists('subdomain_name')) {
    function subdomain_name()
    {
        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));

        return $subdomain;
    }
}
if (!function_exists('subDomainPath')) {
    function subDomainPath($path)
    {
        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));
        if(is_null(Auth::user())){

        }else{
            if(auth()->user()->hasRole('super-admin')){
                return 'admin.'.$path;
            }
        }

        return $subdomain.'.'.$path;
    }
}
if (!function_exists('farmerCount')) {
    function farmerCount($id)
    {
        $ids = Inventory::where('leader_id', $id)->distinct('farmer_id')->pluck('farmer_id')->toArray();
        $count = Farmer::whereIn('id', $ids)
            ->count();

//        $count = Farmer::where('master_id', $id)->count();

        return $count;
    }
}
if (!function_exists('productInvCount')) {
    function productInvCount($id)
    {
        if(auth()->user()->hasRole('super-admin')){
            $count = Inventory::where('product_id', $id)
                ->count();
        }else{
            $count = Inventory::where('product_id', $id)
                ->where('leader_id', Auth::user()->leader->id)
                ->count();
        }
        return $count;
    }
}

if (!function_exists('mobileMask')) {
    function mobileMask($string)
    {
        $string = substr_replace($string, '(', 0, 0);
        $string = substr_replace($string, ') ', 5, 0);
        $string = substr_replace($string, '-', 10, 0);

        return $string;
    }
}

if (!function_exists('contactMask')) {
    function contactMask($type, $data)
    {
        switch ($type){
            case 'mobile':
                $data = substr_replace($data, '(', 0, 0);
                $data = substr_replace($data, ') ', 5, 0);
                $data = substr_replace($data, '-', 10, 0);
                break;
        }

        return $data;
    }
}

if (!function_exists('stringSlug')) {
    function stringSlug($string)
    {
        $string = strtolower($string); // Replaces all spaces with hyphens.
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        return $string;
    }
}

if (!function_exists('getRoleName')) {
    function getRoleName($data)
    {
        $info = null;
        switch($data){
            case 'name':
                $info = Auth::user()->roles->pluck('name');
                break;
            case 'display_name':
                $info = Auth::user()->roles->pluck('display_name');
                break;
        }
        $info =  substr($info, 2);
        $info =  substr($info, 0, -2);
        return $info;
    }
}

if (!function_exists('getRoleNameByID')) {
    function getRoleNameByID($id, $type)
    {
        $data = User::find($id);
        $info = null;
        switch($type){
            case 'name':
                $info = $data->roles->pluck('name');
                break;
            case 'display_name':
                $info = $data->roles->pluck('display_name');
                break;
        }
        $info =  substr($info, 2);
        $info =  substr($info, 0, -2);
        return $info;
    }
}

if (!function_exists('permissionTable')) {
    function permissionTable($tableName)
    {
        $data = Permission::where('table_name', $tableName)->get();

        return $data;
    }
}

if (!function_exists('authProfilePic')) {
    function authProfilePic($id)
    {
        $data = '/img/blank-profile.jpg';

        $profile = Profile::where('user_id', $id)->first();

        if(!empty($profile)){
            if($profile->image !== null){
                $data = $profile->image;
            }
        }


        return $data;
    }
}


if (!function_exists('computeAmortization')) {
    function computeAmortization($amount, $terms, $interest, $decimal = 2)
    {
        $amor = ($amount/($interest/100)) / $terms;
        $amor = preg_replace('/,/', '',number_format($amor, 2));
        $amor = floatval($amor);
        return $amor;
    }
}

if (!function_exists('currency_format')) {
    function currency_format($amount, $decimal = 2)
    {
        return number_format($amount, $decimal);
    }
}


