<?php

namespace Mathewberry\Tokenizer;

use Illuminate\Support\ServiceProvider;

class TokenizerServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Mathewberry\Tokenizer\Commands\Token::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands( $this->commands );
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request)
        {
            $request_token = $request->header('api-token');

            if ( $request_token && $request_token == getenv('API_TOKEN') )
            {
                return $request;
            }
        });
    }
}
