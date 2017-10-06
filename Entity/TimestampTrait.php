<?php

namespace Incompass\TimestampableBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Column;

/**
 * Class Timestampable
 *
 * @package Incompass\TimestampableBundle\Entity
 * @author  Joe Mizzi <joe@casehek.com>
 */
trait TimestampTrait
{
    /**
     * @var DateTime
     * @Column(name="created_at", type="datetime", options={"default": 0})
     */
    private $createdAt;

    /**
     * @var DateTime
     * @Column(name="updated_at", type="datetime", options={"default": 0})
     */
    private $updatedAt;

    /**
     * Sets createdAt.
     *
     * @param  DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets updatedAt.
     *
     * @param  DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
