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
        $urlForHome = $rooter->urlFor('test', null);
        header("Location: $urlForHome", true, 302);
    }

    public function checkLogin()
    {
        $auth = new GalleryAuthentification();
        $auth->loginUser($this->request->post['user_name'], $this->request->post['password']);
        $rooter = new Router();
        $urlForHome = $rooter->urlFor('test', null);
        header("Location: $urlForHome", true, 302);
    }

    public function checkSignup()
    {
        $auth = new GalleryAuthentification();
        $vue = new GalleryView(null);

        if (isset($this->request->post['name'], $this->request->post['first_name'], $this->request->post['email'], $this->request->post['password'])) {
            $auth->createUser($this->request->post['name'], $this->request->post['first_name'], $this->request->post['email'], $this->request->post['password'], $this->request->post['user_name']);
            \mf\router\Router::executeRoute('home');
        } else {
            $vue->render('auth');
        }
    }
}
