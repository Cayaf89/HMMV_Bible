<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use App\Form\CompetenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/competence")
 */
class AdminCompetenceController extends Controller
{
    /**
     * @Route("/", name="competence_index", methods="GET")
     */
    public function index(): Response
    {
        $competences = $this->getDoctrine()
            ->getRepository(Competence::class)
            ->findAll();

        return $this->render('competence/index.html.twig', ['competences' => $competences]);
    }

    /**
     * @Route("/new", name="competence_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($competence);
            $em->flush();

            return $this->redirectToRoute('competence_index');
        }

        return $this->render('competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competence_show", methods="GET")
     */
    public function show(Competence $competence): Response
    {
        return $this->render('competence/show.html.twig', ['competence' => $competence]);
    }

    /**
     * @Route("/{id}/edit", name="competence_edit", methods="GET|POST")
     */
    public function edit(Request $request, Competence $competence): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competence_edit', ['id' => $competence->getId()]);
        }

        return $this->render('competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competence_delete", methods="DELETE")
     */
    public function delete(Request $request, Competence $competence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($competence);
            $em->flush();
        }

        return $this->redirectToRoute('competence_index');
    }
}
