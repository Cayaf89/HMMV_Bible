<?php

namespace App\Controller\Admin;

use App\Entity\Capacite;
use App\Form\CapaciteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/capacite")
 */
class AdminCapaciteController extends Controller
{
    /**
     * @Route("/", name="capacite_index", methods="GET")
     */
    public function index(): Response
    {
        $capacites = $this->getDoctrine()
            ->getRepository(Capacite::class)
            ->findAll();

        return $this->render('capacite/index.html.twig', ['capacites' => $capacites]);
    }

    /**
     * @Route("/new", name="capacite_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $capacite = new Capacite();
        $form = $this->createForm(CapaciteType::class, $capacite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($capacite);
            $em->flush();

            return $this->redirectToRoute('capacite_index');
        }

        return $this->render('capacite/new.html.twig', [
            'capacite' => $capacite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="capacite_show", methods="GET")
     */
    public function show(Capacite $capacite): Response
    {
        return $this->render('capacite/show.html.twig', ['capacite' => $capacite]);
    }

    /**
     * @Route("/{id}/edit", name="capacite_edit", methods="GET|POST")
     */
    public function edit(Request $request, Capacite $capacite): Response
    {
        $form = $this->createForm(CapaciteType::class, $capacite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('capacite_edit', ['id' => $capacite->getId()]);
        }

        return $this->render('capacite/edit.html.twig', [
            'capacite' => $capacite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="capacite_delete", methods="DELETE")
     */
    public function delete(Request $request, Capacite $capacite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$capacite->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($capacite);
            $em->flush();
        }

        return $this->redirectToRoute('capacite_index');
    }
}
