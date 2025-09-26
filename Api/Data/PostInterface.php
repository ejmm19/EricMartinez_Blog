<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Api\Data;

interface PostInterface
{
    const POST_ID = 'post_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const COVER_IMAGE = 'cover_image';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const URL_KEY = 'url_key';
    const IS_ACTIVE = 'is_active';
    const CUSTOMER_ID = 'customer_id';
    const ADMIN_USER_ID = 'admin_user_id';

    /**
     * Get post ID.
     *
     * @return int|null
     */
    public function getPostId(): ?int;

    /**
     * Set post ID.
     *
     * @param int $postId
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setPostId(int $postId): PostInterface;

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Set title.
     *
     * @param string $title
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setTitle(string $title): PostInterface;

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * Set content.
     *
     * @param string $content
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setContent(string $content): PostInterface;

    /**
     * Get cover image.
     *
     * @return string|null
     */
    public function getCoverImage(): ?string;

    /**
     * Set cover image.
     *
     * @param string $coverImage
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setCoverImage(string $coverImage): PostInterface;

    /**
     * Get created at.
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set created at.
     *
     * @param string $createdAt
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setCreatedAt(string $createdAt): PostInterface;

    /**
     * Get updated at.
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set updated at.
     *
     * @param string $updatedAt
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setUpdatedAt(string $updatedAt): PostInterface;

    /**
     * Get URL Key.
     *
     * @return string|null
     */
    public function getUrlKey(): ?string;

    /**
     * Set URL Key.
     *
     * @param string $urlKey
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setUrlKey(string $urlKey): PostInterface;

    /**
     * Get is active.
     *
     * @return bool|null
     */
    public function getIsActive(): ?bool;

    /**
     * Set is active.
     *
     * @param bool $isActive
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setIsActive(bool $isActive): PostInterface;

    /**
     * Get customer ID.
     *
     * @return int|null
     */
    public function getCustomerId(): ?int;

    /**
     * Set customer ID.
     *
     * @param int $customerId
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setCustomerId(int $customerId): PostInterface;

    /**
     * Get admin user ID.
     *
     * @return int|null
     */
    public function getAdminUserId(): ?int;

    /**
     * Set admin user ID.
     *
     * @param int $adminUserId
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     */
    public function setAdminUserId(int $adminUserId): PostInterface;
}