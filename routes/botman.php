<?php
use App\Http\Controllers\BotManController;
use App\Models\Cards;

$botman = resolve('botmanfacebook');

/*
$botman->hears('Hi', function ($bot) {
    //Log::info('BotManController handle'.print_r(,true));
    $bot->reply('Welcome to codeboxx. How can i help you? ');
});
*/


$botman->hears('Hi', BotManController::class . '@GenericTemplate');
$botman->hears('Start conversation', BotManController::class . '@startConversation');
$botman->hears('info', BotManController::class . '@exampleGenericTemplate');

$botman->hears('test', function ($bot) {
    $bot->reply('ok');
});

$botman->hears('card', BotManController::class . '@GenericTemplate');

$botman->hears('payload_{id}', function ($bot, $id) {
    $cards = Cards::where('id', $id)->first();
    $bot->reply($cards->subtitle.', '.$cards->detailsPostback);
});
