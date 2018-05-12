<?php

namespace App\Controller\Admin;

use App\Entity\Batiment;
use App\Form\BatimentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/batiment")
 */
class AdminBatimentController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouveau',
        'label' => 'Batîment',
        'label_pluriel' => 'Batîments',
        'slug'  => 'batiment'
    ];
    
    /**
     * @Route("/", name="batiment_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $batiments = $this->getDoctrine()
            ->getRepository(Batiment::class)
            ->findAll();

        return $this->render('batiment/index.html.twig', ['batiments' => $batiments]);
    }

    /**
     * @Route("/nouveau", name="batiment_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $batiment = new Batiment();
        $form = $this->createForm(BatimentType::class, $batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batiment);
            $em->flush();

            return $this->redirectToRoute('batiment_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $batiment,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="batiment_show")
     * @Method( {"GET"} )
     */
    public function show(Batiment $batiment): Response
    {
        return $this->render('batiment/show.html.twig', ['batiment' => $batiment]);
    }

    /**
     * @Route("/{id}/edit", name="batiment_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Batiment $batiment): Response
    {
        $form = $this->createForm(BatimentType::class, $batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batiment_edit', ['id' => $batiment->getId()]);
        }

        return $this->render('batiment/edit.html.twig', [
            'batiment' => $batiment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="batiment_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Batiment $batiment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$batiment->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($batiment);
            $em->flush();
        }

        return $this->redirectToRoute('batiment_index');
    }
}
