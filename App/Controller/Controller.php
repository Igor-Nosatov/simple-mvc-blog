<?php

require_once('App/Model/PostManager.php');
require_once('App/Model/CommentManager.php');
require_once('App/Model/UserManager.php');
require_once('App/Model/Post.php');

class Controller
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }

    public function listPosts()
    {
        $posts = $this->postManager->getPosts();

        require('App/View/listPosts.php');
    }

    public function post()
    {
        $post = $this->postManager->getSingle($_GET['id']);
        $comments = $this->commentManager->getComments($_GET['id']);

        require('App/View/post.php');
    }

    public function addComment($postId, $author, $content)
    {
        $this->commentManager->add($postId, $author, $content);

        $_SESSION['flash'] = 'Commentaire ajouté';

        header('Location: index.php?action=post&id=' . $postId);
    }

    public function authenticate($username, $password)
    {
        $user = $this->userManager->get($username, $password);

        if(!$user || !password_verify($password, $user->getPassword()))
        {
            throw new Exception('Login ou mot de passe invalide');
        }
        else
        {
            $user->login();
            header('Location: index.php?action=admin');
        }
    }

    public function addPost($title, $content)
    {
        $this->postManager->add($title, $content);

        $_SESSION['flash'] = 'Post ajouté';

        header('Location: index.php?action=admin');
    }

    public function updatePost($postId)
    {
        $post = $this->postManager->getSingle($postId);
        require('App/View/updatePost.php');
    }

    public function executeUpdatePost($postId, $title, $content)
    {
        $post = new Post(array(
            'id' => $postId,
            'title' => $title,
            'content' => $content
        ));

        $this->postManager->update($post);

        $_SESSION['flash'] = 'Post mis à jour';

        header('Location: index.php?action=admin');
    }

    public function deletePost($id)
    {
        $this->postManager->delete($id);
    }

    public function flagComment($id)
    {
        $this->commentManager->flag($id);

        $comment = $this->commentManager->getSingle($id);

        $_SESSION['flash'] = 'Commentaire signalé';

        header('Location: index.php?action=post&id=' . $comment->getPostId());
    }

    public function adminPanel()
    {
        $flaggedComments = $this->commentManager->getFlagged();
        require('App/View/adminPanel.php');
    }

    public function deleteComment($id)
    {
        $this->commentManager->delete($id);
    }

    public function unflagComment($id)
    {
        $this->commentManager->unflag($id);

        header('Location: index.php?action=admin');
    }
}
