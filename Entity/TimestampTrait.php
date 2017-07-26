<?php

namespace Incompass\TimestampableBundle\Entity;

use DateTime;

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
     * @ORM\Column(name="created_at", type="datetime", options={"default": 0})
     */
    private $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime", options={"default": 0})
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
