<?php

/**
 * This file is part of project yeskn-studio/wpcraft.
 *
 * Author: Jake
 * Create: 2018-09-14 17:25:53
 */

namespace Yeskn\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class NoticeRepository extends EntityRepository
{
    public function getUnreadCount($userId)
    {
        try {
            return (int) $this->createQueryBuilder('p')
                ->select('COUNT(p)')
                ->where('p.pushTo = :userId')
                ->andWhere('p.isRead = false')
                ->setParameter('userId', $userId)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException $exception) {
            return 0;
        }
    }
}
