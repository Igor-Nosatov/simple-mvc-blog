<?php
namespace App\Model;

class Comment extends Entity
{
    private $postId;
    private $author;
    private $content;
    private $dateAdded;
    private $flag;

    private const AUTHOR_INVALID = 1;
    private const CONTENT_INVALID = 2;

    // GETTERS

    public function getPostId()
    {
        return $this->postId;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    // SETTERS

    public function setPostId($postId): void
    {
        $postId = (int) $postId;

        if ($postId > 0) {
            $this->postId = $postId;
        }
    }

    public function setAuthor($author): void
    {
        if (is_string($author) && !empty($author)) {
            $this->author = $author;
        } else {
            $this->errors[] = self::AUTHOR_INVALID;
        }
    }

    public function setContent($content): void
    {
        if (is_string($content) && !empty($content)) {
            $this->content = $content;
        } else {
            $this->errors[] = self::CONTENT_INVALID;
        }
    }

    public function setDateAdded(\DateTime $dateAdded): void
    {
        $this->dateAdded = $dateAdded;
    }

    public function setFlag($flag): void
    {
        $this->flag = (int) $flag;
    }
}
