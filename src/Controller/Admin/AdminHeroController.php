<?php

namespace App\Controller\Admin;

use App\Entity\Hero;
use App\Form\HeroType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/hero")
 */
class AdminHeroController extends Controller
{
    /**
     * @Route("/", name="hero_index", methods="GET")
     */
    public function index(): Response
    {
        $heroes = $this->getDoctrine()
            ->getRepository(Hero::class)
            ->findAll();

        return $this->render('hero/index.html.twig', ['heroes' => $heroes]);
    }

    /**
     * @Route("/new", name="hero_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hero = new Hero();
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hero);
            $em->flush();

            return $this->redirectToRoute('hero_index');
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $hero,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="hero_show", methods="GET")
     */
    public function show(Hero $hero): Response
    {
        return $this->render('hero/show.html.twig', ['hero' => $hero]);
    }

    /**
     * @Route("/{id}/edit", name="hero_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hero $hero): Response
    {
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hero_edit', ['id' => $hero->getId()]);
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $hero,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="hero_delete", methods="DELETE")
     */
    public function delete(Request $request, Hero $hero): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hero->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hero);
            $em->flush();
        }

        return $this->redirectToRoute('hero_index');
    }
}
