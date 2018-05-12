<?php

namespace App\Controller\Admin;

use App\Entity\MachineDeGuerre;
use App\Form\MachineDeGuerreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/machine/de/guerre")
 */
class AdminMachineDeGuerreController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Machine de guerre',
        'label_pluriel' => 'Machines de guerre',
        'slug'  => 'machine_de_guerre'
    ];
    
    /**
     * @Route("/", name="machine_de_guerre_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $machineDeGuerres = $this->getDoctrine()
            ->getRepository(MachineDeGuerre::class)
            ->findAll();

        return $this->render('machine_de_guerre/index.html.twig', ['machine_de_guerres' => $machineDeGuerres]);
    }

    /**
     * @Route("/nouveau", name="machine_de_guerre_new")
     * @Method( {"GET","POST"} )
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

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $machineDeGuerre,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="machine_de_guerre_show")
     * @Method( {"GET"} )
     */
    public function show(MachineDeGuerre $machineDeGuerre): Response
    {
        return $this->render('machine_de_guerre/show.html.twig', ['machine_de_guerre' => $machineDeGuerre]);
    }

    /**
     * @Route("/{id}/edit", name="machine_de_guerre_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, MachineDeGuerre $machineDeGuerre): Response
    {
        $form = $this->createForm(MachineDeGuerreType::class, $machineDeGuerre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('machine_de_guerre_edit', ['id' => $machineDeGuerre->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $machineDeGuerre,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="machine_de_guerre_delete")
     * @Method( {"GET","POST"} )
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
