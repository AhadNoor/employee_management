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
    public function index(Request $request, EmployeeRepository $employeeRepository, PaginatorInterface $paginator)
    {

        $searchForm = $this->createForm(EmployeeSearch::class, null);

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searhData = $searchForm->getData();
            $employees = $employeeRepository->getQueryForEmployee($searhData);
        } else {
            $employees = $employeeRepository->findBy(array(), array('id' => 'DESC'));
        }

        $pagination = $paginator->paginate(
            $employees, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );

        return $this->render(
            'employee/index.html.twig',
            [
                'searchForm' => $searchForm->createView(),
                'employees' => $employees,
                'pagination' => $pagination,
            ]
        );
    }

    /**
     * @Route ("/employee/new", name="new_employee", methods={"GET|POST"})
     *
     */

    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $employee = new Employee();

        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render(
            'employee/new.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route ("/employee/update/{id}", name="update_employee", methods={"GET|POST"})
     *
     */
    public function update(
        Request $request,
        $id,
        EmployeeRepository $employeeRepository,
        EntityManagerInterface $entityManager
    ) {
        $employee = $employeeRepository->find($id);
        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render(
            'employee/update.html.twig',
            array(
                'form' => $form->createView(),
                'employee' => $employee,
            )
        );
    }

    /**
     * @Route("/employee/show/{id}", name="show_employee", methods={"GET"})
     */
    public function show(Employee $employee): Response
    {
        return $this->render(
            'employee/show.html.twig',
            [
                'employee' => $employee,
            ]
        );
    }

    /**
     * @Route("/employee/delete/{id}", name="delete_employee", methods={"DELETE|GET"})
     */
    public function delete(Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($employee);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/employee/report", name="employee_report", methods={"GET"})
     */
    public function report(EmployeeRepository $employeeRepository)
    {

    }
}
