<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateCom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nickname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $TextCom;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comment")
     */
    private $post;

    public function __construct()
    {
        $this->DateCom = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->DateCom;
    }

    public function setDateCom(\DateTimeInterface $DateCom): self
    {
        $this->DateCom = $DateCom;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->Nickname;
    }

    public function setNickname(?string $Nickname): self
    {
        $this->Nickname = $Nickname;

        return $this;
    }

    public function getTextCom(): ?string
    {
        return $this->TextCom;
    }

    public function setTextCom(?string $TextCom): self
    {
        $this->TextCom = $TextCom;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post): void
    {
        $this->post = $post;
    }



}
