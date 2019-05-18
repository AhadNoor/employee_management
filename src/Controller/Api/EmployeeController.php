<?php

namespace App\Controller\Api;


use App\Repository\EmployeeRepository;
use App\Service\EmployeeService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Controller\Api
 *
 * @Route("/api/v1", name="default")
 *
 */

class EmployeeController
{
    /**
     * @Route("/employee", name="api_get_employees" )
     */
    public function getEmployees( Request $request, EmployeeRepository $employeeRepository,PaginatorInterface $paginator, EmployeeService $employeeService)
    {
        $employees = $employeeService->getEmployeeData($request, $employeeRepository, $paginator);
        $response = JsonResponse::fromJsonString(json_encode($employees));
        return $response;

    }
}
