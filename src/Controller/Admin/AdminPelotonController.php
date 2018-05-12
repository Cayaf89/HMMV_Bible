<?php

namespace App\Controller\Admin;

use App\Entity\Peloton;
use App\Form\PelotonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/peloton")
 */
class AdminPelotonController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouveau',
        'label' => 'Peloton',
        'label_pluriel' => 'Prelotons',
        'slug'  => 'peloton'
    ];
    
    /**
     * @Route("/", name="peloton_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $pelotons = $this->getDoctrine()
            ->getRepository(Peloton::class)
            ->findAll();

        return $this->render('peloton/index.html.twig', ['pelotons' => $pelotons]);
    }

    /**
     * @Route("/nouveau", name="peloton_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $peloton = new Peloton();
        $form = $this->createForm(PelotonType::class, $peloton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($peloton);
            $em->flush();

            return $this->redirectToRoute('peloton_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $peloton,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="peloton_show")
     * @Method( {"GET"} )
     */
    public function show(Peloton $peloton): Response
    {
        return $this->render('peloton/show.html.twig', ['peloton' => $peloton]);
    }

    /**
     * @Route("/{id}/edit", name="peloton_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Peloton $peloton): Response
    {
        $form = $this->createForm(PelotonType::class, $peloton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peloton_edit', ['id' => $peloton->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $peloton,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="peloton_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Peloton $peloton): Response
    {
        if ($this->isCsrfTokenValid('delete'.$peloton->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($peloton);
            $em->flush();
        }

        return $this->redirectToRoute('peloton_index');
    }
}
