<?php

namespace galleryapp\auth;

use galleryapp\model\User;

class GalleryAuthentification extends \mf\auth\Authentification
{
    public function __construct()
    {
        parent::__construct();
    }

    const ACCESS_LEVEL_VISITOR  = 0;
    const ACCESS_LEVEL_USER = 1;

    public function createUser($name,  $first_name, $mail, $pass, $username)
    {
        $user = User::select()->where('user_name', '=', $username)->first();

        if ((!isset($user->user_name)) || $user->user_name !== $username) {
            $addUser = new User();
            $addUser->name = $name;
            $addUser->first_name = $first_name;
            $addUser->mail = $mail;
            $addUser->password = password_hash($pass, PASSWORD_DEFAULT);
            $addUser->user_name = $username;
            $addUser->save();
        }
    }


    public function loginUser($username, $password)
    {
    }
}
