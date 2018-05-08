<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Artefact;
use App\Entity\Batiment;
use App\Entity\Capacite;
use App\Entity\Competence;
use App\Entity\Creature;
use App\Entity\Faction;
use App\Entity\Hero;
use App\Entity\MachineDeGuerre;
use App\Entity\Magie;
use App\Entity\Panoplie;
use App\Entity\Peloton;
use App\Entity\Ressource;
use App\Entity\Semaine;
use App\Entity\Sort;
use App\Entity\Specialisation;
use App\Entity\Terrain;
use App\Entity\Ville;

/**
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $quickLinks = array(
            array(
                'label' => "Artéfacts",
                'slug'  => "artefact",
                'nb'    => count($this->getDoctrine()->getRepository(Artefact::class)->findAll()),
            ),
            array(
                'label' => "Batîments",
                'slug'  => "batiment",
                'nb'    => count($this->getDoctrine()->getRepository(Batiment::class)->findAll()),
            ),
            array(
                'label' => "Capacités",
                'slug'  => "capacite",
                'nb'    => count($this->getDoctrine()->getRepository(Capacite::class)->findAll()),
            ),
            array(
                'label' => "Compétences",
                'slug'  => "competence",
                'nb'    => count($this->getDoctrine()->getRepository(Competence::class)->findAll()),
            ),
            array(
                'label' => "Créatures",
                'slug'  => "creature",
                'nb'    => count($this->getDoctrine()->getRepository(Creature::class)->findAll()),
            ),
            array(
                'label' => "Factions",
                'slug'  => "faction",
                'nb'    => count($this->getDoctrine()->getRepository(Faction::class)->findAll()),
            ),
            array(
                'label' => "Héros",
                'slug'  => "hero",
                'nb'    => count($this->getDoctrine()->getRepository(Hero::class)->findAll()),
            ),
            array(
                'label' => "Machines",
                'slug'  => "machine_de_guerre",
                'nb'    => count($this->getDoctrine()->getRepository(MachineDeGuerre::class)->findAll()),
            ),
            array(
                'label' => "Magies",
                'slug'  => "magie",
                'nb'    => count($this->getDoctrine()->getRepository(Magie::class)->findAll()),
            ),
            array(
                'label' => "Panoplies",
                'slug'  => "panoplie",
                'nb'    => count($this->getDoctrine()->getRepository(Panoplie::class)->findAll()),
            ),
            array(
                'label' => "Pelotons",
                'slug'  => "peloton",
                'nb'    => count($this->getDoctrine()->getRepository(Peloton::class)->findAll()),
            ),
            array(
                'label' => "Ressources",
                'slug'  => "ressource",
                'nb'    => count($this->getDoctrine()->getRepository(Ressource::class)->findAll()),
            ),
            array(
                'label' => "Semaines",
                'slug'  => "semaine",
                'nb'    => count($this->getDoctrine()->getRepository(Semaine::class)->findAll()),
            ),
            array(
                'label' => "Sorts",
                'slug'  => "sort",
                'nb'    => count($this->getDoctrine()->getRepository(Sort::class)->findAll()),
            ),
            array(
                'label' => "Spécialisations",
                'slug'  => "specialisation",
                'nb'    => count($this->getDoctrine()->getRepository(Specialisation::class)->findAll()),
            ),
            array(
                'label' => "Terrains",
                'slug'  => "terrain",
                'nb'    => count($this->getDoctrine()->getRepository(Terrain::class)->findAll()),
            ),
            array(
                'label' => "Villes",
                'slug'  => "ville",
                'nb'    => count($this->getDoctrine()->getRepository(Ville::class)->findAll()),
            ),
        );
        return $this->render('dashboard/dashboard.html.twig', array(
            "quickLinks" => $quickLinks
        ));
    }
    
    /**
     * @Route("/get_nav_link", name="get_nav_link")
     */
    public function getNavLink()
    {
        $navLinks = array(
            array(
                'label' => "Artéfacts",
                'slug'  => "artefact",
                'nb'    => count($this->getDoctrine()->getRepository(Artefact::class)->findAll()),
            ),
            array(
                'label' => "Batîments",
                'slug'  => "batiment",
                'nb'    => count($this->getDoctrine()->getRepository(Batiment::class)->findAll()),
            ),
            array(
                'label' => "Capacités",
                'slug'  => "capacite",
                'nb'    => count($this->getDoctrine()->getRepository(Capacite::class)->findAll()),
            ),
            array(
                'label' => "Compétences",
                'slug'  => "competence",
                'nb'    => count($this->getDoctrine()->getRepository(Competence::class)->findAll()),
            ),
            array(
                'label' => "Créatures",
                'slug'  => "creature",
                'nb'    => count($this->getDoctrine()->getRepository(Creature::class)->findAll()),
            ),
            array(
                'label' => "Factions",
                'slug'  => "faction",
                'nb'    => count($this->getDoctrine()->getRepository(Faction::class)->findAll()),
            ),
            array(
                'label' => "Héros",
                'slug'  => "hero",
                'nb'    => count($this->getDoctrine()->getRepository(Hero::class)->findAll()),
            ),
            array(
                'label' => "Machines",
                'slug'  => "machine_de_guerre",
                'nb'    => count($this->getDoctrine()->getRepository(MachineDeGuerre::class)->findAll()),
            ),
            array(
                'label' => "Magies",
                'slug'  => "magie",
                'fa'    => "book",
                'nb'    => count($this->getDoctrine()->getRepository(Magie::class)->findAll()),
            ),
            array(
                'label' => "Panoplies",
                'slug'  => "panoplie",
                'nb'    => count($this->getDoctrine()->getRepository(Panoplie::class)->findAll()),
            ),
            array(
                'label' => "Pelotons",
                'slug'  => "peloton",
                'nb'    => count($this->getDoctrine()->getRepository(Peloton::class)->findAll()),
            ),
            array(
                'label' => "Ressources",
                'slug'  => "ressource",
                'nb'    => count($this->getDoctrine()->getRepository(Ressource::class)->findAll()),
            ),
            array(
                'label' => "Semaines",
                'slug'  => "semaine",
                'nb'    => count($this->getDoctrine()->getRepository(Semaine::class)->findAll()),
            ),
            array(
                'label' => "Sorts",
                'slug'  => "sort",
                'nb'    => count($this->getDoctrine()->getRepository(Sort::class)->findAll()),
            ),
            array(
                'label' => "Spécialisations",
                'slug'  => "specialisation",
                'nb'    => count($this->getDoctrine()->getRepository(Specialisation::class)->findAll()),
            ),
            array(
                'label' => "Terrains",
                'slug'  => "terrain",
                'nb'    => count($this->getDoctrine()->getRepository(Terrain::class)->findAll()),
            ),
            array(
                'label' => "Villes",
                'slug'  => "ville",
                'nb'    => count($this->getDoctrine()->getRepository(Ville::class)->findAll()),
            ),
        );
        return $this->render('dashboard/navLink.html.twig', array(
            "navLinks" => $navLinks
        ));
    }
    
    /**
     * @Route("/get_menu_link", name="get_menu_link")
     */
    public function getMenuLink()
    {
        $menuLinks = array(
            array(
                'label' => "Artéfacts",
                'slug'  => "artefact",
                'nb'    => count($this->getDoctrine()->getRepository(Artefact::class)->findAll()),
            ),
            array(
                'label' => "Batîments",
                'slug'  => "batiment",
                'nb'    => count($this->getDoctrine()->getRepository(Batiment::class)->findAll()),
            ),
            array(
                'label' => "Capacités",
                'slug'  => "capacite",
                'nb'    => count($this->getDoctrine()->getRepository(Capacite::class)->findAll()),
            ),
            array(
                'label' => "Compétences",
                'slug'  => "competence",
                'nb'    => count($this->getDoctrine()->getRepository(Competence::class)->findAll()),
            ),
            array(
                'label' => "Créatures",
                'slug'  => "creature",
                'nb'    => count($this->getDoctrine()->getRepository(Creature::class)->findAll()),
            ),
            array(
                'label' => "Factions",
                'slug'  => "faction",
                'nb'    => count($this->getDoctrine()->getRepository(Faction::class)->findAll()),
            ),
            array(
                'label' => "Héros",
                'slug'  => "hero",
                'nb'    => count($this->getDoctrine()->getRepository(Hero::class)->findAll()),
            ),
            array(
                'label' => "Machines",
                'slug'  => "machine_de_guerre",
                'nb'    => count($this->getDoctrine()->getRepository(MachineDeGuerre::class)->findAll()),
            ),
            array(
                'label' => "Magies",
                'slug'  => "magie",
                'fa'    => "book",
                'nb'    => count($this->getDoctrine()->getRepository(Magie::class)->findAll()),
            ),
            array(
                'label' => "Panoplies",
                'slug'  => "panoplie",
                'nb'    => count($this->getDoctrine()->getRepository(Panoplie::class)->findAll()),
            ),
            array(
                'label' => "Pelotons",
                'slug'  => "peloton",
                'nb'    => count($this->getDoctrine()->getRepository(Peloton::class)->findAll()),
            ),
            array(
                'label' => "Ressources",
                'slug'  => "ressource",
                'nb'    => count($this->getDoctrine()->getRepository(Ressource::class)->findAll()),
            ),
            array(
                'label' => "Semaines",
                'slug'  => "semaine",
                'nb'    => count($this->getDoctrine()->getRepository(Semaine::class)->findAll()),
            ),
            array(
                'label' => "Sorts",
                'slug'  => "sort",
                'nb'    => count($this->getDoctrine()->getRepository(Sort::class)->findAll()),
            ),
            array(
                'label' => "Spécialisations",
                'slug'  => "specialisation",
                'nb'    => count($this->getDoctrine()->getRepository(Specialisation::class)->findAll()),
            ),
            array(
                'label' => "Terrains",
                'slug'  => "terrain",
                'nb'    => count($this->getDoctrine()->getRepository(Terrain::class)->findAll()),
            ),
            array(
                'label' => "Villes",
                'slug'  => "ville",
                'nb'    => count($this->getDoctrine()->getRepository(Ville::class)->findAll()),
            ),
        );
        return $this->render('dashboard/menuLink.html.twig', array(
            "menuLinks" => $menuLinks
        ));
    }
}
