<?php
namespace App\Entity;

class PropertySearch{



    /**
     * @var int|null
     */
    private $couleur;

    /**
     * Get the value of couleur
     *
     * @return  int|null
     */ 
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set the value of couleur
     *
     * @param  int|null  $couleur
     *
     * @return  self
     */ 
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }
}