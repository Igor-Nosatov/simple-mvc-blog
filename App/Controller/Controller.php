<?php
namespace App\Controller;

require_once('App/Model/PostManager.php');
require_once('App/Model/CommentManager.php');
require_once('App/Model/UserManager.php');
require_once('App/Model/Post.php');
require_once('App/Model/Comment.php');

use \App\Model\Post;
use \App\Model\Comment;
use \App\Router\HTTPRequest;

class Controller
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new \App\Model\PostManager();
        $this->commentManager = new \App\Model\CommentManager();
        $this->userManager = new \App\Model\UserManager();
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts();

        require('App/View/listPosts.php');
    }

    public function post(HTTPRequest $req)
    {
        $post = $this->postManager->getSingle($req->getData('id'));
        $comments = $this->commentManager->getComments($req->getData('id'));

        require('App/View/post.php');
    }

    public function addComment(HTTPRequest $req)
    {
        $comment = new Comment([
            'postId' => $req->getData('id'),
            'author' => $req->postData('author'),
            'content' => $req->postData('content')
        ]);

        $this->commentManager->add($comment);

        $_SESSION['flash'] = 'Commentaire ajouté';

        header('Location: /post/' . $req->getData('id'));
    }

    public function authenticate(HTTPRequest $req)
    {
        $username = $req->postData('username');
        $password = $req->postData('password');

        $user = $this->userManager->get($username, $password);

        if(!$user || !password_verify($password, $user->getPassword()))
        {
            throw new Exception('Login ou mot de passe invalide');
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

        $_SESSION['flash'] = 'Post ajouté';

        header('Location: /admin');
    }

    public function updatePost(HTTPRequest $req)
    {
        $post = $this->postManager->getSingle($req->getData('id'));
        require('App/View/updatePost.php');
    }

    public function executeUpdatePost(HTTPRequest $req)
    {
        $post = new Post([
            'id' => $req->getData('id'),
            'title' => $req->postData('title'),
            'content' => $req->postData('content')
        ]);

        $this->postManager->update($post);

        $_SESSION['flash'] = 'Post mis à jour';

        header('Location: /admin');
    }

    public function deletePost(HTTPRequest $req)
    {
        $this->postManager->delete($req->getData('id'));
    }

    public function flagComment(HTTPRequest $req)
    {
        $id = $req->getData('id');

        $this->commentManager->flag($id);

        $comment = $this->commentManager->getSingle($req->getData('id'));

        $_SESSION['flash'] = 'Commentaire signalé';

        header('Location: /post/' . $comment->getPostId());
    }

    public function adminPanel()
    {
        $flaggedComments = $this->commentManager->getFlagged();
        require('App/View/adminPanel.php');
    }

    public function deleteComment(HTTPRequest $req)
    {
        $this->commentManager->delete($req->getData('id'));
    }

    public function unflagComment(HTTPRequest $req)
    {
        $this->commentManager->unflag($req->getData('id'));

        header('Location: /admin');
    }

    public function login()
    {
        require('App/View/login.php');
    }

    public function writePost()
    {
        require('App/View/writePost.php');
    }
}
