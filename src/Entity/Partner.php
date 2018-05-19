<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 * @Vich\Uploadable
 */
class Partner
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
     * @Assert\NotNull()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @Assert\NotNull()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @Assert\NotNull()
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @Vich\UploadableField(mapping="partner_images", fileNameProperty="image")
     */
    public $imageFile;

    /**
     * Partner constructor.
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->enabled = true;
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Partner
     */
    public function setName(string $name): Partner
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string|null $image
     *
     * @return Partner
     */
    public function setImage(string $image = null): Partner
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
     * Set description
     *
     * @param string|null $description
     *
     * @return Partner
     */
    public function setDescription(string $description = null): Partner
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set website
     *
     * @param string|null $website
     *
     * @return Partner
     */
    public function setWebsite(string $website = null): Partner
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Partner
     */
    public function setUpdatedAt(\DateTime $updatedAt): Partner
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set twitter
     *
     * @param string|null $twitter
     *
     * @return Partner
     */
    public function setTwitter(string $twitter = null): Partner
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string|null
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string|null $facebook
     *
     * @return Partner
     */
    public function setFacebook(string $facebook = null): Partner
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string|null
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Partner
     */
    public function setEnabled(bool $enabled): Partner
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
     * @param File|null $image
     *
     * @return Partner
     */
    public function setImageFile(File $image = null): Partner
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return 'uploads/partner/'. $this->image;
    }
}
