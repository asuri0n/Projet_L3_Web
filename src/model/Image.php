<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 18/02/2018
 * Time: 15:09
 */

class Image
{
    protected $title;
    protected $image;
    protected $author;
    protected $text;

    public function __construct($title, $image, $author, $textFile) {
        $this->title = $title;
        $this->image = $image;
        $this->author = $author;
        $this->text = file_get_contents("texts/{$textFile}.html", true);
    }

    /* Renvoie le titre du poème */
    public function getTitle() {
        return $this->title;
    }

    /* Renvoie le nom du fichier contenant le portrait de l'auteur */
    public function getImage() {
        return $this->image;
    }

    /* Renvoie le nom de l'auteur */
    public function getAuthor() {
        return $this->author;
    }

    /* Renvoie le texte du poème, formaté en HTML */
    public function getText() {
        return $this->text;
    }
}