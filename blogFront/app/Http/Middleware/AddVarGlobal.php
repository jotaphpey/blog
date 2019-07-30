<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthorController;
use App\Services\AuthorService;

class AddVarGlobal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->getAvatar();
        return $next($request);
    }

    public function getAvatar(){
        $authorService = new AuthorService();
        $AuthorController = new AuthorController($authorService);
        $author = $AuthorController->show(Auth::user()->author_id);
        \View::share('avatar', $author->data->image);
    }
}
