<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ORM\Table("blog_post")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"default"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title = " ";

    /**
     * @ORM\Column(type="text")
     */
    private string $content = " ";

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $online = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $slug = " ";

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(onDelete="SET NULL")
     * @Groups({"default"})
     */
    private User $author ;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryBlog", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private CategoryBlog $category;

    /**
     * @ORM\OneToMany(targetEntity=CommentBlog::class, mappedBy="post")
     */
    private $commentBlogs;

    public function __construct()
    {
        $this->commentBlogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAuthor(): ?user
    {
        return $this->author;
    }

    public function setAuthor(?user $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?categoryBlog
    {
        return $this->category;
    }

    public function setCategory(?CategoryBlog $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|CommentBlog[]
     */
    public function getCommentBlogs(): \Doctrine\Common\Collections\Collection
    {
        return $this->commentBlogs;
    }

    public function addCommentBlog(CommentBlog $commentBlog): self
    {
        if (!$this->commentBlogs->contains($commentBlog)) {
            $this->commentBlogs[] = $commentBlog;
            $commentBlog->setPost($this);
        }

        return $this;
    }

    public function removeCommentBlog(CommentBlog $commentBlog): self
    {
        if ($this->commentBlogs->contains($commentBlog)) {
            $this->commentBlogs->removeElement($commentBlog);
            // set the owning side to null (unless already changed)
            if ($commentBlog->getPost() === $this) {
                $commentBlog->setPost(null);
            }
        }

        return $this;
    }
}
