<?php

namespace App\ServerBundle\Entity\Depot;

use Doctrine\ORM\Mapping as ORM;

/**
 * Repository
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Repository
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="branching", type="boolean")
     */
    private $branching;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deploy_info", type="boolean")
     */
    private $deployInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="deploy_method", type="string", length=255)
     */
    private $deployMethod;

    /**
     * @var array
     *
     * @ORM\Column(name="env", type="array")
     */
    private $env;


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
     * Set path
     *
     * @param string $path
     * @return Repository
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Repository
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set branching
     *
     * @param boolean $branching
     * @return Repository
     */
    public function setBranching($branching)
    {
        $this->branching = $branching;

        return $this;
    }

    /**
     * Get branching
     *
     * @return boolean 
     */
    public function getBranching()
    {
        return $this->branching;
    }

    /**
     * Set deployInfo
     *
     * @param boolean $deployInfo
     * @return Repository
     */
    public function setDeployInfo($deployInfo)
    {
        $this->deployInfo = $deployInfo;

        return $this;
    }

    /**
     * Get deployInfo
     *
     * @return boolean 
     */
    public function getDeployInfo()
    {
        return $this->deployInfo;
    }

    /**
     * Set deployMethod
     *
     * @param string $deployMethod
     * @return Repository
     */
    public function setDeployMethod($deployMethod)
    {
        $this->deployMethod = $deployMethod;

        return $this;
    }

    /**
     * Get deployMethod
     *
     * @return string 
     */
    public function getDeployMethod()
    {
        return $this->deployMethod;
    }

    /**
     * Set env
     *
     * @param array $env
     * @return Repository
     */
    public function setEnv($env)
    {
        $this->env = $env;

        return $this;
    }

    /**
     * Get env
     *
     * @return array 
     */
    public function getEnv()
    {
        return $this->env;
    }
}
