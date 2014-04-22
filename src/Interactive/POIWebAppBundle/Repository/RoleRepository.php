<?php

namespace Interactive\POIWebAppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RoleRepository
 *
 */
class RoleRepository extends EntityRepository
{
    public function getUserRole()
    {
      $query = $this->getEntityManager()
            ->createQuery('SELECT R FROM POIWebAppBundle:Role R WHERE R.role  = :roleName')
            ->setParameter('roleName', "ROLE_USER");
        return $query->getResult();
    }
}
