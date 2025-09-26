<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Api\Data;

interface CommentInterface
{
    const COMMENT_ID = 'comment_id';
    const POST_ID = 'post_id';
    const CUSTOMER_ID = 'customer_id';
    const GUEST_NAME = 'guest_name';
    const GUEST_EMAIL = 'guest_email';
    const CONTENT = 'content';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';

    public function getCommentId(): ?int;
    public function setCommentId(int $commentId): CommentInterface;

    public function getPostId(): ?int;
    public function setPostId(int $postId): CommentInterface;

    public function getCustomerId(): ?int;
    public function setCustomerId(int $customerId): CommentInterface;

    public function getGuestName(): ?string;
    public function setGuestName(string $guestName): CommentInterface;

    public function getGuestEmail(): ?string;
    public function setGuestEmail(string $guestEmail): CommentInterface;

    public function getContent(): ?string;
    public function setContent(string $content): CommentInterface;

    public function getStatus(): ?int;
    public function setStatus(int $status): CommentInterface;

    public function getCreatedAt(): ?string;
    public function setCreatedAt(string $createdAt): CommentInterface;
}
