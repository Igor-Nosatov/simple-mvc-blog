<?php

namespace App\Model;

class Flash
{
    private $type,
            $message;

    public function set(string $message, string $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        
        $_SESSION['flash'] = [
            'message' => $this->message,
            'type' => $this->type
        ];
    }

    public function hasMessage() : bool
    {
        return isset($_SESSION['flash']);
    }

    public function get() : string
    {
        $flash = $_SESSION['flash'];

        $html = '<div class="alert alert-' . $flash['type'] .' alert-dismissible fade show">';
        $html .= $flash['message'];
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        $html .= '<span aria-hidden="true">&times;</span>';
        $html .= '</button>';
        $html .= '</div>';
            
        unset($_SESSION['flash']);

        return $html;
    }
}
