<?php

namespace App\Controller\Admin;

use App\Entity\Batiment;
use App\Form\BatimentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/batiment")
 */
class AdminBatimentController extends Controller
{
    /**
     * @Route("/", name="batiment_index", methods="GET")
     */
    public function index(): Response
    {
        $batiments = $this->getDoctrine()
            ->getRepository(Batiment::class)
            ->findAll();

        return $this->render('batiment/index.html.twig', ['batiments' => $batiments]);
    }

    /**
     * @Route("/new", name="batiment_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $batiment = new Batiment();
        $form = $this->createForm(BatimentType::class, $batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batiment);
            $em->flush();

            return $this->redirectToRoute('batiment_index');
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $batiment,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="batiment_show", methods="GET")
     */
    public function show(Batiment $batiment): Response
    {
        return $this->render('batiment/show.html.twig', ['batiment' => $batiment]);
    }

    /**
     * @Route("/{id}/edit", name="batiment_edit", methods="GET|POST")
     */
    public function edit(Request $request, Batiment $batiment): Response
    {
        $form = $this->createForm(BatimentType::class, $batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batiment_edit', ['id' => $batiment->getId()]);
        }

        return $this->render('batiment/edit.html.twig', [
            'batiment' => $batiment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="batiment_delete", methods="DELETE")
     */
    public function delete(Request $request, Batiment $batiment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$batiment->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($batiment);
            $em->flush();
        }

        return $this->redirectToRoute('batiment_index');
    }
}
