<?php

namespace App\Controller\Admin;

use App\Entity\Panoplie;
use App\Form\PanoplieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/panoplie")
 */
class AdminPanoplieController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Panoplie',
        'label_pluriel' => 'Panoplies',
        'slug'  => 'panoplie'
    ];
    
    /**
     * @Route("/", name="panoplie_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $panoplies = $this->getDoctrine()
            ->getRepository(Panoplie::class)
            ->findAll();

        return $this->render('panoplie/index.html.twig', ['panoplies' => $panoplies]);
    }

    /**
     * @Route("/nouveau", name="panoplie_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $panoplie = new Panoplie();
        $form = $this->createForm(PanoplieType::class, $panoplie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panoplie);
            $em->flush();

            return $this->redirectToRoute('panoplie_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $panoplie,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="panoplie_show")
     * @Method( {"GET"} )
     */
    public function show(Panoplie $panoplie): Response
    {
        return $this->render('panoplie/show.html.twig', ['panoplie' => $panoplie]);
    }

    /**
     * @Route("/{id}/edit", name="panoplie_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Panoplie $panoplie): Response
    {
        $form = $this->createForm(PanoplieType::class, $panoplie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panoplie_edit', ['id' => $panoplie->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $panoplie,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="panoplie_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Panoplie $panoplie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panoplie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panoplie);
            $em->flush();
        }

        return $this->redirectToRoute('panoplie_index');
    }
}
