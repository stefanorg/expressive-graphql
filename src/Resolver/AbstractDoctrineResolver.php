<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.07
 */

namespace App\Resolver;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractDoctrineResolver
{

    /** @var  EntityManagerInterface */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    protected function createNotFoundException($message = 'Entity not found')
    {
        return new \Exception($message, 404);
    }
    protected function createInvalidParamsException($message = 'Invalid params')
    {
        return new \Exception($message, 400);
    }
    protected function createAccessDeniedException($message = 'No access to this action')
    {
        return new \Exception($message, 403);
    }

    protected function getEntityManager()
    {
        return $this->em;
    }
}