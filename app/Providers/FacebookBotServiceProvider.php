<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Container\LaravelContainer;
use BotMan\BotMan\Storages\Drivers\FileStorage;
use Illuminate\Support\Facades\Log;
use BotMan\BotMan\BotManFactory;

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

            if(isset($data["entry"])) {
                //Log::info('entry = ' . print_r($data["entry"], true));

                if (isset($data["entry"])) {
                    $recipient = $data["entry"][0]['messaging'][0]['recipient']['id'];

                    if ($recipient == '408850619523733') {
                        //code box page
                        $token = 'EAAClwcgxjC4BALYGkZBwp39KRvALgYkLSTVPMrVut484K87j6o5tJOBleaXwoVpjG6Y3gBPBwiciKiAAZC6PH3uYBeWoSSK8ViexhZARJxKtik9WIPwyc9aEUZBwggJ8eqtalB6y8iujt9ojnj2GYuT9cWZAcCr6jVYp1XdRZC1gZDZD';
                    }
                    if ($recipient == '286086431421655') {
                        //เงินเย็น
                        $token = 'EAAClwcgxjC4BAIvaJecXwBwyddQWtZB6WLNGAmlZCZBsFcIJHSL8ArzBd14NCKhyRfkntIQYIMAD1Bh517xZAfDnhglHKxusqtTgUmszbd4eByauVl6F5BoJPnoIHvXCOT9kVKw1TCMMlShjRnWytOb0NdzEMrZCuSKwNoGdmBQZDZD';
                    }
                    config(['page_user_id' => $recipient]);

                    // check $request to detect if you need to change default parameters
                    // == SET your new config
                    $default_config['facebook']['token'] = $token;
                }
            }


            // return
            $botman = BotManFactory::create($default_config, new LaravelCache(), $app->make('request'),
                $storage);
            return $botman;
        });
    }
}
