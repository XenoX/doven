<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Carousel
 *
 * @ORM\Table(name="carousel")
 * @ORM\Entity(repositoryClass="App\Repository\CarouselRepository")
 * @Vich\Uploadable
 */
class Carousel
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="link", type="text", nullable=true)
     */
    private $link;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
    */
    private $image;

    /**
     * @var integer
     * @Assert\Type("int")
     * @Assert\NotNull()
     * @ORM\Column(name="sort", type="smallint")
     */
    private $sort;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @Assert\NotNull()
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var \DateTime
     * @Assert\NotNull()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @Vich\UploadableField(mapping="carousel_images", fileNameProperty="image")
     */
    public $imageFile;

    /**
     * Carousel constructor.
     */
    public function __construct() {
        $this->sort = 0;
        $this->enabled = true;
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return null|string
     */
    public function __toString(): ?string
    {
        return $this->title;
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string|null $title
     *
     * @return Carousel
     */
    public function setTitle(string $title = null): Carousel
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string|null $content
     *
     * @return Carousel
     */
    public function setContent(string $content = null): Carousel
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set link
     *
     * @param string|null $link
     *
     * @return Carousel
     */
    public function setLink(string $link = null): Carousel
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * Set image
     *
     * @param string|null $image
     *
     * @return Carousel
     */
    public function setImage(string $image = null): Carousel
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }


    /**
     * Set sort
     *
     * @param int $sort
     *
     * @return Carousel
     */
    public function setSort(int $sort): Carousel
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Carousel
     */
    public function setEnabled(bool $enabled): Carousel
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Carousel
     */
    public function setUpdatedAt(\DateTime $updatedAt): Carousel
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param File|null $image
     *
     * @return Carousel
     */
    public function setImageFile(File $image = null): Carousel
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return 'uploads/carousel/'. $this->image;
    }
}
