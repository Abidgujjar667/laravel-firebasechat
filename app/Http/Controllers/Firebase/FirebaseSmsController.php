<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseSmsController extends Controller
{
    public function index(){
        return view('firebase.firebaseSMS');
    }
    public function sendNotification()
    {
        $deviceTokens = [
            '{TOKEN_1}',
            '{TOKEN_2}'
        ];

        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withClickAction('admin/notifications')
            ->withPriority('high')
            ->sendNotification($deviceTokens);

        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($deviceTokens);
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
}
