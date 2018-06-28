<?php
use App\Http\Controllers\BotManController;
use Illuminate\Support\Facades\Log;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
