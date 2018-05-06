<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Form\CreatureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/creature")
 */
class CreatureController extends Controller
{
    /**
     * @Route("/", name="creature_index", methods="GET")
     */
    public function index(): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creature::class)
            ->findAll();

        return $this->render('creature/index.html.twig', ['creatures' => $creatures]);
    }

    /**
     * @Route("/new", name="creature_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $creature = new Creature();
        $form = $this->createForm(CreatureType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($creature);
            $em->flush();

            return $this->redirectToRoute('creature_index');
        }

        return $this->render('creature/new.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="creature_show", methods="GET")
     */
    public function show(Creature $creature): Response
    {
        return $this->render('creature/show.html.twig', ['creature' => $creature]);
    }

    /**
     * @Route("/{id}/edit", name="creature_edit", methods="GET|POST")
     */
    public function edit(Request $request, Creature $creature): Response
    {
        $form = $this->createForm(CreatureType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('creature_edit', ['id' => $creature->getId()]);
        }

        return $this->render('creature/edit.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="creature_delete", methods="DELETE")
     */
    public function delete(Request $request, Creature $creature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creature->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($creature);
            $em->flush();
        }

        return $this->redirectToRoute('creature_index');
    }
}
