<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.11
 */

namespace App\Resolver;


use App\Entity\TodoItem;
use App\Repository\TodoItemRepository;

class TodoResolver extends AbstractDoctrineResolver
{

    public function create($title)
    {
        $todoItem = TodoItem::createFromTitle($title);
        $this->em->persist($todoItem);
        $this->em->flush();
        return $this->findAll();
    }

    public function findAll()
    {
        return $this->getRepository()->findAllOrdered();
    }

    /**
     * @return TodoItemRepository
     */
    private function getRepository()
    {
        return $this->em->getRepository(TodoItem::class);
    }

    public function toggleAll($checked)
    {
        $todoItems = $this->getRepository()->findAllOrdered();
        foreach ($todoItems as $todoItem) {
            $todoItem->setCompleted($checked);
        }
        $this->em->flush();
        return $todoItems;
    }

    public function toggle($id)
    {
        $todoItem = $this->getRepository()->find($id);
        if (!$todoItem) {
            throw $this->createNotFoundException();
        }
        $todoItem->setCompleted(!$todoItem->getCompleted());
        $this->em->flush();
        return $this->findAll();
    }

    public function destroy($id)
    {
        $todoItem = $this->getRepository()->find($id);
        if (!$todoItem) {
            throw $this->createNotFoundException();
        }
        $this->em->remove($todoItem);
        $this->em->flush();
        return $this->findAll();
    }

    public function save($id, $title)
    {
        $todoItem = $this->getRepository()->find($id);
        if (!$todoItem) {
            throw $this->createNotFoundException();
        }
        $todoItem->setTitle($title);
        $this->em->flush();
        return $this->findAll();
    }

    public function clearCompleted()
    {
        $this->getRepository()->removeCompleted();
        return $this->findAll();
    }
}