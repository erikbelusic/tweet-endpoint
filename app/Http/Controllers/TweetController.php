<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        if(env('ECHO_APP_ID') !==  $this->getApplicationID($request)) {
            return abort(403);
        }

        $tweet = Tweet::create(['content' => $this->getTweetContent($request)]);

        $response = [
            'version' => 1.0,
            'response' => [
                'outputSpeech' => [
                    'type' => 'PlainText',
                    'text' => "Your message was tweeted: $tweet->content"
                ],
                'card' => [
                    'type' => 'Simple',
                    'title' => '@AlexCummunity on twitter',
                    'content' => "Your message was tweeted: $tweet->content"
                ],
                'shouldEndSession' => true
            ]
        ];

        return response()->json($response);
    }






    protected function getApplicationID($request)
    {
        return $request->input('session')['application']['applicationId'];
    }

    protected function getTweetContent($request)
    {
        return $request->input('request')['intent']['slots']['Content']['value'];
    }
}
