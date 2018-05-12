<?php

namespace App\Controller\Admin;

use App\Entity\Artefact;
use App\Form\ArtefactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/artefact")
 */
class AdminArtefactController extends Controller
{
    private $twig_form_view_params = [
        'etat'          => 'nouvel',
        'label'         => 'Artéfact',
        'label_pluriel' => 'Artéfacts',
        'slug'          => 'artefact'
    ];
    
    /**
     * @Route("/", name="artefact_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $artefacts = $this->getDoctrine()
            ->getRepository(Artefact::class)
            ->findAll();

        return $this->render('artefact/index.html.twig', ['artefacts' => $artefacts]);
    }

    /**
     * @Route("/nouveau", name="artefact_new")
     * @Method( {"GET","POST"} )
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

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $artefact,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/afficher/{id}", name="artefact_show")
     * @Method( {"GET"} )
     */
    public function show(Artefact $artefact): Response
    {
        return $this->render('artefact/show.html.twig', ['artefact' => $artefact]);
    }

    /**
     * @Route("/editer/{id}", name="artefact_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Artefact $artefact): Response
    {
        $form = $this->createForm(ArtefactType::class, $artefact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artefact_edit', ['id' => $artefact->getId()]);
        }
        
        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $artefact,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/supprimer/{id}", name="artefact_delete")
     * @Method( {"GET","POST"} )
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
