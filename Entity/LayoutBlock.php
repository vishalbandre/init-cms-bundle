<?php

namespace Networking\InitCmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Networking\InitCmsBundle\Entity\Page;
use Networking\InitCmsBundle\Entity\ContentInterface;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Exclude;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\XmlList;
use JMS\SerializerBundle\Annotation\XmlMap;

/**
 * Networking\InitCmsBundle\Entity\LayoutBlock
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="layout_block")
 * @ORM\Entity(repositoryClass="Networking\InitCmsBundle\Entity\LayoutBlockRepository")
 *
 * @ExclusionPolicy("none")
 */
class LayoutBlock implements ContentInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Type("string")
     */
    protected $name;

    /**
     * @var string $zone
     * @ORM\Column(name="zone", type="string")
     * @Type("string")
     */
    protected $zone;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="layoutBlock", cascade={"all"})
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @Exclude
     */
    protected $page;

    /**
     * @var string $classType
     *
     * @ORM\Column(name="class_type", type="string")
     * @Type("string")
     */
    protected $classType;

    /**
     * @var int $objectId
     *
     * @ORM\Column(name="object_id", type="integer", nullable=true)
     * @Type("integer")
     */
    protected $objectId;

    /**
     * @var boolean $isActive
     * @ORM\Column(name="is_active", type="boolean")
     * @Type("integer")
     */
    protected $isActive = true;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Type("DateTime")
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Type("DateTime")
     */
    protected $updatedAt;

    /**
     * @var integer $sortOrder
     * @ORM\Column(name="sort_order", type="integer", nullable=true)
     * @Type("integer")
     */
    protected $sortOrder;

    /**
     * @var array $content
     * @Exclude
     */
    protected $content = array();

    /**
     * @var string $oldClassType
     * @Type("string")
     */
    protected $origClassType;

    /**
     * @var boolean $isSnapshot
     * @Type("boolean")
     */
    protected $isSnapshot = false;

    /**
     * @var array $snapshotContent
     * @Type("ArrayCollection")
     */
    protected $snapshotContent;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = $this->updatedAt = new \DateTime("now");
    }

    /**
     * Hook on pre-update operations
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param  string      $name
     * @return LayoutBlock
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set zone
     *
     * @param  string      $zone
     * @return LayoutBlock
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set page
     *
     * @param  Page        $page
     * @return LayoutBlock
     */
    public function setPage(Page $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get conversation
     *
     * @return Page
     */
    public function getPageId()
    {
        return $this->page->getId();
    }

    /**
     * @param  string      $classType
     * @return LayoutBlock
     */
    public function setClassType($classType)
    {
        if ($classType != $this->classType) {
            $this->origClassType = $this->classType;
        }
        $this->classType = $classType;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassType()
    {
        return $this->classType;
    }

    /**
     * @return string
     */
    public function getOrigClassType()
    {
        return $this->origClassType;
    }

    /**
     * @param  int         $objectId
     * @return LayoutBlock
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return int
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set isActive
     *
     * @param  boolean     $active
     * @return LayoutBlock
     */
    public function setIsActive($active)
    {
        $active = $active ? true : false;
        $this->isActive = $active;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Alias for getIsActive
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Set createdAt
     *
     * @return LayoutBlock
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime   $updatedAt
     * @return LayoutBlock
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param  int         $sortOrder
     * @return LayoutBlock
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     * @param  null        $key
     * @return LayoutBlock
     */
    public function setContent($content, $key = null)
    {
        if (!is_array($content) || !is_null($key)) {
            $this->content[$key] = $content;

            return $this;
        }

        foreach ($content as $key => $data) {
            $this->content[$key] = $data;
        }

        return $this;

    }

    /**
     * @param boolean $isSnapshot
     */
    public function setIsSnapshot($isSnapshot)
    {
        $this->isSnapshot = $isSnapshot;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsSnapshot()
    {
        return $this->isSnapshot;
    }

    /**
     * @param array $snapshotContent
     */
    public function setSnapshotContent($snapshotContent)
    {
        $this->snapshotContent = $snapshotContent;

        return $this;
    }

    /**
     * @return array
     */
    public function getSnapshotContent()
    {
        return $this->snapshotContent[0];
    }

    public function getTemplateOptions()
    {
        return false;
    }

    public static function getFieldDefinition()
    {
        return false;
    }

    public function getAdminContent()
    {
        return false;
    }

    public function takeSnapshot($content)
    {
        if (!is_array($content)) {
            $content = array($content);
        }
        $this->isSnapshot = true;
        $this->snapshotContent = new \Doctrine\Common\Collections\ArrayCollection($content);
    }
}