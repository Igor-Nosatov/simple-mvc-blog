<?php
namespace App\Controller;

use \App\Model\Post;
use \App\Model\Comment;
use \App\Router\HTTPRequest;

class Controller
{
    protected $postManager,
              $commentManager,
              $userManager,
              $httpResponse,
              $flash;

    public function __construct()
    {
        $this->postManager = new \App\Model\PostManager();
        $this->commentManager = new \App\Model\CommentManager();
        $this->userManager = new \App\Model\UserManager();
        $this->httpResponse = new \App\Router\HTTPResponse();
        $this->flash = new \App\Model\Flash();
    }

    protected function show(string $contentFile, array $vars = [])
    {
        $flash = $this->flash;

        extract($vars);

        ob_start();
        require($contentFile);
        $content = ob_get_clean();

        require('../App/View/template.php');
    }
}
