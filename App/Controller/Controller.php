<?php
namespace App\Controller;

use \App\Model\Post;
use \App\Model\Comment;
use \App\Router\HTTPRequest;

class Controller
{
    private $postManager,
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

    private function show(string $contentFile, array $vars = [])
    {
        $flash = $this->flash;

        extract($vars);

        ob_start();
        require($contentFile);
        $content = ob_get_clean();

        require('../App/View/template.php');
    }

    public function listPosts(HTTPRequest $req)
    {
        // Posts per page
        $limit = 5;

        $page = $req->getData('page');

        $postsTotal = $this->postManager->count();

        $paginator = new \App\Model\Paginator($page, $limit, $postsTotal);

        $offset = $paginator->offset();

        $posts = $this->postManager->getPosts($limit, $offset);
        
        if (empty($posts))
        {
            $this->httpResponse->redirect404();
        }
        else
        {
            $this->show('../App/View/listPosts.php', compact('posts', 'paginator'));
        }
    }

    public function post(HTTPRequest $req)
    {
        $post = $this->postManager->getSingle($req->getData('id'));

        if (null === $post)
        {
            $this->httpResponse->redirect404();
        }
        else
        {
            $comments = $this->commentManager->getComments($req->getData('id')); 

            $this->show('../App/View/post.php', compact('post', 'comments'));
        }
    }

    public function addComment(HTTPRequest $req)
    {
        $comment = new Comment([
            'postId' => $req->getData('id'),
            'author' => $req->postData('author'),
            'content' => $req->postData('content')
        ]);

        $this->commentManager->add($comment);

        $this->flash->set('Commentaire ajouté');

        header('Location: /post/' . $req->getData('id'));
    }

    public function authenticate(HTTPRequest $req)
    {
        $username = $req->postData('username');
        $password = $req->postData('password');

        $user = $this->userManager->get($username, $password);

        if(!$user || !password_verify($password, $user->getPassword()))
        {
            $this->flash->set('Login ou mot de passe invalide', 'danger');

            header('Location: /login');
        }
        else
        {
            $user->login();
            header('Location: /admin');
        }
    }

    public function addPost(HTTPRequest $req)
    {
        $post = new Post([
            'title' => $req->postData('title'),
            'content' => $req->postData('content')
        ]);

        $this->postManager->add($post);

        $this->flash->set('Post ajouté');

        header('Location: /admin');
    }

    public function updatePost(HTTPRequest $req)
    {
        $post = $this->postManager->getSingle($req->getData('id'));
        $this->show('../App/View/updatePost.php', compact('post'));
    }

    public function executeUpdatePost(HTTPRequest $req)
    {
        $post = new Post([
            'id' => $req->getData('id'),
            'title' => $req->postData('title'),
            'content' => $req->postData('content')
        ]);

        $this->postManager->update($post);

        $this->flash->set('Post mis à jour');

        header('Location: /admin');
    }

    public function deletePost(HTTPRequest $req)
    {
        $this->postManager->delete($req->getData('id'));

        $this->flash->set('Post supprimé');
       
        header('Location: /admin');
    }

    public function flagComment(HTTPRequest $req)
    {
        $id = $req->getData('id');

        $this->commentManager->flag($id);

        $comment = $this->commentManager->getSingle($req->getData('id'));

        $this->flash->set('Commentaire signalé');

        header('Location: /post/' . $comment->getPostId());
    }

    public function adminPanel()
    {
        $flaggedComments = $this->commentManager->getFlagged();
        $posts = $this->postManager->getPosts();
        $this->show('../App/View/adminPanel.php', compact('flaggedComments', 'posts'));
    }

    public function deleteComment(HTTPRequest $req)
    {
        $this->commentManager->delete($req->getData('id'));

        $this->flash->set('Commentaire supprimé');
    }

    public function unflagComment(HTTPRequest $req)
    {
        $this->commentManager->unflag($req->getData('id'));
        
        $this->flash->set('Commentaire ignoré');

        header('Location: /admin');
    }

    public function login()
    {
        $this->show('../App/View/login.php');
    }

    public function writePost()
    {
        $this->show('../App/View/writePost.php');
    }

    public function notFound()
    {
        $this->show('../App/View/404.php');
    }
}
