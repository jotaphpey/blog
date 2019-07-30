<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Http\Controllers\Api\AuthorController;
use App\Services\AuthorService;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => "admin",
            'email' => "admin@mail.com",
            'password' => bcrypt('admin1234'),
            'user_type' => "admin"
        ]);

        $this->storeInService($admin);

        $user = User::create([
            'name' => "user",
            'email' => "user@mail.com",
            'password' => bcrypt('user1234'),
            'user_type' => "user"
        ]);

        $this->storeInService($user);
    }

    public function storeInService($user){
        $authorService = new AuthorService();
        $authorController = new AuthorController($authorService);
        $author = ["username" => $user->name];

        $authorStored = $authorController->store($author);

        if($authorStored){
            $user->author_id = $authorStored->data->id;
            $user->save();
            return $user;
        }
    }
}
