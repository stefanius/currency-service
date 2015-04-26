<?php
namespace Stef\CurrencyServiceBundle\Manager;

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
}