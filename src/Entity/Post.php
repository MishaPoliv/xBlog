<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DatePublic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Caption;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $xText;

    public function __construct()
    {

        $this->DatePublic = new \DateTime();

    }

    public function getId()
    {
        return $this->id;
    }

    public function getDatePublic(): ?\DateTimeInterface
    {
        return $this->DatePublic;
    }

    public function setDatePublic(\DateTimeInterface $DatePublic): self
    {
        $this->DatePublic = $DatePublic;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->Caption;
    }

    public function setCaption(?string $Caption): self
    {
        $this->Caption = $Caption;

        return $this;
    }

    public function getXText(): ?string
    {
        return $this->xText;
    }

    public function setXText(?string $xText): self
    {
        $this->xText = $xText;

        return $this;
    }

    public function __toString()
    {
       return $this->DatePublic;
    }


}
