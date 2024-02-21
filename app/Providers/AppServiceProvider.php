<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function(){
            // this block gives to the Newsletter interface a specific implementation
            $client = (new ApiClient)->setConfig([
              'apiKey' => config('services.mailchimp.key'),
              'server' => 'us21'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();// with this line I no longer need to add the protected $guarded method on the models

        Gate::define('admin', function(User $user){
            return $user->username == 'shiftlabny';
        });


        // This is a custom directive @admin. Make user()? optional in case user is not logged and return null
        /*
        Blade::if('admin', function(){
            return request()->user()?->can('admin');
        });
        */
    }
}
