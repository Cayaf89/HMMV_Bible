<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        
        return $this->render('dashboard/dashboard.html.twig');
    }
}
