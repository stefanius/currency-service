<?php

namespace Stef\CurrencyServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbstractServiceOptionsEntity
 */
class AbstractServiceOptionsEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_display_name", type="string", length=255)
     */
    protected $currencyDisplayName;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_service_code", type="string", length=255)
     */
    protected $currencyServiceCode;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currencyDisplayName
     *
     * @param string $currencyDisplayName
     * @return AbstractServiceOptionsEntity
     */
    public function setCurrencyDisplayName($currencyDisplayName)
    {
        $this->currencyDisplayName = $currencyDisplayName;

        return $this;
    }

    /**
     * Get currencyDisplayName
     *
     * @return string 
     */
    public function getCurrencyDisplayName()
    {
        return $this->currencyDisplayName;
    }

    /**
     * Set currencyServiceCode
     *
     * @param string $currencyServiceCode
     * @return AbstractServiceOptionsEntity
     */
    public function setCurrencyServiceCode($currencyServiceCode)
    {
        $this->currencyServiceCode = $currencyServiceCode;

        return $this;
    }

    /**
     * Get currencyServiceCode
     *
     * @return string 
     */
    public function getCurrencyServiceCode()
    {
        return $this->currencyServiceCode;
    }
}
