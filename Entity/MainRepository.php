<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anis Bouhachem
 * Date: 01/11/13
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */


namespace Anis\CommerceBundle\Entity;

use Doctrine\ORM\EntityRepository;


class MainRepository extends EntityRepository
{

    /**
     * Lazy loading ( loads by 10 )
     * @author Anis Bouhachem
     * @param $page
     * @return array
     */
    public function findAllLimited($page, $criteria = array())
    {

        $min =($page > 0 ? ($page-1) * 10 : 0);
        $max = 10;


        $qb = $this->createQueryBuilder('i');
        $qb->setFirstResult($min)->setMaxResults($max);

        foreach ($criteria as $field => $value) {
            if (!$this->getClassMetadata()->hasField($field)) {
                continue;
            }

            $qb ->andWhere($qb->expr()->eq('i.'.$field, ':i_'.$field))
                ->setParameter('i_'.$field, $value);
        }

        return  $qb->getQuery()->getResult();
    }

    /**
     * Called when searching by criteria for special entities.
     * @author Anis Bouhachem
     * @param $criteria
     * @return array
     */
    public function getListBy($criteria)
    {
        $qb = $this->createQueryBuilder('i');


        foreach ($criteria as $field => $value) {
            if (!$this->getClassMetadata()->hasField($field)) {
                continue;
            }

            $qb ->andWhere($qb->expr()->eq('i.'.$field, ':i_'.$field))
                ->setParameter('i_'.$field, $value);
        }

        return $qb->getQuery()->getResult();
    }

}
