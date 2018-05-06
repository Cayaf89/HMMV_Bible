<?php

namespace App\Controller;

use App\Entity\Peloton;
use App\Form\PelotonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/peloton")
 */
class PelotonController extends Controller
{
    /**
     * @Route("/", name="peloton_index", methods="GET")
     */
    public function index(): Response
    {
        $pelotons = $this->getDoctrine()
            ->getRepository(Peloton::class)
            ->findAll();

        return $this->render('peloton/index.html.twig', ['pelotons' => $pelotons]);
    }

    /**
     * @Route("/new", name="peloton_new", methods="GET|POST")
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

        return $this->render('peloton/new.html.twig', [
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="peloton_show", methods="GET")
     */
    public function show(Peloton $peloton): Response
    {
        return $this->render('peloton/show.html.twig', ['peloton' => $peloton]);
    }

    /**
     * @Route("/{id}/edit", name="peloton_edit", methods="GET|POST")
     */
    public function edit(Request $request, Peloton $peloton): Response
    {
        $form = $this->createForm(PelotonType::class, $peloton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('peloton_edit', ['id' => $peloton->getId()]);
        }

        return $this->render('peloton/edit.html.twig', [
            'peloton' => $peloton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="peloton_delete", methods="DELETE")
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
