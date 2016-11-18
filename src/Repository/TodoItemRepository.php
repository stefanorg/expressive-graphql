<?php

namespace App\Repository;

use App\Entity\TodoItem;
use Doctrine\ORM\EntityRepository;

/**
 * TodoItemRepository
 *
 */
class TodoItemRepository extends EntityRepository
{

    /**
     * @return TodoItem[]
     */
    public function findAllOrdered()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function removeCompleted()
    {
        $this->createQueryBuilder('t')
            ->delete()
            ->where('t.completed = :true')
            ->setParameter('true', true)
            ->getQuery()
            ->execute();
    }

}