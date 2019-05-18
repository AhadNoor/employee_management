<?php
/**
 * This file is part of the SalesTool project.
 *
 * @copyright Copyright (c) 2019, BRAC IT SERVICES LIMITED <http://www.bracits.com>
 * @author Roni Kumar Saha <ronikumar.saha@bracits.com>
 */


namespace App\Service;


use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeService
{
    public function getEmployeeData($request, $employeeRepository, $paginator)
    {
        $employees = $employeeRepository->findBy(array(), array('id' => 'DESC'));
        //$employees = $employeeRepository->getQueryForEmployee();
        $pagination = $paginator->paginate(
            $employees, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('limit', 5), /*limit per page*/
        );

        return $this->prepareEmployeeArray($pagination);

    }

    private function prepareEmployeeArray($employees){
        $employee_data = array();
        foreach ($employees as $employee){
            $employee_ar = array();
            $employee_ar['id'] = $employee->getId();
            $employee_ar['name'] = $employee->getName();
            $employee_ar['contact_no'] = $employee->getContactNo();
            $employee_ar['designation'] = $employee->getDesignation();
            $employee_ar['date_of_birth'] = $employee->getDateOfBirth();
            $employee_ar['gender'] = $employee->getGender();
            $employee_ar['avatar'] = $employee->getAvatar();
            $employee_ar['active'] = $employee->getActive();
            $employee_ar['created_at'] = $employee->getCreatedAt();
            $employee_ar['updated_at'] = $employee->getUpdatedAt();
            $employee_ar['note'] = $employee->getNote();
            $employee_data[] = $employee_ar;

        }
        return $employee_data;

    }

}
