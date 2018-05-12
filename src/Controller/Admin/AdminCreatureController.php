<?php

namespace App\Controller\Admin;

use App\Entity\Creature;
use App\Form\CreatureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/creature")
 */
class AdminCreatureController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Créature',
        'label_pluriel' => 'Créatures',
        'slug'  => 'creature'
    ];
    
    /**
     * @Route("/", name="creature_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creature::class)
            ->findAll();

        return $this->render('creature/index.html.twig', ['creatures' => $creatures]);
    }

    /**
     * @Route("/nouveau", name="creature_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $creature = new Creature();
        $form = $this->createForm(CreatureType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($creature);
            $em->flush();

            return $this->redirectToRoute('creature_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $creature,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="creature_show")
     * @Method( {"GET"} )
     */
    public function show(Creature $creature): Response
    {
        return $this->render('creature/show.html.twig', ['creature' => $creature]);
    }

    /**
     * @Route("/{id}/edit", name="creature_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Creature $creature): Response
    {
        $form = $this->createForm(CreatureType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('creature_edit', ['id' => $creature->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $creature,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="creature_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Creature $creature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creature->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($creature);
            $em->flush();
        }

        return $this->redirectToRoute('creature_index');
    }
}
