<?php

namespace App\Controller\Admin;

use App\Entity\MachineDeGuerre;
use App\Form\MachineDeGuerreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/machine/de/guerre")
 */
class AdminMachineDeGuerreController extends Controller
{
    /**
     * @Route("/", name="machine_de_guerre_index", methods="GET")
     */
    public function index(): Response
    {
        $machineDeGuerres = $this->getDoctrine()
            ->getRepository(MachineDeGuerre::class)
            ->findAll();

        return $this->render('machine_de_guerre/index.html.twig', ['machine_de_guerres' => $machineDeGuerres]);
    }

    /**
     * @Route("/new", name="machine_de_guerre_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $machineDeGuerre = new MachineDeGuerre();
        $form = $this->createForm(MachineDeGuerreType::class, $machineDeGuerre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($machineDeGuerre);
            $em->flush();

            return $this->redirectToRoute('machine_de_guerre_index');
        }

        return $this->render('machine_de_guerre/new.html.twig', [
            'machine_de_guerre' => $machineDeGuerre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="machine_de_guerre_show", methods="GET")
     */
    public function show(MachineDeGuerre $machineDeGuerre): Response
    {
        return $this->render('machine_de_guerre/show.html.twig', ['machine_de_guerre' => $machineDeGuerre]);
    }

    /**
     * @Route("/{id}/edit", name="machine_de_guerre_edit", methods="GET|POST")
     */
    public function edit(Request $request, MachineDeGuerre $machineDeGuerre): Response
    {
        $form = $this->createForm(MachineDeGuerreType::class, $machineDeGuerre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('machine_de_guerre_edit', ['id' => $machineDeGuerre->getId()]);
        }

        return $this->render('machine_de_guerre/edit.html.twig', [
            'machine_de_guerre' => $machineDeGuerre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="machine_de_guerre_delete", methods="DELETE")
     */
    public function delete(Request $request, MachineDeGuerre $machineDeGuerre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$machineDeGuerre->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($machineDeGuerre);
            $em->flush();
        }

        return $this->redirectToRoute('machine_de_guerre_index');
    }
}
