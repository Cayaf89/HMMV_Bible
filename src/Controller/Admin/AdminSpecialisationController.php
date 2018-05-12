<?php

namespace App\Controller\Admin;

use App\Entity\Specialisation;
use App\Form\SpecialisationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/specialisation")
 */
class AdminSpecialisationController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Spécialisation',
        'label_pluriel' => 'Spécialisations',
        'slug'  => 'specialisation'
    ];
    
    /**
     * @Route("/", name="specialisation_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $specialisations = $this->getDoctrine()
            ->getRepository(Specialisation::class)
            ->findAll();

        return $this->render('specialisation/index.html.twig', ['specialisations' => $specialisations]);
    }

    /**
     * @Route("/nouveau", name="specialisation_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $specialisation = new Specialisation();
        $form = $this->createForm(SpecialisationType::class, $specialisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialisation);
            $em->flush();

            return $this->redirectToRoute('specialisation_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $specialisation,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="specialisation_show")
     * @Method( {"GET"} )
     */
    public function show(Specialisation $specialisation): Response
    {
        return $this->render('specialisation/show.html.twig', ['specialisation' => $specialisation]);
    }

    /**
     * @Route("/{id}/edit", name="specialisation_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Specialisation $specialisation): Response
    {
        $form = $this->createForm(SpecialisationType::class, $specialisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialisation_edit', ['id' => $specialisation->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $specialisation,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="specialisation_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Specialisation $specialisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialisation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($specialisation);
            $em->flush();
        }

        return $this->redirectToRoute('specialisation_index');
    }
}
