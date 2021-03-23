<?php
use Illuminate\Support\Facades\Auth;
use App\Models\User;

if (!function_exists('username')){
    function username($id){
        $name=User::where('id',$id)->name;
        return $name;
    }
}