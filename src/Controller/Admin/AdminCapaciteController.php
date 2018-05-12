<?php

namespace App\Controller\Admin;

use App\Entity\Capacite;
use App\Form\CapaciteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/capacite")
 */
class AdminCapaciteController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Capacité',
        'label_pluriel' => 'Capacités',
        'slug'  => 'capacite'
    ];
    
    /**
     * @Route("/", name="capacite_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $capacites = $this->getDoctrine()
            ->getRepository(Capacite::class)
            ->findAll();

        return $this->render('capacite/index.html.twig', ['capacites' => $capacites]);
    }

    /**
     * @Route("/nouveau", name="capacite_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $capacite = new Capacite();
        $form = $this->createForm(CapaciteType::class, $capacite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($capacite);
            $em->flush();

            return $this->redirectToRoute('capacite_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $capacite,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="capacite_show")
     * @Method( {"GET"} )
     */
    public function show(Capacite $capacite): Response
    {
        return $this->render('capacite/show.html.twig', ['capacite' => $capacite]);
    }

    /**
     * @Route("/{id}/edit", name="capacite_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Capacite $capacite): Response
    {
        $form = $this->createForm(CapaciteType::class, $capacite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('capacite_edit', ['id' => $capacite->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $capacite,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));    }

    /**
     * @Route("/{id}", name="capacite_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Capacite $capacite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$capacite->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($capacite);
            $em->flush();
        }

        return $this->redirectToRoute('capacite_index');
    }
}
