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
}