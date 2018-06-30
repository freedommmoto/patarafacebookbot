<?php
use App\Http\Controllers\BotManController;
use Illuminate\Support\Facades\Log;

$botman = resolve('botmanfacebook');

$botman->hears('Hi', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('Hello! '.config('page_user_id'));
});

$botman->hears('1', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('2');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
$botman->hears('info', BotManController::class.'@GenericTemplate');