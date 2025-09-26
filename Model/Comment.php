<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use EricMartinez\Blog\Api\Data\CommentInterface;
use Magento\Framework\Model\AbstractModel;

class Comment extends AbstractModel implements CommentInterface
{
    protected function _construct(): void
    {
        $this->_init(\EricMartinez\Blog\Model\ResourceModel\Comment::class);
    }

    public function getCommentId(): ?int
    {
        $value = $this->getData(CommentInterface::COMMENT_ID);
        return $value === null ? null : (int)$value;
    }

    public function setCommentId(int $commentId): CommentInterface
    {
        return $this->setData(CommentInterface::COMMENT_ID, $commentId);
    }

    public function getPostId(): ?int
    {
        $value = $this->getData(CommentInterface::POST_ID);
        return $value === null ? null : (int)$value;
    }

    public function setPostId(int $postId): CommentInterface
    {
        return $this->setData(CommentInterface::POST_ID, $postId);
    }

    public function getCustomerId(): ?int
    {
        $value = $this->getData(CommentInterface::CUSTOMER_ID);
        return $value === null ? null : (int)$value;
    }

    public function setCustomerId(int $customerId): CommentInterface
    {
        return $this->setData(CommentInterface::CUSTOMER_ID, $customerId);
    }

    public function getGuestName(): ?string
    {
        return $this->getData(CommentInterface::GUEST_NAME);
    }

    public function setGuestName(string $guestName): CommentInterface
    {
        return $this->setData(CommentInterface::GUEST_NAME, $guestName);
    }

    public function getGuestEmail(): ?string
    {
        return $this->getData(CommentInterface::GUEST_EMAIL);
    }

    public function setGuestEmail(string $guestEmail): CommentInterface
    {
        return $this->setData(CommentInterface::GUEST_EMAIL, $guestEmail);
    }

    public function getContent(): ?string
    {
        return $this->getData(CommentInterface::CONTENT);
    }

    public function setContent(string $content): CommentInterface
    {
        return $this->setData(CommentInterface::CONTENT, $content);
    }

    public function getStatus(): ?int
    {
        $value = $this->getData(CommentInterface::STATUS);
        return $value === null ? null : (int)$value;
    }

    public function setStatus(int $status): CommentInterface
    {
        return $this->setData(CommentInterface::STATUS, $status);
    }

    public function getCreatedAt(): ?string
    {
        return $this->getData(CommentInterface::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt): CommentInterface
    {
        return $this->setData(CommentInterface::CREATED_AT, $createdAt);
    }
}
