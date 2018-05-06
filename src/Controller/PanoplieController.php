<?php

namespace App\Controller;

use App\Entity\Panoplie;
use App\Form\PanoplieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/panoplie")
 */
class PanoplieController extends Controller
{
    /**
     * @Route("/", name="panoplie_index", methods="GET")
     */
    public function index(): Response
    {
        $panoplies = $this->getDoctrine()
            ->getRepository(Panoplie::class)
            ->findAll();

        return $this->render('panoplie/index.html.twig', ['panoplies' => $panoplies]);
    }

    /**
     * @Route("/new", name="panoplie_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $panoplie = new Panoplie();
        $form = $this->createForm(PanoplieType::class, $panoplie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panoplie);
            $em->flush();

            return $this->redirectToRoute('panoplie_index');
        }

        return $this->render('panoplie/new.html.twig', [
            'panoplie' => $panoplie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panoplie_show", methods="GET")
     */
    public function show(Panoplie $panoplie): Response
    {
        return $this->render('panoplie/show.html.twig', ['panoplie' => $panoplie]);
    }

    /**
     * @Route("/{id}/edit", name="panoplie_edit", methods="GET|POST")
     */
    public function edit(Request $request, Panoplie $panoplie): Response
    {
        $form = $this->createForm(PanoplieType::class, $panoplie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panoplie_edit', ['id' => $panoplie->getId()]);
        }

        return $this->render('panoplie/edit.html.twig', [
            'panoplie' => $panoplie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panoplie_delete", methods="DELETE")
     */
    public function delete(Request $request, Panoplie $panoplie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panoplie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panoplie);
            $em->flush();
        }

        return $this->redirectToRoute('panoplie_index');
    }
}
