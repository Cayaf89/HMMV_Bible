<?php

namespace App\Controller\Admin;

use App\Entity\Hero;
use App\Form\HeroType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/hero")
 */
class AdminHeroController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouveau',
        'label' => 'Héro',
        'label_pluriel' => 'Héros',
        'slug'  => 'hero'
    ];
    
    /**
     * @Route("/", name="hero_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $heroes = $this->getDoctrine()
            ->getRepository(Hero::class)
            ->findAll();

        return $this->render('hero/index.html.twig', ['heroes' => $heroes]);
    }

    /**
     * @Route("/nouveau", name="hero_new")
     * @Method( {"GET","POST"} )
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

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $hero,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="hero_show")
     * @Method( {"GET"} )
     */
    public function show(Hero $hero): Response
    {
        return $this->render('hero/show.html.twig', ['hero' => $hero]);
    }

    /**
     * @Route("/{id}/edit", name="hero_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Hero $hero): Response
    {
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hero_edit', ['id' => $hero->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $hero,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="hero_delete")
     * @Method( {"GET","POST"} )
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
