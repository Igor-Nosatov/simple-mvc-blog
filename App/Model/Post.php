<?php

require_once('App/Model/Entity.php');

class Post extends Entity
{
    private $title,
            $content,
            $dateAdded;

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
        if (is_string($title))
        {
            $this->title = $title;
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
}
