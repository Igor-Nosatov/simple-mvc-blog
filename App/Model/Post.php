<?php
namespace App\Model;

class Post extends Entity
{
    private $title;
    private $content;
    private $dateAdded;
    private $dateModified;

    public function excerpt(int $length) : string
    {
        $excerpt = substr($this->content, 0, $length);
        $excerpt .= '...';

        return $excerpt;
    }

    // GETTERS
    
    public function getTitle()
    {
        return $this->title;
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

    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }

    public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = $content;
        }
    }

    public function setDateAdded(DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    public function setDateModified(DateTime $dateModified)
    {
        $this->dateModified = $dateModified;
    }
}
