<?php


namespace Incompass\TimestampableBundle\Entity;


use DateTime;

interface TimestampInterface
{
    /**
     * Sets createdAt.
     *
     * @param  DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt);

    /**
     * Returns createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Sets updatedAt.
     *
     * @param  DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt);

    /**
     * Returns updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt();
}
