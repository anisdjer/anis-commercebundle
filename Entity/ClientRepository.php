<?php

namespace Anis\CommerceBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends EntityRepository
{

    public function getCount(){
//        $query =$this->getEntityManager()
//            ->createQuery('SELECT count(*) FROM AnisCommerceBundle:Client c');

        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('COUNT(id) as count') ->getQuery();
        return  $query->getResult();
    }

    public function findAllLimited($page)
    {

        $min =($page > 0 ? ($page-1) * 10 : 0);
        //$max =($page > 0 ? $page * 10 : 10);
        $max = 10;

        $query =$this->getEntityManager()
            ->createQuery('SELECT c FROM AnisCommerceBundle:Client c')
            ->setFirstResult($min)
            ->setMaxResults($max);

        return  $query->getResult();
    }
    public function getListBy($criteria)
    {
        $qb = $this->createQueryBuilder('i');


        foreach ($criteria as $field => $value) {
            if (!$this->getClassMetadata()->hasField($field)) {
                // Make sure we only use existing fields (avoid any injection)

                continue;
            }


            $qb ->andWhere($qb->expr()->eq('i.'.$field, ':i_'.$field))
                ->setParameter('i_'.$field, $value);
        }

        //die(var_dump($qb->getQuery()->getResult()));
        return $qb->getQuery()->getResult();
    }
}
