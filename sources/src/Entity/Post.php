<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @var $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var $name
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var $description
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var $published_at
     * @ORM\Column(type="date")
     */
    private $published_at;

    /**
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->published_at;
    }

    /**
     * @param \DateTimeInterface $published_at
     * @return $this
     */
    public function setPublishedAt(\DateTimeInterface $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }
}
