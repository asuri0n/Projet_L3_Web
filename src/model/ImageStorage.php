<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 18/02/2018
 * Time: 15:20
 */

/* Interface représentant un système de stockage des poèmes. */
interface ImageStorage {
    /* Renvoie l'instance de Poem correspondant à l'identifiant donné,
     * ou null s'il n'y en a pas. */
    public function read($id);

    /* Renvoie un tableau associatif id=>poème avec tous les poèmes de la base. */
    public function readAll();
}
