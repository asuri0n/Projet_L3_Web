<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 18/02/2018
 * Time: 15:08
 */

require_once("model/ImageStorage.php");
require_once("view/View.php");
require_once("control/Controller.php");

/*
 * Le routeur s'occupe d'analyser les requêtes HTTP
 * pour décider quoi faire et quoi afficher.
 * Il se contente de passer la main au contrôleur et
 * à la vue une fois qu'il a déterminé l'action à effectuer.
 */
class Router {

	private $poemdb;
	private $view;

	public function __construct(ImageStorage $poemdb) {
		$this->poemdb = $poemdb;
	}

	public function main() {

		/* vue de base */
		$this->view = new View($this);

		try {
			/* Analyse de l'URL */
			if (key_exists('poeme', $_GET)) {
				/* Un poème est demandé : on passe la main au contrôleur */
				$ctl = new Controller($this->view, $this->poemdb);
				$ctl->showPoem($_GET['poeme']);
			} else {
				/* Pas de poème demandé : on prépare la page d'accueil */
				$this->view->makeHomePage();
			}
		} catch (Exception $e) {
			/* Si on arrive ici, il s'est passé quelque chose d'imprévu
			* (par exemple un problème de base de données) */
			$this->view->makeUnexpectedErrorPage($e);
		}

		/* Enfin, on affiche la page préparée */
		$this->view->render();

	}

	/* URL de la page d'accueil */
	public function getHomeURL() {
		return ".";
	}

	/* URL de la page du poème d'identifiant $id */
	public function getPoemURL($id) {
		return "?poeme=$id";
	}

}

?>
