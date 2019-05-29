<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Internship
 *
 * @ORM\Table(name="internship")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\InternshipRepository")
 */
class Internship
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finishdate", type="datetime", nullable=false)
     */
    private $finishdate;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $provider;

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="supervisor_id", referencedColumnName="id")
     */
    private $supervisor;

    /**
     * @return mixed
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * @param mixed $supervisor
     */
    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * @return string
     */
    public function getMonitor()
    {
        return $this->monitor;
    }

    /**
     * @param string $monitor
     */
    public function setMonitor($monitor)
    {
        $this->monitor = $monitor;
    }



    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="monitor_id", referencedColumnName="id")
     */
    private $monitor;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;
    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer",nullable=true)
     */
    private $status;

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Affectation", inversedBy="products")
     * @ORM\JoinColumn(name="affectation_id", referencedColumnName="id")
     */
    private $affectation;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Internship
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set finishdate
     *
     * @param \DateTime $finishdate
     *
     * @return Internship
     */
    public function setFinishdate($finishdate)
    {
        $this->finishdate = $finishdate;

        return $this;
    }

    /**
     * Get finishdate
     *
     * @return \DateTime
     */
    public function getFinishdate()
    {
        return $this->finishdate;
    }



    /**
     * Set affectation
     *
     * @param \UserBundle\Entity\Affectation $affectation
     *
     * @return Internship
     */
    public function setAffectation(\UserBundle\Entity\Affectation $affectation = null)
    {
        $this->affectation = $affectation;

        return $this;
    }

    /**
     * Get affectation
     *
     * @return \UserBundle\Entity\Affectation
     */
    public function getAffectation()
    {
        return $this->affectation;
    }
}
