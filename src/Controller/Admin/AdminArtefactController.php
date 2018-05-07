<?php

namespace App\Controller\Admin;

use App\Entity\Artefact;
use App\Form\ArtefactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/artefact")
 */
class AdminArtefactController extends Controller
{
    /**
     * @Route("/", name="artefact_index", methods="GET")
     */
    public function index(): Response
    {
        $artefacts = $this->getDoctrine()
            ->getRepository(Artefact::class)
            ->findAll();

        return $this->render('artefact/index.html.twig', ['artefacts' => $artefacts]);
    }

    /**
     * @Route("/new", name="artefact_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $artefact = new Artefact();
        $form = $this->createForm(ArtefactType::class, $artefact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artefact);
            $em->flush();

            return $this->redirectToRoute('artefact_index');
        }

        return $this->render('artefact/new.html.twig', [
            'artefact' => $artefact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artefact_show", methods="GET")
     */
    public function show(Artefact $artefact): Response
    {
        return $this->render('artefact/show.html.twig', ['artefact' => $artefact]);
    }

    /**
     * @Route("/{id}/edit", name="artefact_edit", methods="GET|POST")
     */
    public function edit(Request $request, Artefact $artefact): Response
    {
        $form = $this->createForm(ArtefactType::class, $artefact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artefact_edit', ['id' => $artefact->getId()]);
        }

        return $this->render('artefact/edit.html.twig', [
            'artefact' => $artefact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artefact_delete", methods="DELETE")
     */
    public function delete(Request $request, Artefact $artefact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artefact->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artefact);
            $em->flush();
        }

        return $this->redirectToRoute('artefact_index');
    }
}
