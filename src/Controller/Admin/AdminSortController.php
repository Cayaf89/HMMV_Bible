<?php

namespace App\Controller\Admin;

use App\Entity\Sort;
use App\Form\SortType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/sort")
 */
class AdminSortController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouveau',
        'label' => 'Sort',
        'label_pluriel' => 'Sorts',
        'slug'  => 'sort'
    ];
    
    /**
     * @Route("/", name="sort_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $sorts = $this->getDoctrine()
            ->getRepository(Sort::class)
            ->findAll();

        return $this->render('sort/index.html.twig', ['sorts' => $sorts]);
    }

    /**
     * @Route("/nouveau", name="sort_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $sort = new Sort();
        $form = $this->createForm(SortType::class, $sort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sort);
            $em->flush();

            return $this->redirectToRoute('sort_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $sort,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="sort_show")
     * @Method( {"GET"} )
     */
    public function show(Sort $sort): Response
    {
        return $this->render('sort/show.html.twig', ['sort' => $sort]);
    }

    /**
     * @Route("/{id}/edit", name="sort_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Sort $sort): Response
    {
        $form = $this->createForm(SortType::class, $sort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sort_edit', ['id' => $sort->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $sort,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="sort_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Sort $sort): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sort->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sort);
            $em->flush();
        }

        return $this->redirectToRoute('sort_index');
    }
}
