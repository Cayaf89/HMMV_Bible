<?php

namespace App\Controller\Admin;

use App\Entity\Magie;
use App\Form\MagieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/magie")
 */
class AdminMagieController extends Controller
{
    /**
     * @Route("/", name="magie_index", methods="GET")
     */
    public function index(): Response
    {
        $magies = $this->getDoctrine()
            ->getRepository(Magie::class)
            ->findAll();

        return $this->render('magie/index.html.twig', ['magies' => $magies]);
    }

    /**
     * @Route("/new", name="magie_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $magie = new Magie();
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($magie);
            $em->flush();

            return $this->redirectToRoute('magie_index');
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $magie,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="magie_show", methods="GET")
     */
    public function show(Magie $magie): Response
    {
        return $this->render('magie/show.html.twig', ['magie' => $magie]);
    }

    /**
     * @Route("/{id}/edit", name="magie_edit", methods="GET|POST")
     */
    public function edit(Request $request, Magie $magie): Response
    {
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magie_edit', ['id' => $magie->getId()]);
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $magie,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="magie_delete", methods="DELETE")
     */
    public function delete(Request $request, Magie $magie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($magie);
            $em->flush();
        }

        return $this->redirectToRoute('magie_index');
    }
}
