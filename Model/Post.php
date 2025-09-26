<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use EricMartinez\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel implements PostInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(\EricMartinez\Blog\Model\ResourceModel\Post::class);
    }

    public function getId()
    {
        return $this->getData(self::POST_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::POST_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getPostId(): ?int
    {
        return (int)$this->getData(self::POST_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setPostId(int $postId): PostInterface
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle(string $title): PostInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent(string $content): PostInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoverImage(): ?string
    {
        return $this->getData(self::COVER_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setCoverImage(string $coverImage): PostInterface
    {
        return $this->setData(self::COVER_IMAGE, $coverImage);
    }

    public function getIsActive()
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    public function getAdminUserId()
    {
        return $this->getData(self::ADMIN_USER_ID);
    }

    public function setAdminUserId($adminUserId)
    {
        return $this->setData(self::ADMIN_USER_ID, $adminUserId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): PostInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(string $updatedAt): PostInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
