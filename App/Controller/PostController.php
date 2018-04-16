<?php
namespace App\Controller;

use \App\Model\Post;
use \App\Model\Comment;
use \App\Router\HTTPRequest;

class PostController extends Controller
{
    public function notFound()
    {
        $this->show('../App/View/404.php');
    }
    
    public function listPosts(HTTPRequest $req)
    {
        // Posts per page
        $limit = 5;

        $page = $req->getData('page');

        $postsTotal = $this->postManager->count();

        $paginator = new \App\Model\Paginator('/posts', $page, $limit, $postsTotal);

        $offset = $paginator->offset();

        $posts = $this->postManager->getPosts([
            'limit' => $limit,
            'offset' => $offset,
            'order' => 'desc'
        ]);
        
        $postsAsc = $this->postManager->getPosts(['order' => 'asc']);

        if (empty($posts))
        {
            $this->httpResponse->redirect404();
        }
        else
        {
            $this->show('../App/View/listPosts.php', compact('posts', 'paginator', 'postsAsc'));
        }
    }

    public function post(HTTPRequest $req)
    {
        $id = $req->getData('id');

        $post = $this->postManager->getSingle($id);
        $previousPost = $this->postManager->getPrevious($id);
        $nextPost = $this->postManager->getNext($id);

        if (null === $post)
        {
            $this->httpResponse->redirect404();
        }
        else
        {
            $comments = $this->commentManager->getComments($req->getData('id'));

            $this->show('../App/View/post.php', compact('post', 'comments', 'previousPost' ,'nextPost'));
        }
    }
    
    public function writePost()
    {
        $this->show('../App/View/writePost.php');
    }
    
    public function addPost(HTTPRequest $req)
    {
        $post = new Post([
            'title' => $req->postData('title'),
            'content' => $req->postData('content')
        ]);

        $this->postManager->add($post);

        $this->flash->set('Post ajouté');

        $this->httpResponse->redirect('/admin');
    }
    
    public function deletePost(HTTPRequest $req)
    {
        $this->postManager->delete($req->getData('id'));

        $this->flash->set('Post supprimé');

        $this->httpResponse->redirect('/admin');
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

        $this->httpResponse->redirect('/admin');
    }
    
    public function imgUploadTinyMCE()
    {
        $accepted_origins = array('http://' . $_SERVER['SERVER_NAME']);

        $imageFolder = "img/uploads/";

        reset ($_FILES);
        $temp = current($_FILES);

        if (is_uploaded_file($temp['tmp_name']))
        {
            if (isset($_SERVER['HTTP_ORIGIN']))
            {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins))
                {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                }
                else
                {
                    header("HTTP/1.0 403 Origin Denied");
                    return;
                }
            }

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name']))
            {
                header("HTTP/1.0 500 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png")))
            {
                header("HTTP/1.0 500 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Respond to the successful upload with JSON.
            echo json_encode(array('location' => $filetowrite));
        }
        else
        {
            // Notify editor that the upload failed
            header("HTTP/1.0 500 Server Error");
        }
    }
}
