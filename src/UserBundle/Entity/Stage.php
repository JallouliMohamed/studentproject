<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stage
 *
 * @ORM\Table(name="stage")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\StageRepository")
 */
class Stage
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
     * @var string
     *
     * @ORM\Column(name="entreprise", type="string", length=255, nullable=true)
     */
    private $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="monitor", type="string", length=255)
     */
    private $monitor;

    /**
     * @var string
     *
     * @ORM\Column(name="proffesor", type="string", length=255)
     */
    private $proffesor;

    /**
     * @var string
     *
     * @ORM\Column(name="student", type="string", length=255)
     */
    private $student;


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
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Stage
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set monitor
     *
     * @param string $monitor
     *
     * @return Stage
     */
    public function setMonitor($monitor)
    {
        $this->monitor = $monitor;

        return $this;
    }

    /**
     * Get monitor
     *
     * @return string
     */
    public function getMonitor()
    {
        return $this->monitor;
    }

    /**
     * Set proffesor
     *
     * @param string $proffesor
     *
     * @return Stage
     */
    public function setProffesor($proffesor)
    {
        $this->proffesor = $proffesor;

        return $this;
    }

    /**
     * Get proffesor
     *
     * @return string
     */
    public function getProffesor()
    {
        return $this->proffesor;
    }

    /**
     * Set student
     *
     * @param string $student
     *
     * @return Stage
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return string
     */
    public function getStudent()
    {
        return $this->student;
    }
}

