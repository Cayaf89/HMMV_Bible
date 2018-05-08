<?php

namespace App\Controller\Admin;

use App\Entity\Sort;
use App\Form\SortType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sort")
 */
class AdminSortController extends Controller
{
    /**
     * @Route("/", name="sort_index", methods="GET")
     */
    public function index(): Response
    {
        $sorts = $this->getDoctrine()
            ->getRepository(Sort::class)
            ->findAll();

        return $this->render('sort/index.html.twig', ['sorts' => $sorts]);
    }

    /**
     * @Route("/new", name="sort_new", methods="GET|POST")
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

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $sort,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="sort_show", methods="GET")
     */
    public function show(Sort $sort): Response
    {
        return $this->render('sort/show.html.twig', ['sort' => $sort]);
    }

    /**
     * @Route("/{id}/edit", name="sort_edit", methods="GET|POST")
     */
    public function edit(Request $request, Sort $sort): Response
    {
        $form = $this->createForm(SortType::class, $sort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sort_edit', ['id' => $sort->getId()]);
        }

        return $this->render('form/form.html.twig', array_merge([
            'object'   => $sort,
            'form'     => $form->createView()
        ], 
        $this->twig_params));
    }

    /**
     * @Route("/{id}", name="sort_delete", methods="DELETE")
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
