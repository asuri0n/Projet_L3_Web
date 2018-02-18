<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 18/02/2018
 * Time: 15:07
 */

/* Inclusion des classes nécessaires */
require_once("view/View.php");
require_once("model/ImageStorage.php");

class Controller {

    protected $view;
    protected $poemdb;

    public function __construct(View $view, ImageStorage $poemdb) {
        $this->view = $view;
        $this->poemdb = $poemdb;
    }

    public function showPoem($id) {
        $poem = $this->poemdb->read($id);
        if ($poem !== null) {
            /* Le poème existe, on prépare la page */
            $this->view->makePoemPage($poem);
        } else {
            $this->view->makeUnknownPoemPage();
        }
    }
}

?>
