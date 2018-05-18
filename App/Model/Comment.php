<?php
namespace App\Model;

class Comment extends Entity
{
    private $postId;
    private $author;
    private $content;
    private $dateAdded;
    private $flag;

    const AUTHOR_INVALID = 1;
    const CONTENT_INVALID = 2;

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

    public function setPostId($postId)
    {
        $postId = (int) $postId;

        if ($postId > 0) {
            $this->postId = $postId;
        }
    }

    public function setAuthor($author)
    {
        if (is_string($author) && !empty($author)) {
            $this->author = $author;
        } else {
            $this->errors[] = self::AUTHOR_INVALID;
        }
    }

    public function setContent($content)
    {
        if (is_string($content) && !empty($content)) {
            $this->content = $content;
        } else {
            $this->errors[] = self::CONTENT_INVALID;
        }
    }

    public function setDateAdded(DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    public function setFlag($flag)
    {
        $this->flag = (int) $flag;
    }
}
