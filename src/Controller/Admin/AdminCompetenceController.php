<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use App\Form\CompetenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/competence")
 */
class AdminCompetenceController extends Controller
{
    private $twig_form_view_params = [
        'etat'  => 'nouvelle',
        'label' => 'Compétence',
        'label_pluriel' => 'Compétences',
        'slug'  => 'competence'
    ];
    
    /**
     * @Route("/", name="competence_index")
     * @Method( {"GET"} )
     */
    public function index(): Response
    {
        $competences = $this->getDoctrine()
            ->getRepository(Competence::class)
            ->findAll();

        return $this->render('competence/index.html.twig', ['competences' => $competences]);
    }

    /**
     * @Route("/nouveau", name="competence_new")
     * @Method( {"GET","POST"} )
     */
    public function new(Request $request): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($competence);
            $em->flush();

            return $this->redirectToRoute('competence_index');
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $competence,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="competence_show")
     * @Method( {"GET"} )
     */
    public function show(Competence $competence): Response
    {
        return $this->render('competence/show.html.twig', ['competence' => $competence]);
    }

    /**
     * @Route("/{id}/edit", name="competence_edit")
     * @Method( {"GET","POST"} )
     */
    public function edit(Request $request, Competence $competence): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competence_edit', ['id' => $competence->getId()]);
        }

        return $this->render('entity/children/form.html.twig', array_merge([
            'object'   => $competence,
            'form'     => $form->createView()
        ], 
        $this->twig_form_view_params));
    }

    /**
     * @Route("/{id}", name="competence_delete")
     * @Method( {"GET","POST"} )
     */
    public function delete(Request $request, Competence $competence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($competence);
            $em->flush();
        }

        return $this->redirectToRoute('competence_index');
    }
}
