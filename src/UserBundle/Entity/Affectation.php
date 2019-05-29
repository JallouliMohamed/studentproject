<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AffectationRepository")
 */
class Affectation
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $who;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @ORM\JoinColumn(name="monitor", referencedColumnName="id")
     */
    private $monitor;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @ORM\JoinColumn(name="prof_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * @return mixed
     */
    public function getMonitor()
    {
        return $this->monitor;
    }

    /**
     * @param mixed $monitor
     */
    public function setMonitor($monitor)
    {
        $this->monitor = $monitor;
    }

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Entreprise", inversedBy="products")
     * @ORM\JoinColumn(name="entreprise_id", referencedColumnName="id")
     */
    private $entrepriseid;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer",nullable=true)
     */
    private $status;
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;
    /**
     * @var string
     *
     * @ORM\Column(name="middlename", type="string", length=255)
     */
    private $middlename;
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;
    /**
     * @var string
     *
     * @ORM\Column(name="college", type="string", length=255)
     */
    private $college;

    /**
     * @return string
     */
    public function getCollege()
    {
        return $this->college;
    }

    /**
     * @param string $college
     */
    public function setCollege($college)
    {
        $this->college = $college;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="integer")
     */
    private $phone;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=255)
     */
    private $department;
    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;
    /**
     * @var string
     *
     * @ORM\Column(name="hours", type="integer")
     */
    private $hours;
    /**
     * @var string
     *
     * @ORM\Column(name="course", type="string", length=255)
     */
    private $course;

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
     * Set status
     *
     * @param integer $status
     *
     * @return Affectation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Affectation
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set middlename
     *
     * @param string $middlename
     *
     * @return Affectation
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename
     *
     * @return string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Affectation
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Affectation
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Affectation
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Affectation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set department
     *
     * @param string $department
     *
     * @return Affectation
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set level
     *
     * @param string $level
     *
     * @return Affectation
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     *
     * @return Affectation
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return integer
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set course
     *
     * @param string $course
     *
     * @return Affectation
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set who
     *
     * @param \UserBundle\Entity\User $who
     *
     * @return Affectation
     */
    public function setWho(\UserBundle\Entity\User $who = null)
    {
        $this->who = $who;

        return $this;
    }

    /**
     * Get who
     *
     * @return \UserBundle\Entity\User
     */
    public function getWho()
    {
        return $this->who;
    }

    /**
     * Set teacher
     *
     * @param \UserBundle\Entity\User $teacher
     *
     * @return Affectation
     */
    public function setTeacher(\UserBundle\Entity\User $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \UserBundle\Entity\User
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set entrepriseid
     *
     * @param \UserBundle\Entity\Entreprise $entrepriseid
     *
     * @return Affectation
     */
    public function setEntrepriseid(\UserBundle\Entity\Entreprise $entrepriseid = null)
    {
        $this->entrepriseid = $entrepriseid;

        return $this;
    }

    /**
     * Get entrepriseid
     *
     * @return \UserBundle\Entity\Entreprise
     */
    public function getEntrepriseid()
    {
        return $this->entrepriseid;
    }
}
