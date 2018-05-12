<?php

namespace App\Controller\Admin;

use App\Entity\Ressource;
use App\Form\RessourceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/ressource")
 */
class AdminRessourceController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Ressource',
        'label_pluriel' => 'Ressources',
        'slug'  => 'ressource'
    ];
    
    /**
     * @Route("/", name="ressource_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $ressources = $this->getDoctrine()
            ->getRepository(Ressource::class)
            ->findAll();

        return $this->render('ressource/index.html.twig', ['ressources' => $ressources]);
    }

    /**
     * @Route("/nouveau", name="ressource_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();

            return $this->redirectToRoute('ressource_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $ressource,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="ressource_show")
     * @Method( {"GET"} )
     */
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressource/show.html.twig', ['ressource' => $ressource]);
    }

    /**
     * @Route("/{id}/edit", name="ressource_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Ressource $ressource): Response
    {
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ressource_edit', ['id' => $ressource->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $ressource,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="ressource_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Ressource $ressource): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ressource);
            $em->flush();
        }

        return $this->redirectToRoute('ressource_index');
    }
}
