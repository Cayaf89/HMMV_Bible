<?php

namespace App\Controller\Admin;

use App\Entity\Ressource;
use App\Form\RessourceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ressource")
 */
class AdminRessourceController extends Controller
{
    /**
     * @Route("/", name="ressource_index", methods="GET")
     */
    public function index(): Response
    {
        $ressources = $this->getDoctrine()
            ->getRepository(Ressource::class)
            ->findAll();

        return $this->render('ressource/index.html.twig', ['ressources' => $ressources]);
    }

    /**
     * @Route("/new", name="ressource_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();

            return $this->redirectToRoute('ressource_index');
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $ressource,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="ressource_show", methods="GET")
     */
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressource/show.html.twig', ['ressource' => $ressource]);
    }

    /**
     * @Route("/{id}/edit", name="ressource_edit", methods="GET|POST")
     */
    public function edit(Request $request, Ressource $ressource): Response
    {
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ressource_edit', ['id' => $ressource->getId()]);
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $ressource,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="ressource_delete", methods="DELETE")
     */
    public function delete(Request $request, Ressource $ressource): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ressource);
            $em->flush();
        }

        return $this->redirectToRoute('ressource_index');
    }
}
