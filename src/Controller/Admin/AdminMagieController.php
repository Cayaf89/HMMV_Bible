<?php

namespace App\Controller\Admin;

use App\Entity\Magie;
use App\Form\MagieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/magie")
 */
class AdminMagieController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Magie',
        'label_pluriel' => 'Magies',
        'slug'  => 'magie'
    ];
    
    /**
     * @Route("/", name="magie_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $magies = $this->getDoctrine()
            ->getRepository(Magie::class)
            ->findAll();

        return $this->render('magie/index.html.twig', ['magies' => $magies]);
    }

    /**
     * @Route("/nouveau", name="magie_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $magie = new Magie();
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($magie);
            $em->flush();

            return $this->redirectToRoute('magie_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $magie,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="magie_show")
     * @Method( {"GET"} )
     */
    public function show(Magie $magie): Response
    {
        return $this->render('magie/show.html.twig', ['magie' => $magie]);
    }

    /**
     * @Route("/{id}/edit", name="magie_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Magie $magie): Response
    {
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magie_edit', ['id' => $magie->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $magie,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="magie_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Magie $magie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($magie);
            $em->flush();
        }

        return $this->redirectToRoute('magie_index');
    }
}
