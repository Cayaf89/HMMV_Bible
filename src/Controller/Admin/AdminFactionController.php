<?php

namespace App\Controller\Admin;

use App\Entity\Faction;
use App\Form\FactionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/faction")
 */
class AdminFactionController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Faction',
        'label_pluriel' => 'Factions',
        'slug'  => 'faction'
    ];
    
    /**
     * @Route("/", name="faction_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $factions = $this->getDoctrine()
            ->getRepository(Faction::class)
            ->findAll();

        return $this->render('faction/index.html.twig', ['factions' => $factions]);
    }

    /**
     * @Route("/nouveau", name="faction_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $faction = new Faction();
        $form = $this->createForm(FactionType::class, $faction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faction);
            $em->flush();

            return $this->redirectToRoute('faction_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $faction,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="faction_show")
     * @Method( {"GET"} )
     */
    public function show(Faction $faction): Response
    {
        return $this->render('faction/show.html.twig', ['faction' => $faction]);
    }

    /**
     * @Route("/{id}/edit", name="faction_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Faction $faction): Response
    {
        $form = $this->createForm(FactionType::class, $faction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faction_edit', ['id' => $faction->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $faction,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="faction_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Faction $faction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$faction->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faction);
            $em->flush();
        }

        return $this->redirectToRoute('faction_index');
    }
}
