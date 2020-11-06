<?php

namespace galleryapp\view;

class GalleryView extends \mf\view\AbstractView
{

    public function __construct($data)
    {
        parent::__construct($data);
    }

    private function renderHeader()
    {
        return '<h1>Media Photo</h1>';
    }

    private function renderFooter()
    {
        return '<h1>Media Photo 2020</h1>';
    }

    private function renderHome()
    {
    }

    private function renderGallery()
    {
    }

    private function renderNewGal()
    {
        $result = <<<EOT
        <div class="form">
            <h1>Ajouter une galerie</h1>
            <form action="../sendNewGal/" method="post">
                <input type="text" name="name" placeholder="Nom de la galerie" required>
                <textarea name="desc" placeholder="Description de la galerie" required></textarea>
                <input class="keyword" type="text" name="keyword" placeholder="Mot clé" required>
                <input type="file" name="img">
                <select name="access">
                    <option value="0">Public</option>
                    <option value="1">Privé</option>
                </select>
                <button class="submit-btn" type="submit" name="submitBtn">Ajouter</button>
            </form>
        </div>
EOT;
        return $result;
    }

    private function renderNewImg()
    {
    }

    private function renderAuth()
    {
        $result = <<<EOT
        <div class="forms">

            <div class="log-in">
                <h1>Se connecter</h1>
                <form action="" method="post">
                    <input type="text" id="user_name1" name="user_name" placeholder="Nom d'utilisateur" required>
                    <input type="password" id="password1" name="password" placeholder="Mot de passe" required>
                    <button class="submit-btn" type="submit">Connexion</button>
                </form>
            </div>

            <div class="bar"></div>

            <div class="sign-in">
                <h1>S'inscrire</h1>
                <form action="../sendNewUser/" method="post">
                    <input type="text" name="first_name" placeholder="Prénom" required>
                    <input type="text" name="name" placeholder="Nom" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="user_name" placeholder="Nom d'utilisateur" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <button class="submit-btn" type="submit">Inscription</button>
                </form>
            </div>

        </div>
EOT;
        return $result;
    }

    protected function renderBody($selector)
    {

        $header = $this->renderHeader();
        $footer = $this->renderFooter();

        $section = '';

        switch ($selector) {
            case 'home':
                $section = $this->renderHome();
                break;
            case 'gallery':
                $section = $this->renderGallery();
                break;
            case 'newGal':
                $section = $this->renderNewGal();
                break;
            case 'newImg':
                $section = $this->renderNewImg();
                break;
            case 'auth':
                $section = $this->renderAuth();
                break;
        }

        $body = <<<EOT
        <header> ${header} </header>
            ${section}
        <footer> ${footer} </footer>
EOT;

        return $body;
    }
}
