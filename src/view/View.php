<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 18/02/2018
 * Time: 15:08
 */

require_once("Router.php");

class View {

	protected $router;
	protected $title;
	protected $content;

	public function __construct(Router $router) {
		$this->router = $router;
		$this->title = null;
		$this->content = null;
	}

	/* Affiche la page créée. */
	public function render() {
		if ($this->title === null || $this->content === null) {
			$this->makeUnexpectedErrorPage();
		}
		$title = $this->title;
		$content = $this->content;
		$menu = array(
			"Accueil" => $this->router->getHomeURL(),
			"Poème sympa" => $this->router->getPoemURL("01"),
			"Autre poème" => $this->router->getPoemURL("02"),
			"Un poème moins connu" => $this->router->getPoemURL("03"),
			"Un dernier" => $this->router->getPoemURL("04"),
		);
		include("template.php");
	}


	/******************************************************************************/
	/* Méthodes de génération des pages                                           */
	/******************************************************************************/

	public function makeHomePage() {
		$this->title = "Bienvenue !";
		$this->content = "Un site sur des poèmes.";
	}

	public function makePoemPage($poem) {
		$ptitle = $poem->getTitle();
		$author = $poem->getAuthor();
		$text = $poem->getText();
		$image = "images/{$poem->getImage()}";

		$this->title = "« {$ptitle} », par $author";
		$this->content .= "<figure>\n<img src=\"$image\" alt=\"$author\" />\n";
		$this->content .= "<figcaption>$author</figcaption>\n</figure>\n";
		$this->content .= "<div class=\"poem\">$text</div>\n";
	}

	public function makeUnknownPoemPage() {
		$this->title = "Erreur";
		$this->content = "Le poème demandé n'existe pas.";
	}

	public function makeUnexpectedErrorPage($e) {
		$this->title = "Erreur";
		$this->content = "Une erreur inattendue s'est produite. $e";
	}

}

?>
