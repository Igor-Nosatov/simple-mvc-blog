<?php
namespace App\Model;

require_once('App/Model/Entity.php');

class Comment extends Entity
{
    private $postId,
            $author,
            $content,
            $dateAdded,
            $flag;

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

        if ($postId > 0)
        {
            $this->postId = $postId;
        }
    }

    public function setAuthor($author)
    {
        if (is_string($author))
        {
            $this->author = $author;
        }
    }

    public function setContent($content)
    {
        if (is_string($content))
        {
            $this->content = $content;
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
