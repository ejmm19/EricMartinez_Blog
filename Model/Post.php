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
        return $this->getData(PostInterface::POST_ID);
    }

    public function setId($id)
    {
        return $this->setData(PostInterface::POST_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getPostId(): ?int
    {
        $value = $this->getData(PostInterface::POST_ID);
        return $value === null ? null : (int)$value;
    }

    /**
     * {@inheritdoc}
     */
    public function setPostId(int $postId): PostInterface
    {
        return $this->setData(PostInterface::POST_ID, $postId);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): ?string
    {
        return $this->getData(PostInterface::TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle(string $title): PostInterface
    {
        return $this->setData(PostInterface::TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): ?string
    {
        return $this->getData(PostInterface::CONTENT);
    }

    public function setContent(string $content): PostInterface
    {
        return $this->setData(PostInterface::CONTENT, $content);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoverImage(): ?string
    {
        return $this->getData(PostInterface::COVER_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setCoverImage(string $coverImage): PostInterface
    {
        return $this->setData(PostInterface::COVER_IMAGE, $coverImage);
    }

    public function getIsActive(): ?bool
    {
        return (bool)$this->getData(PostInterface::IS_ACTIVE);
    }

    public function setIsActive(bool $isActive): PostInterface
    {
        return $this->setData(PostInterface::IS_ACTIVE, $isActive);
    }

    public function getCustomerId(): ?int
    {
        $value = $this->getData(PostInterface::CUSTOMER_ID);
        return $value === null ? null : (int)$value;
    }

    public function setCustomerId(int $customerId): PostInterface
    {
        return $this->setData(PostInterface::CUSTOMER_ID, $customerId);
    }

    public function getAdminUserId(): ?int
    {
        $value = $this->getData(PostInterface::ADMIN_USER_ID);
        return $value === null ? null : (int)$value;
    }

    public function setAdminUserId(int $adminUserId): PostInterface
    {
        return $this->setData(PostInterface::ADMIN_USER_ID, $adminUserId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(PostInterface::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): PostInterface
    {
        return $this->setData(PostInterface::CREATED_AT, $createdAt);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(PostInterface::UPDATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(string $updatedAt): PostInterface
    {
        return $this->setData(PostInterface::UPDATED_AT, $updatedAt);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlKey(): ?string
    {
        return $this->getData(PostInterface::URL_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function setUrlKey(string $urlKey): PostInterface
    {
        return $this->setData(PostInterface::URL_KEY, $urlKey);
    }
}
