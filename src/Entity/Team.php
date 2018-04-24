<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @Vich\Uploadable
 */
class Team
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
     * @ORM\Column(name="game", type="string", length=255, nullable=true)
     */
    private $game;

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
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var int
     * @Assert\Type("int")
     * @Assert\NotNull()
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TeamMember", mappedBy="team", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    private $members;

    /**
     * @Vich\UploadableField(mapping="team_images", fileNameProperty="image")
     */
    public $imageFile;

    /**
     * Team constructor.
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->enabled = true;
        $this->sort = 0;
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
     * @return Team
     */
    public function setName(string $name): Team
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
     * Set game
     *
     * @param string|null $game
     *
     * @return Team
     */
    public function setGame(string $game = null): Team
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return string|null
     */
    public function getGame(): ?string
    {
        return $this->game;
    }

    /**
     * Set image
     *
     * @param string|null $image
     *
     * @return Team
     */
    public function setImage(string $image = null): Team
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
     * @return Team
     */
    public function setDescription(string $description = null): Team
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
     * Set createdAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Team
     */
    public function setUpdatedAt(\DateTime $updatedAt): Team
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
     * @return Team
     */
    public function setEnabled(bool $enabled): Team
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
     * Add member
     *
     * @param TeamMember $member
     *
     * @return Team
     */
    public function addMember(TeamMember $member): Team
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param TeamMember $member
     */
    public function removeMember(TeamMember $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return Collection
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * Set sort
     *
     * @param int $sort
     *
     * @return Team
     */
    public function setSort(int $sort): Team
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
     * @return Team
     */
    public function setImageFile(File $image = null): Team
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
