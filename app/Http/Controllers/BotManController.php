<?php

namespace App\Http\Controllers;

//use BotMan\BotMan\BotMan;

use App\Providers\FacebookBotServiceProvider;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use Illuminate\Support\Facades\Log;

use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;

use BotMan\BotMan\Storages\Drivers\FileStorage;
use App\Models\Bots;
use App\Models\Cards;

use Storage;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle(Request $request)
    {
        //$botman = app('botman');
        $botman = app('botmanfacebook');
        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation($bot)
    {
        //Log::info('BotManController handle'.print_r($bot,true));
        $bot->startConversation(new ExampleConversation());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function sendWelcomeMessages($bot)
    {
        $botDetils = Bots::where('id', config('bot_id'))->first();
        if (!empty($botDetils->greeting_text)) {
            $bot->reply($botDetils->greeting_text);
        } else {
            $bot->reply('Welcome to codeboxx. How can i help you? ');
        }
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function exampleGenericTemplate($bot)
    {
        $bot->reply('Welcome to codeboxx. How can i help you? ');
        $bot->reply(GenericTemplate::create()
            ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
            ->addElements([
                Element::create('BotMan Documentation')
                    ->subtitle('All about BotMan')
                    ->image('https://www.allinspire.co.th/picture/Project/tumblr_picture-25-1527143885.png')
                    ->addButton(ElementButton::create('visit')->url('http://botman.io'))
                    ->addButton(ElementButton::create('tell me more')
                        ->payload('tellmemore')->type('postback')),
                Element::create('BotMan Laravel Starter')
                    ->subtitle('This is the best way to start with Laravel and BotMan')
                    ->image('https://www.allinspire.co.th/picture/Project/tumblr_picture-26-1527215761.png')
                    ->addButton(ElementButton::create('visit')
                        ->url('https://github.com/mpociot/botman-laravel-starter')
                    )
            ])
        );
    }

    /**
     * @param  BotMan $bot
     */
    public function genericTemplate($bot)
    {
        $cardsDetils = Cards::where('bot_id', config('bot_id'))->limit(env("MAX_CARDS"))->get();
        if (!empty($cardsDetils)) {
            //for test
            $cardsDetils = Cards::where('bot_id', 1)->limit(env("MAX_CARDS"))->get();
        }
        $this->sendWelcomeMessages($bot);
        //Log::info(print_r($cardsDetils,true));

        if (!empty($cardsDetils)) {
            $elementList = [];
            foreach ($cardsDetils as $key => $tmp) {
                $elementList[$key] =
                    Element::create($tmp['title'])
                        ->subtitle($tmp['subtitle'])
                        ->image($tmp['imageUrl'])
                        ->addButton(ElementButton::create('visit')->url($tmp['visitURL']))
                        ->addButton(ElementButton::create($tmp['detailsPostback'])->payload('payload_' . $tmp->id)->type('postback'));
            }

            $bot->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements($elementList)
            );
        }
    }

}
