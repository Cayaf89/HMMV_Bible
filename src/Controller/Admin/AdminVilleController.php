<?php

namespace App\Controller\Admin;

use App\Entity\Ville;
use App\Form\VilleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/ville")
 */
class AdminVilleController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Ville',
        'label_pluriel' => 'Villes',
        'slug'  => 'ville',
        'methods' => ["id", "nom", "description"],
        'headers' => ["Id", "Nom", "Description"]
    ];
    
    /**
     * @Route("/", name="ville_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $villes = $this->getDoctrine()
            ->getRepository(Ville::class)
            ->findAll();

        
        return $this->render('entity/children/index.html.twig', array_merge([
            'objects'   => $villes,
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/nouveau", name="ville_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $ville,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="ville_show")
     * @Method( {"GET"} )
     */
    public function show(Ville $ville): Response
    {
        return $this->render('ville/show.html.twig', ['ville' => $ville]);
    }

    /**
     * @Route("/{id}/edit", name="ville_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_edit', ['id' => $ville->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $ville,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="ville_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
        }

        return $this->redirectToRoute('ville_index');
    }
}
