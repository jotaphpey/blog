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
        $user = Auth::user();
        $avatar = "";
        if($user){
            $author = $AuthorController->show($user->author_id);
            if($author->data->image){
                $avatar = $author->data->image;
            }else{
                $img_path = public_path("images").DIRECTORY_SEPARATOR."default.png";
                $img_data = file_get_contents($img_path);
                $type = pathinfo($img_path, PATHINFO_EXTENSION);
                $base64 = base64_encode($img_data);
                $avatar = $base64;
            }

        }

        \View::share('avatar', $avatar);
    }
}
