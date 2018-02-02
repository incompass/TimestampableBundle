<?php

namespace Incompass\TimestampableBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * * @Groups({"surgery_status_read", "vendor_request_status_read", "vendor_request_tray_scan_read"})
     * @Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     * @Column(name="updated_at", type="datetime")
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
