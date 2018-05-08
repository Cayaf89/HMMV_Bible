<?php

namespace App\Controller\Admin;

use App\Entity\Semaine;
use App\Form\SemaineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/semaine")
 */
class AdminSemaineController extends Controller
{
    /**
     * @Route("/", name="semaine_index", methods="GET")
     */
    public function index(): Response
    {
        $semaines = $this->getDoctrine()
            ->getRepository(Semaine::class)
            ->findAll();

        return $this->render('semaine/index.html.twig', ['semaines' => $semaines]);
    }

    /**
     * @Route("/new", name="semaine_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $semaine = new Semaine();
        $form = $this->createForm(SemaineType::class, $semaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($semaine);
            $em->flush();

            return $this->redirectToRoute('semaine_index');
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $semaine,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="semaine_show", methods="GET")
     */
    public function show(Semaine $semaine): Response
    {
        return $this->render('semaine/show.html.twig', ['semaine' => $semaine]);
    }

    /**
     * @Route("/{id}/edit", name="semaine_edit", methods="GET|POST")
     */
    public function edit(Request $request, Semaine $semaine): Response
    {
        $form = $this->createForm(SemaineType::class, $semaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('semaine_edit', ['id' => $semaine->getId()]);
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $semaine,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="semaine_delete", methods="DELETE")
     */
    public function delete(Request $request, Semaine $semaine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$semaine->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($semaine);
            $em->flush();
        }

        return $this->redirectToRoute('semaine_index');
    }
}
