<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Stream
 *
 * @ORM\Table(name="stream")
 * @ORM\Entity(repositoryClass="App\Repository\StreamRepository")
 * @Vich\Uploadable
 */
class Stream
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="game", type="string", length=255, nullable=true)
     */
    private $game;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="stream_name", type="string", length=255, nullable=true)
     */
    private $streamName;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="twitch", type="string", length=255)
     */
    private $twitch;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="main", type="boolean")
     */
    private $main;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="live", type="boolean")
     */
    private $live;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="checked_at", type="datetime")
     */
    private $checkedAt;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @Vich\UploadableField(mapping="stream_images", fileNameProperty="image")
     */
    public $imageFile;

    /**
     * Stream constructor.
     */
    public function __construct()
    {
        $this->main = false;
        $this->live = false;
        $this->updatedAt = new \DateTime();
        $this->checkedAt = new \DateTime('-5 minutes');
        $this->enabled = true;
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
     * @return integer|null
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
     * @return Stream
     */
    public function setName(string $name): Stream
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
     * Set title
     *
     * @param string|null $title
     *
     * @return Stream
     */
    public function setTitle(string $title = null): Stream
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
     * Set game
     *
     * @param string|null $game
     *
     * @return Stream
     */
    public function setGame(string $game = null): Stream
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
     * Set streamName
     *
     * @param string|null $streamName
     *
     * @return Stream
     */
    public function setStreamName(string $streamName = null): Stream
    {
        $this->streamName = $streamName;

        return $this;
    }

    /**
     * Get streamName
     *
     * @return string|null
     */
    public function getStreamName(): ?string
    {
        return $this->streamName;
    }

    /**
     * Set image
     *
     * @param string|null $image
     *
     * @return Stream
     */
    public function setImage(string $image = null): Stream
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
     * Set twitch
     *
     * @param string|null $twitch
     *
     * @return Stream
     */
    public function setTwitch(string $twitch = null): Stream
    {
        $this->twitch = $twitch;

        return $this;
    }

    /**
     * Get twitch
     *
     * @return string|null
     */
    public function getTwitch(): ?string
    {
        return $this->twitch;
    }

    /**
     * Set main
     *
     * @param bool $main
     *
     * @return Stream
     */
    public function setMain(bool $main): Stream
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return bool
     */
    public function getMain(): bool
    {
        return $this->main;
    }

    /**
     * Set live
     *
     * @param bool $live
     *
     * @return Stream
     */
    public function setLive(bool $live): Stream
    {
        $this->live = $live;

        return $this;
    }

    /**
     * Get live
     *
     * @return bool
     */
    public function getLive(): bool
    {
        return $this->live;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Stream
     */
    public function setUpdatedAt(\DateTime $updatedAt): Stream
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
     * Set checkedAt
     *
     * @param \DateTime $checkedAt
     *
     * @return Stream
     */
    public function setCheckedAt(\DateTime $checkedAt): Stream
    {
        $this->checkedAt = $checkedAt;

        return $this;
    }

    /**
     * Get checkedAt
     *
     * @return \DateTime
     */
    public function getCheckedAt(): \DateTime
    {
        return $this->checkedAt;
    }

    /**
     * Set enabled
     *
     * @param bool $enabled
     *
     * @return Stream
     */
    public function setEnabled(bool $enabled): Stream
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
     * @return Stream
     */
    public function setImageFile(File $image = null): Stream
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
