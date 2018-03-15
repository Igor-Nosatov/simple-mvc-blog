<?php
namespace App\Model;

/**
 * Creates a paginated navigation using Twitter Bootstrap 
 */
class Paginator
{
    private $limit,
            $offset,
            $page,
            $postsTotal,
            $pagesTotal,
            $url;

    /**
     * @param string $url the url to paginate
     * @param integer|null $page the current page number
     * @param integer $limit the number of posts per page
     * @param integer $postsTotal the total number of posts
     */
    public function __construct(string $url, ?int $page, int $limit, int $postsTotal)
    {
        $this->page = $page ?? 1;
        $this->url = $url;
        $this->limit = $limit;
        $this->postsTotal = $postsTotal;
        $this->pagesTotal = $this->pagesTotal();
    }

    /**
     * Calculates the offset
     *
     * @return integer
     */
    public function offset() : int
    {
        return $this->limit * ($this->page -1);
    }

    /**
     * Calculates how many pages are needed
     *
     * @return integer
     */
    public function pagesTotal() : int
    {
        return ceil($this->postsTotal / $this->limit);
    }

    /**
     * Creates the previous button
     *
     * @return string the previous button html
     */
    public function previous() : string
    {
        $html = '';
        $previous = $this->page - 1;

        if ($this->page > 1)
        {
            $html .= '<li class="page-item">';
            $html .= '<a href="' . $this->url . '/' . $previous . '" class="page-link">Precedent</a>';
        }
        else
        {
            $html .= '<li class="page-item disabled">';
            $html .= '<a href="' . $this->url . '/' . $previous . '" class="page-link" tabindex="-1">Precedent</a>';
        }
        
        $html .= '</li>';
        
        return $html;
    }

    /**
     * Creates the next button
     *
     * @return string the next button html
     */
    public function next() : string
    {
        $html = '';
        $next = $this->page + 1;

        if ($this->page < $this->pagesTotal)
        {
            $html .= '<li class="page-item">';
            $html .= '<a href="' . $this->url . '/' . $next . '" class="page-link">Suivant</a>';
        }
        else
        {
            $html .= '<li class="page-item disabled">';
            $html .= '<a href="' . $this->url . '/' . $next . '" class="page-link" tabindex="-1">Suivant</a>';
        }
        
        $html .= '</li>';

        return $html;
    }

    /**
     * Creates the numbered pages links 
     *
     * @return string the pages links html
     */
    public function pages() : string
    {
        $html = '';

        for ($i = 1; $i < $this->pagesTotal + 1; $i++)
        {
            if ($i == $this->page)
            {
                $html .= '<li class="page-item active">';
            }
            else
            {
                $html .= '<li class="page-item">';
            }
            
            $html .= '<a href="' . $this->url . '/' . $i . '" class="page-link">' . $i . '</a>';
            $html .= '</li>';
        }
        
        return $html;
    }
}
