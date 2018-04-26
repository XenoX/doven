<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * TeamMember
 *
 * @ORM\Table(name="team_member")
 * @ORM\Entity(repositoryClass="App\Repository\TeamMemberRepository")
 * @Vich\Uploadable
 */
class TeamMember
{
    /**
     * @var int
     *
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
     * @ORM\Column(name="position", type="string", length=255, nullable=true)
     */
    private $position;

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
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var int
     * @Assert\Type("int")
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @Vich\UploadableField(mapping="team_member_images", fileNameProperty="image")
     */
    public $imageFile;

    /**
     * TeamMember constructor.
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->enabled = true;
        $this->sort = 0;
    }

    /**
     * @return string
     */
    public function __toString(): string
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
     * @return TeamMember
     */
    public function setName(string $name): TeamMember
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
     * Set position
     *
     * @param string|null $position
     *
     * @return TeamMember
     */
    public function setPosition(string $position = null): TeamMember
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * Set image
     *
     * @param string|null $image
     *
     * @return TeamMember
     */
    public function setImage(string $image = null): TeamMember
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
     * @return TeamMember
     */
    public function setDescription(string $description = null): TeamMember
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
     * Set twitter
     *
     * @param string|null $twitter
     *
     * @return TeamMember
     */
    public function setTwitter(string $twitter = null): TeamMember
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
     * @param string $facebook|null
     *
     * @return TeamMember
     */
    public function setFacebook(string $facebook = null): TeamMember
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
     * Set createdAt
     *
     * @param \DateTime $updatedAt
     *
     * @return TeamMember
     */
    public function setUpdatedAt(\DateTime $updatedAt): TeamMember
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return TeamMember
     */
    public function setEnabled(bool $enabled): TeamMember
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
     * Set team
     *
     * @param Team $team
     *
     * @return TeamMember
     */
    public function setTeam(Team $team): TeamMember
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return Team|null
     */
    public function getTeam(): ?Team
    {
        return $this->team;
    }

    /**
     * Set sort
     *
     * @param int $sort
     *
     * @return TeamMember
     */
    public function setSort(int $sort): TeamMember
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
     * @param File|null $image
     *
     * @return TeamMember
     */
    public function setImageFile(File $image = null): TeamMember
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
}
