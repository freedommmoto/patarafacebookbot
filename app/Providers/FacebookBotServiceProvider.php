<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Container\LaravelContainer;
use BotMan\BotMan\Storages\Drivers\FileStorage;
use Illuminate\Support\Facades\Log;
use BotMan\BotMan\BotManFactory;

use App\Models\Bots;

class FacebookBotServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('botmanfacebook', function ($app) {
            $storage = new FileStorage(storage_path('botman'));

            // get all configs which stored in config/botman directory
            $default_config = config('botman', []);
            $request = app('request');
            $data = $request->all();
            $lastPart = basename(request()->path());
            Log::info('new data token = ' . $lastPart);

            if (isset($data["entry"])) {
                //log::info(print_r($data["entry"],true));

                if (isset($data["entry"])) {
                    $recipient = $data["entry"][0]['messaging'][0]['recipient']['id'];

                    //$botDetails = Bots::where('page_key_id', $recipient)->first();
                    $botDetails = Bots::where('internal_token', $lastPart)->first();

                    try {
                        $verify_token = '';
                        if ($botDetails['verify_token'] !== $verify_token) {
                            //case request is wrong verify_token
                        }

                        if ((!empty($recipient) && $botDetails->page_key_id < 1)) {
                            //save page_key_id
                            $botDetails->page_key_id = $recipient;
                            $botDetails->save();
                        }
                    } catch (\Exception $e) {
                        //
                    }


                    config(['page_id' => $recipient, 'bot_id' => $botDetails->id]);
                    // check $request to detect if you need to change default parameters
                    // == SET your new config
                    $default_config['facebook']['token'] = $botDetails->token;
                }
            }


            // return
            $botman = BotManFactory::create($default_config, new LaravelCache(), $app->make('request'),
                $storage);
            return $botman;
        });
    }


}
