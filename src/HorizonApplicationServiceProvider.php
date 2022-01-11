<?php

namespace Laravel\Horizon;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class HorizonApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->authorization();
    }

    /**
     * Configure the Horizon authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        Horizon::auth(function ($request) {
            $uid = $request->session()->get('uid');
            return app()->environment('local') ||
                in_array($uid, explode(',', getenv('QUEUE_ADMIN_USERS'))) ||
                Gate::check('viewHorizon', [$request->user()]);
        });
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewHorizon', function ($user) {
            return in_array($user->id, explode(',', getenv('QUEUE_ADMIN_USERS')));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
