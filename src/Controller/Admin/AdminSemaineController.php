<?php

namespace App\Controller\Admin;

use App\Entity\Semaine;
use App\Form\SemaineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/semaine")
 */
class AdminSemaineController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Semaine',
        'label_pluriel' => 'Semaines',
        'slug'  => 'semaine'
    ];
    
    /**
     * @Route("/", name="semaine_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $semaines = $this->getDoctrine()
            ->getRepository(Semaine::class)
            ->findAll();

        return $this->render('semaine/index.html.twig', ['semaines' => $semaines]);
    }

    /**
     * @Route("/nouveau", name="semaine_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $semaine = new Semaine();
        $form = $this->createForm(SemaineType::class, $semaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($semaine);
            $em->flush();

            return $this->redirectToRoute('semaine_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $semaine,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="semaine_show")
     * @Method( {"GET"} )
     */
    public function show(Semaine $semaine): Response
    {
        return $this->render('semaine/show.html.twig', ['semaine' => $semaine]);
    }

    /**
     * @Route("/{id}/edit", name="semaine_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Semaine $semaine): Response
    {
        $form = $this->createForm(SemaineType::class, $semaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('semaine_edit', ['id' => $semaine->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $semaine,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="semaine_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Semaine $semaine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$semaine->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($semaine);
            $em->flush();
        }

        return $this->redirectToRoute('semaine_index');
    }
}
