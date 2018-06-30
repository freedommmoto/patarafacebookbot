<?php
use App\Http\Controllers\BotManController;
$botman = resolve('botmanfacebook');

/*
$botman->hears('Hi', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('Welcome to codeboxx. How can i help you? ');
});
*/


$botman->hears('Hi', BotManController::class . '@sendWelcomeMessages');
$botman->hears('Start conversation', BotManController::class . '@startConversation');
$botman->hears('info', BotManController::class . '@exampleGenericTemplate');

$botman->hears('test', function ($bot) {
    $bot->reply('ok');
});

$botman->hears('card', BotManController::class . '@GenericTemplate');