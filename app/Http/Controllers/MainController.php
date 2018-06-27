<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    //
    function receive(Request $request)
    {
        $data = $request->all();
        if (isset($data["entry"])) {
            Log::info('all data entry ' . print_r($data["entry"], true));

            if (isset($data["entry"][0]["messaging"])) {
                //get the user’s id
                $id = $data["entry"][0]["messaging"][0]["sender"]["id"];
                $this->sendTextMessage($id, "Hello");
            }

        }
    }

    private function sendTextMessage($recipientId, $messageText)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => [
                "text" => $messageText
            ]
        ];

        $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN");
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

        Log::info(' url  ' . print_r($url, true));
        Log::info(' recipientId  ' . print_r($recipientId, true));
        Log::info(' curl_exec  ' . print_r($ch, true));
    }
}
