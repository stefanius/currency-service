<?php
namespace Stef\CurrencyServiceBundle\Manager;

use Stef\CurrencyServiceBundle\Entity\AbstractServiceOptionsEntity;
use Stef\SimpleCmsBundle\Manager\AbstractObjectManager;

abstract class AbstractOptionsManager extends AbstractObjectManager
{
    /**
     * @param $key
     * @return mixed
     */
    public function read($key)
    {
        $entity = parent::read($key);

        if ($entity === null) {
            $entity = $this->om->getRepository($this->repoName)->findOneByCurrencyServiceCode($key);
        }

        return $entity;
    }

    /**
     * @param AbstractServiceOptionsEntity $entity
     */
    public function persist($entity) {
        $checkEntity = $this->read($entity->getCurrencyServiceCode());

        if ($checkEntity == null) {
            parent::persist($entity);
        }
    }
}