<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseSmsController extends Controller
{
    public function index(){
        return view('firebase.firebaseSMS');
    }

    public function home(){
        return view('firebase.adminhome');
    }
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

    public function sendNotification()
    {
        $deviceTokens = [
            'dbQKqgDBMgyp2beqchScUm:APA91bEWSjfiTkLVbjBZVaeYeFAWtZOr60BJDYUlyyOx_INdNKDP7hUvPc3Cz8s89BwO1FS2QdkCzukKGAcD8eyDvOZb0Jet3788jooTjva6gJRVuqlKTYwKmf7PGA3HDkZNwNqIecnu',
            'dRDhnY9pwlekKoq7_Ni9RR:APA91bEuJh70grZQ5-3sDu81xdbgsJMAt4k479tH0zY7Eb63Ub9rfYFZNY0EbzWmtnpND33xBwmjUXPcfXz6ePWNnJTMTCBEBBU-gKs693UEpHpDgtCfBx3cVEaOfQ6IAynLUrHijxqE'
        ];

        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withClickAction('admin/notifications')
            ->withPriority('high')
            ->sendNotification($deviceTokens);

        // Or
        //return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($deviceTokens);
    }

    public function sendMessage()
    {
        $deviceTokens = [
            'dbQKqgDBMgyp2beqchScUm:APA91bEWSjfiTkLVbjBZVaeYeFAWtZOr60BJDYUlyyOx_INdNKDP7hUvPc3Cz8s89BwO1FS2QdkCzukKGAcD8eyDvOZb0Jet3788jooTjva6gJRVuqlKTYwKmf7PGA3HDkZNwNqIecnu',
            'dRDhnY9pwlekKoq7_Ni9RR:APA91bEuJh70grZQ5-3sDu81xdbgsJMAt4k479tH0zY7Eb63Ub9rfYFZNY0EbzWmtnpND33xBwmjUXPcfXz6ePWNnJTMTCBEBBU-gKs693UEpHpDgtCfBx3cVEaOfQ6IAynLUrHijxqE'
        ];

        return Larafirebase::withTitle('Test with Firebase')
            ->withBody('Test message body')
            ->sendMessage($deviceTokens);

        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendMessage($deviceTokens);
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
