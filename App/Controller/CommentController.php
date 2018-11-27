<?php
namespace App\Controller;

use \App\Model\Comment;
use \App\Router\HTTPRequest;

class CommentController extends Controller
{
    public function addComment(HTTPRequest $req)
    {
        $comment = new Comment([
            'postId' => $req->getData('id'),
            'author' => $req->postData('author'),
            'content' => $req->postData('content')
        ]);

        if ($comment->hasErrors()) {
            $this->flash->set('Tous les champs doivent être remplis', 'danger');
        } else {
            $this->commentManager->add($comment);
            $this->flash->set('Commentaire ajouté');
        }

        $this->httpResponse->redirect('/post/' . $req->getData('id'));
    }
    
    public function deleteComment(HTTPRequest $req)
    {
        $this->commentManager->delete($req->getData('id'));

        $this->flash->set('Commentaire supprimé');

        $this->httpResponse->redirect('/admin');
    }
    
    public function flagComment(HTTPRequest $req)
    {
        $id = $req->getData('id');

        $this->commentManager->flag($id);

        $comment = $this->commentManager->getSingle($req->getData('id'));

        $this->flash->set('Commentaire signalé');

        $this->httpResponse->redirect('/post/' . $comment->getPostId());
    }
    
    public function unflagComment(HTTPRequest $req)
    {
        $this->commentManager->unflag($req->getData('id'));

        $this->flash->set('Commentaire ignoré');

        $this->httpResponse->redirect('/admin');
    }
}
