<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseChatController extends Controller
{
    //user dashboard
    public function index(){
        return view('firebasechat.fromuser.home');
    }

    //admin dashboard
    public function home(){
        return view('firebasechat.fromadmin.index');
    }

    //sms from admin
    public function sendSMS(Request $request)
    {
        $deviceTokens = [];
        $title=$request->title;
        $body=$request->body;

        if ($request->ajax()){
            $users=User::get()->all();
            foreach ($users as $index=>$user){
                $deviceTokens[$index]=$user->device_token;
            }
            /*return response()->json([
                'type'=>'sucess',
                'data'=>$deviceTokens
            ]);*/

            return Larafirebase::withTitle($title)
                ->withBody($body)
                ->sendMessage($deviceTokens);

            // Or
            //return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendMessage($deviceTokens);
        }

    }

    //update device token of login user
    public function updateToken(Request $request){
        $id=$request->id;
        $dtoken=$request->dtoken;
        $user=User::where('id',$id)->first();
        $user->device_token=$dtoken;
        $res=$user->update();
        if ($res){
            return response()->json([
                'type'=>'sucess',
            ],200);
        }else{
            return response()->json([
                'type'=>'error',
            ],201);
        }

    }
}
