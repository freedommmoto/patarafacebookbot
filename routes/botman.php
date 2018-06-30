<?php
use App\Http\Controllers\BotManController;
use Illuminate\Support\Facades\Log;

$botman = resolve('botmanfacebook');

/*
$botman->hears('Hi', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('Welcome to codeboxx. How can i help you? ');
});
*/

$botman->hears('1', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('2');
});




$botman->hears('Hi', BotManController::class.'@sendWelcomeMessages');
$botman->hears('Start conversation', BotManController::class.'@startConversation');
$botman->hears('info', BotManController::class.'@exampleGenericTemplate');