<?php
// src/Blogger/BlogBundle/Entity/Author.php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\AuthorRepository")
 * @ORM\Table(name="author")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nom;

    /**
     * @ORM\Column(type="string")
     */
    protected $cognom;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dataNaixement;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dataAlta;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $foto;

    /**
     * @ORM\Column(type="text")
     */
    protected $descripcio;

    /**
     * One Author has Many Blogs.
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="autor")
     */
    protected $blogs;

    public function __construct() {
        $this->blogs = new ArrayCollection();
    }


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Author
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
     * Set cognom
     *
     * @param string $cognom
     *
     * @return Author
     */
    public function setCognom($cognom)
    {
        $this->cognom = $cognom;

        return $this;
    }

    /**
     * Get cognom
     *
     * @return string
     */
    public function getCognom()
    {
        return $this->cognom;
    }

    /**
     * Set dataNaixement
     *
     * @param \DateTime $dataNaixement
     *
     * @return Author
     */
    public function setDataNaixement($dataNaixement)
    {
        $this->dataNaixement = $dataNaixement;

        return $this;
    }

    /**
     * Get dataNaixement
     *
     * @return \DateTime
     */
    public function getDataNaixement()
    {
        return $this->dataNaixement;
    }

    /**
     * Set dataAlta
     *
     * @param \DateTime $dataAlta
     *
     * @return Author
     */
    public function setDataAlta($dataAlta)
    {
        $this->dataAlta = $dataAlta;

        return $this;
    }

    /**
     * Get dataAlta
     *
     * @return \DateTime
     */
    public function getDataAlta()
    {
        return $this->dataAlta;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Author
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set descripcio
     *
     * @param string $descripcio
     *
     * @return Author
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    /**
     * Get descripcio
     *
     * @return string
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * Add blog
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blog
     *
     * @return Author
     */
    public function addBlog(\Blogger\BlogBundle\Entity\Blog $blog)
    {
        $this->blogs[] = $blog;

        return $this;
    }

    /**
     * Remove blog
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blog
     */
    public function removeBlog(\Blogger\BlogBundle\Entity\Blog $blog)
    {
        $this->blogs->removeElement($blog);
    }

    /**
     * Get blogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogs()
    {
        return $this->blogs;
    }
}
