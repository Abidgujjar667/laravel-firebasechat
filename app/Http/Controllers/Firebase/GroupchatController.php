<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class GroupchatController extends Controller
{

    //admin dashboard
    public function home(){
        return view('firebasechat.groupchat.grouphome');
    }


    //sms from admin
    public function sendSMS(Request $request)
    {
        $deviceTokens = [];
        $id=$request->id;
        $name=User::where('id',$id)->first()->name;
        $body='<h6 class="text-info">'.$name.'</h6>'.
                '<p>'.$request->body.'</p>';

        if ($request->ajax()){
            $users=User::get()->all();
            foreach ($users as $index=>$user){
                $deviceTokens[$index]=$user->device_token;
            }
            /*return response()->json([
                'type'=>'sucess',
                'data'=>$deviceTokens
            ]);*/

            return Larafirebase::withTitle($id)
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

    //return user name
    /*public function userName(Request $request){
        $id=$request->id;
        $user=User::where('id',$id)->first()->name;

        if ($user){
            return response()->json([
                'type'=>'sucess',
                'data'=>$user
            ],200);
        }else{
            return response()->json([
                'type'=>'error',
            ],201);
        }

    }*/
}
