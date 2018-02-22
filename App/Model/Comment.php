<?php

class Comment
{
    private $id,
            $postId,
            $author,
            $content,
            $dateAdded;

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    // GETTERS
    
    public function getId()
    {
        return $this->id;
    }

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

    public function setId($id)
    {
        if ($id > 0 && is_int($id))
        {
            $this->id = $id;
        }
    }
    
    public function setPostId($postId)
    {
        if ($id > 0 && is_int($postId))
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

}
