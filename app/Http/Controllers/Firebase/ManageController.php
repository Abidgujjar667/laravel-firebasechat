<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\DataTables\UserDataTableEditor;


class ManageController extends Controller
{
    public function index(){
        return view('firebasechat.groupchat.manage');
    }

    //return all category
    public function fetch(){
        $pro=User::get()->all();
        return DataTables::of($pro)
            ->addIndexColumn()
            ->make(true);
    }

    //create users
    public function create(UserDataTableEditor $editor){
        return $editor->process(\request());
    }
}
