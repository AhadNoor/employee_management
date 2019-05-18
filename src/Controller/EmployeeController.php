<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeSearch;
use App\Form\Type\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EmployeeController extends AbstractController
{

    /**
     * @Route("/", name="app_home", methods={"GET|POST"})
     */
    public function index(Request $request)
    {

        return Response::create('Welcome Home');
    }
}
