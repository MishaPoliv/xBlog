<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
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

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comment;


    public function __construct()
    {
        $this->comment = new ArrayCollection();

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


    public function stringDate(){
        $stringDate = $this->getDatePublic()->format(DATE_RFC2822);
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setPost($this);

        }
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }



}
