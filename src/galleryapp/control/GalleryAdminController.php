<?php

namespace galleryapp\control;

use galleryapp\auth\GalleryAuthentification;
use galleryapp\view\GalleryView;
use mf\router\Router;

class GalleryAdminController extends \mf\control\AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $vue = new GalleryView(null);
        $vue->render('auth');
    }

    public function logout()
    {
        $auth = new \mf\auth\Authentification;
        $auth->logout();
        $rooter = new Router();

        $urlForHome = $rooter->urlFor('home', null);
        header("Location: $urlForHome", true, 302); // redirige l'utilisateur sur le home lors de la déconnexion
    }

    public function checkLogin()
    {
        $auth = new GalleryAuthentification();
        $auth->loginUser($this->request->post['user_name'], $this->request->post['password']);
    }

    public function checkSignup()
    {
        $auth = new GalleryAuthentification();
        $rooter = new Router();
        $urlForHome =  $rooter->urlFor('home', null);

        if (isset($this->request->post['name'], $this->request->post['first_name'], $this->request->post['email'], $this->request->post['password'])) {
            $auth->createUser($this->request->post['name'], $this->request->post['first_name'], $this->request->post['email'], $this->request->post['password'], $this->request->post['user_name']);
            header("Location: $urlForHome", true, 302); // redirige l'utilisateur sur le home lors de l'inscription
        }
    }
}
