<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function send()
    {
        /*$nexmo = $this->app->make(\Nexmo\Client::class);*/
        $message=Nexmo::message()->send([
            'to'   => '03415424702',
            'from' => '03488330499',
            'text' => 'Laravel Sms Testing.'
        ]);
        $response = $message->getResponseData();

        return $response;
    }

    public function receive()
    {
    }
}
