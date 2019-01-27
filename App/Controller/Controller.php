<?php
namespace App\Controller;

use \App\Model\PostManager;
use \App\Model\CommentManager;
use \App\Model\UserManager;
use \App\Router\HTTPResponse;
use \App\Model\Flash;

class Controller
{
    protected $postManager;
    protected $commentManager;
    protected $userManager;
    protected $httpResponse;
    protected $flash;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
        $this->httpResponse = new HTTPResponse();
        $this->flash = new Flash();
    }

    protected function show(string $contentFile, array $vars = []): void
    {
        $flash = $this->flash;

        extract($vars);

        ob_start();
        require $contentFile;
        $content = ob_get_clean();

        require __DIR__ . '/../View/template.php';
    }
}
