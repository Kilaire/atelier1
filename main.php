<?php
session_start();
/* USE */

use galleryapp\model\User;
use galleryapp\model\Gallery;
use galleryapp\model\Image;
use galleryapp\control\GalleryController;
use galleryapp\auth\GalleryAuthentification;

/* AUTOLOADER ELOQUENT */

require_once('vendor/autoload.php');


/* AUTOLOADER */
require_once('src/mf/utils/AbstractClassLoader.php');
require_once('src/mf/utils/ClassLoader.php');

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

/* ACCES DB */
$config_ini = parse_ini_file("conf/config.ini");

/* INSTANCE DE CONNEXION  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($config_ini); /* configuration avec nos paramètres */
$db->setAsGlobal();              /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();             /* établir la connexion */

/* ROUTER */
$router = new \mf\router\Router();
$router->setDefaultRoute('home');
$router->addRoute('home', '', '\galleryapp\control\GalleryController', 'viewHome', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// AFFICHE LA GALLERIE
$router->addRoute('viewGallery', '/viewGallery/', '\galleryapp\control\GalleryController', 'viewGallery', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// AFFICHE LE FORMULAIRE POUR CREE UNE GALLERIE
$router->addRoute('viewNewGal', '/viewNewGal/', '\galleryapp\control\GalleryController', 'viewNewGal', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// ENVOIE LES DONNEES DU FORMULAIRE POUR LA CREATION D'UNE GALLERIE
$router->addRoute('sendNewGal', '/sendNewGal/', '\galleryapp\control\GalleryController', 'sendNewGal',  \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// AFFICHE le formulaire pour ajouter UNE IMAGE
$router->addRoute('viewNewImg', '/viewNewImg/', '\galleryapp\control\GalleryController', 'viewNewImg',  \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

$router->addRoute('sendNewImg', '/sendNewImg/', '\galleryapp\control\GalleryController', 'sendNewImg',  \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// AFFICHE LE FORMULAIRE POUR L'AUTHENTIFICATION (LOG OR CREATE ACCOUNT)
$router->addRoute('viewAuth', '/viewAuth/', '\galleryapp\control\GalleryController', 'viewAuth', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// ENVOIE LES DONNEES DU FORMULAIRE POUR SE CONNECTER
$router->addRoute('login', '/login/', '\galleryapp\control\GalleryAdminController', 'checkLogin', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// ENVOIE LES DONNEES DU FORMULAIRE POUR LA CREATION D'UN UTILISATEUR
$router->addRoute('addUser', '/check_signup/', '\galleryapp\control\GalleryAdminController', 'checkSignup', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// DECONNEXION DE L'UTILISATEUR
$router->addRoute('logout', '/logout/', '\galleryapp\control\GalleryAdminController', 'logout', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// affiche une image
$router->addRoute('viewImg', '/Img/', '\galleryapp\control\GalleryController', 'viewImg', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_NONE);

// afficher les galleries de la personne connectée
$router->addRoute('viewMyGal', '/myGal/', '\galleryapp\control\GalleryController', 'viewMyGallery', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// afficher le formulaire qui permet d'autoriser des users de voir la galerie
$router->addRoute('viewNewCons', '/viewNewCons/', '\galleryapp\control\GalleryController', 'viewNewCons', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// envoie les données du formulaire vers la table consult
$router->addRoute('sendNewCons', '/sendNewCons/', '\galleryapp\control\GalleryController', 'sendNewCons', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// Affiche le formulaire pour modifier une image
$router->addRoute('viewModifImg', '/viewModifImg/', '\galleryapp\control\GalleryController', 'viewModifImg', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

// envoie dans la bdd les modifications sur l'image
$router->addRoute('sendModifImg', '/sendModifImg/', '\galleryapp\control\GalleryController', 'sendModifImg', \galleryapp\auth\GalleryAuthentification::ACCESS_LEVEL_USER);

/* STYLE */
galleryapp\view\GalleryView::addStyleSheet('html/css/style.css');

$router->run();
