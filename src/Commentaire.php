<?php

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "commentaire")]

class Commentaire
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    protected $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    protected $auteur;
   
    #[ORM\Column(name: 'posted_at', type: 'datetime')]
    protected $date = NULL;

    #[ORM\Column(type: 'text')]
    protected $com;

    #[ORM\ManyToOne(targetEntity: Billet::class)]
    protected $billet;

    
    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getCom()
    {
        return $this->com;
    }

    public function setCom($com)
    {
        $this->com = $com;
    }

    public function getBillet()
    {
        return $this->billet;
    }

    public function setBillet($billet)
    {
        $this->billet = $billet;
    }

    
}