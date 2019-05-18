<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function getGenderwiseReport()
    {
        $qb = $this->createQueryBuilder('e');

        return $qb
            ->select('COUNT(e.id) as employee_count')
            ->addSelect('e.gender')
            ->groupBy('e.gender')
            ->getQuery()
            ->getResult()
        ;

    }



    public function getQueryForEmployee($searhData)
    {
        $query =  $this->createQueryBuilder('e');
        //->getQuery();
        if(!empty($searhData['name'])){
            $query->andWhere('e.name LIKE :name')
                    ->setParameter('name','%'.trim($searhData['name']).'%');
        }
        if(!empty($searhData['age'])){
            $age_start_date = date('Y-m-d', strtotime('-'.$searhData['age'].' year'));
            $query->andWhere('e.dateOfBirth >= :dob')
                ->setParameter('dob', $age_start_date);
            $query->andWhere('e.dateOfBirth < :dob1')
                ->setParameter('dob1', date('Y-m-d', strtotime($age_start_date. ' + 1 year')));

            dump( date('Y-m-d', strtotime($age_start_date. ' + 1 year')));
            dump($age_start_date);
        }


        return $query->getQuery();
    }

}
