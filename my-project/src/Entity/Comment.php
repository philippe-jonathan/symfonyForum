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
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="fkcomment")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="commentaire")
     */
    private $fkComment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="fkComment")
     */
    private $commentaire;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFkcomment($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getFkcomment() === $this) {
                $comment->setFkcomment(null);
            }
        }

        return $this;
    }

    public function getFkComment(): ?self
    {
        return $this->fkComment;
    }

    public function setFkComment(?self $fkComment): self
    {
        $this->fkComment = $fkComment;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(self $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setFkComment($this);
        }

        return $this;
    }

    public function removeCommentaire(self $commentaire): self
    {
        if ($this->commentaire->contains($commentaire)) {
            $this->commentaire->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFkComment() === $this) {
                $commentaire->setFkComment(null);
            }
        }

        return $this;
    }
}
