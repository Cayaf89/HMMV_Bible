<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Magie
 *
 * @author Alexi
 */
class Magie {
    private $id;
    private $sorts;
    private $factionsPreference;
    private $nom;
    private $description;
    
    public function __construct() {
        $this->sorts              = new ArrayCollection();
        $this->factionsPreference = new ArrayCollection();
    }
}
