<?php

namespace App\Http\ViewComposers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminComposer
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $routes = collect($this->router->getRoutes())->map(function ($route) {
            return ['uri' => $route->uri(), 'name' => $route->getName(),];
        })->toJson();

        $lang_files = File::files(resource_path() . '/lang/' . app()->getLocale());
        $trans = [];
        foreach ($lang_files as $f) {
            $filename = pathinfo($f)['filename'];
            $trans[$filename] = trans($filename);
        }

        if (Auth::check()) {
            $user = Auth::user();
            $auth = json_encode(collect([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]));
        } else {
            $auth = 'null;';
        }
        $appName = config('app.name');
        $app = "{name: '{$appName}'}";

        $token =  Auth::user()->createToken('api_token');


        $view->with('app', $app)
            ->with('token', $token->plainTextToken)
            ->with('routes', $routes)
            ->with('trans', json_encode($trans))
            ->with('auth', $auth);
    }
}
