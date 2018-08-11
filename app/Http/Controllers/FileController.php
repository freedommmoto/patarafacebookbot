<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    /**
     * Loaded through routes/botman.php
     * @param  BotMan $request
     */
    public function testUploadToAWS(Request $request)
    {
        $s3 = Storage::disk('s3');
        $folder = 'facebook-bot-project/';
        $imageFileName = 'firstpic';
        $filePath = $folder . $imageFileName;
        if($s3->put($filePath, 'test text'.rand(1,9999), 'public')){
            $url = Storage::disk('s3')->url($filePath);
            $data = file_get_contents($url);
            dd($data);
        }
    }

}
