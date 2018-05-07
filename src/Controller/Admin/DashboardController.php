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
                'fa'    => "quidditch",
                'nb'    => count($this->getDoctrine()->getRepository(Artefact::class)->findAll()),
            ),
            array(
                'label' => "Batîments",
                'slug'  => "batiment",
                'fa'    => "home",
                'nb'    => count($this->getDoctrine()->getRepository(Batiment::class)->findAll()),
            ),
            array(
                'label' => "Capacités",
                'slug'  => "capacite",
                'fa'    => "band-aid",
                'nb'    => count($this->getDoctrine()->getRepository(Capacite::class)->findAll()),
            ),
            array(
                'label' => "Compétences",
                'slug'  => "competence",
                'fa'    => "bookmark",
                'nb'    => count($this->getDoctrine()->getRepository(Competence::class)->findAll()),
            ),
            array(
                'label' => "Créatures",
                'slug'  => "creature",
                'fa'    => "bug",
                'nb'    => count($this->getDoctrine()->getRepository(Creature::class)->findAll()),
            ),
            array(
                'label' => "Factions",
                'slug'  => "faction",
                'fa'    => "address-book",
                'nb'    => count($this->getDoctrine()->getRepository(Faction::class)->findAll()),
            ),
            array(
                'label' => "Héros",
                'slug'  => "hero",
                'fa'    => "user-astronaut",
                'nb'    => count($this->getDoctrine()->getRepository(Hero::class)->findAll()),
            ),
            array(
                'label' => "Machines",
                'slug'  => "machine_de_guerre",
                'fa'    => "plus-square",
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
                'fa'    => "boxes",
                'nb'    => count($this->getDoctrine()->getRepository(Panoplie::class)->findAll()),
            ),
            array(
                'label' => "Pelotons",
                'slug'  => "peloton",
                'fa'    => "users",
                'nb'    => count($this->getDoctrine()->getRepository(Peloton::class)->findAll()),
            ),
            array(
                'label' => "Ressources",
                'slug'  => "ressource",
                'fa'    => "gem",
                'nb'    => count($this->getDoctrine()->getRepository(Ressource::class)->findAll()),
            ),
            array(
                'label' => "Semaines",
                'slug'  => "semaine",
                'fa'    => "calendar-alt",
                'nb'    => count($this->getDoctrine()->getRepository(Semaine::class)->findAll()),
            ),
            array(
                'label' => "Sorts",
                'slug'  => "sort",
                'fa'    => "star",
                'nb'    => count($this->getDoctrine()->getRepository(Sort::class)->findAll()),
            ),
            array(
                'label' => "Spécialisations",
                'slug'  => "specialisation",
                'fa'    => "tachometer-alt",
                'nb'    => count($this->getDoctrine()->getRepository(Specialisation::class)->findAll()),
            ),
            array(
                'label' => "Terrains",
                'slug'  => "terrain",
                'fa'    => "seedling",
                'nb'    => count($this->getDoctrine()->getRepository(Terrain::class)->findAll()),
            ),
            array(
                'label' => "Villes",
                'slug'  => "ville",
                'fa'    => "building",
                'nb'    => count($this->getDoctrine()->getRepository(Ville::class)->findAll()),
            ),
        );
        return $this->render('dashboard/dashboard.html.twig', array(
            "quickLinks" => $quickLinks
        ));
    }
}
