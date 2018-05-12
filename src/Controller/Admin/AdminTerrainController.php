<?php

namespace App\Controller\Admin;

use App\Entity\Terrain;
use App\Form\TerrainType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/terrain")
 */
class AdminTerrainController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouveau',
        'label' => 'Terrain',
        'label_pluriel' => 'Terrains',
        'slug'  => 'terrain'
    ];
    
    /**
     * @Route("/", name="terrain_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $terrains = $this->getDoctrine()
            ->getRepository(Terrain::class)
            ->findAll();

        return $this->render('terrain/index.html.twig', ['terrains' => $terrains]);
    }

    /**
     * @Route("/nouveau", name="terrain_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $terrain = new Terrain();
        $form = $this->createForm(TerrainType::class, $terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($terrain);
            $em->flush();

            return $this->redirectToRoute('terrain_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $terrain,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="terrain_show")
     * @Method( {"GET"} )
     */
    public function show(Terrain $terrain): Response
    {
        return $this->render('terrain/show.html.twig', ['terrain' => $terrain]);
    }

    /**
     * @Route("/{id}/edit", name="terrain_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Terrain $terrain): Response
    {
        $form = $this->createForm(TerrainType::class, $terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('terrain_edit', ['id' => $terrain->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $terrain,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="terrain_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Terrain $terrain): Response
    {
        if ($this->isCsrfTokenValid('delete'.$terrain->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($terrain);
            $em->flush();
        }

        return $this->redirectToRoute('terrain_index');
    }
}
