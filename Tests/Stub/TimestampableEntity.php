<?php

namespace Incompass\TimestampableBundle\Tests\Stub;

use Doctrine\ORM\Mapping as ORM;
use Incompass\TimestampableBundle\Entity\Timestampable;

/**
 * Class TimestampableEntity
 *
 * @package Incompass\TimestampableBundle\Stub
 * @author  Joe Mizzi <joe@casechek.com>
 *
 * @ORM\Table(name="timestampable")
 * @ORM\Entity()
 */
class TimestampableEntity
{
    use Timestampable;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $field;

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }
}