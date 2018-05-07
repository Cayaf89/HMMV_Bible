<?php

namespace App\Controller\Admin;

use App\Entity\Faction;
use App\Form\FactionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/faction")
 */
class AdminFactionController extends Controller
{
    /**
     * @Route("/", name="faction_index", methods="GET")
     */
    public function index(): Response
    {
        $factions = $this->getDoctrine()
            ->getRepository(Faction::class)
            ->findAll();

        return $this->render('faction/index.html.twig', ['factions' => $factions]);
    }

    /**
     * @Route("/new", name="faction_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $faction = new Faction();
        $form = $this->createForm(FactionType::class, $faction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faction);
            $em->flush();

            return $this->redirectToRoute('faction_index');
        }

        return $this->render('faction/new.html.twig', [
            'faction' => $faction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="faction_show", methods="GET")
     */
    public function show(Faction $faction): Response
    {
        return $this->render('faction/show.html.twig', ['faction' => $faction]);
    }

    /**
     * @Route("/{id}/edit", name="faction_edit", methods="GET|POST")
     */
    public function edit(Request $request, Faction $faction): Response
    {
        $form = $this->createForm(FactionType::class, $faction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faction_edit', ['id' => $faction->getId()]);
        }

        return $this->render('faction/edit.html.twig', [
            'faction' => $faction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="faction_delete", methods="DELETE")
     */
    public function delete(Request $request, Faction $faction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$faction->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faction);
            $em->flush();
        }

        return $this->redirectToRoute('faction_index');
    }
}
