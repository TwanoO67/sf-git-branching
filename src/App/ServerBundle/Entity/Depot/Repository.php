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
     * @ORM\Column(name="repo", type="string", length=255)
     */
    private $repo;


    /* Placement du semaphore autopuller */
    public function getAutoPullerPath(){
      return $this->path."/.git/git_autopuller";
    }

    public function setAutoPuller($value = "on", &$code = 0){
        $reponse = array();
        if(chdir($this->path)){
            //on place le fichier pour le pull automatique
            if($value == "on"){
                file_put_contents($this->getAutoPullerPath(), '');
            }
            //sinon on le supprime
            elseif(file_exists($this->getAutoPullerPath())){
                unlink($this->getAutoPullerPath());
            }
        }
        return $reponse;
    }

    public function getAutoPuller(){
        return file_exists($this->getAutoPullerPath());
    }
    /* FIN - Placement du semaphore autopuller */








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
     * Set repo
     *
     * @param array $repo
     * @return Repository
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * Get repo
     *
     * @return array
     */
    public function getRepo()
    {
        return $this->repo;
    }
}
