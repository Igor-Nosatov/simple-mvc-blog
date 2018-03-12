<?php
namespace App\Controller;

use \App\Router\HTTPRequest;

class UserController extends Controller
{
    public function login()
    {
        $this->show('../App/View/login.php');
    }

    public function logout()
    {
        unset($_SESSION['id']);
        $this->flash->set('Vous êtes déconnecté');
        $this->httpResponse->redirect('/');
    }

    public function authenticate(HTTPRequest $req)
    {
        $username = $req->postData('username');
        $password = $req->postData('password');

        $user = $this->userManager->getByUsername($username, $password);

        if(!$user || !password_verify($password, $user->getPassword()))
        {
            $this->flash->set('Login ou mot de passe invalide', 'danger');

            $this->httpResponse->redirect('/login');
        }
        else
        {
            $user->login();
            $this->httpResponse->redirect('/admin');
        }
    }
    
    public function adminPanel()
    {
        $flaggedComments = $this->commentManager->getFlagged();
        $posts = $this->postManager->getPosts();
        $this->show('../App/View/adminPanel.php', compact('flaggedComments', 'posts'));
    }
    
    public function changePassword()
    {
        $this->show('../App/View/changePassword.php');
    }

    public function executeChangePassword(HTTPRequest $req)
    {
        $userId = $_SESSION['id'];
    
        $oldPassword = $req->postData('old-password');
        $newPassword = $req->postData('new-password');
        $newPasswordConfirm = $req->postData('new-password-confirm');

        $user = $this->userManager->getById($userId);

        if (!password_verify($oldPassword, $user->getPassword()))
        {
            $this->flash->set('Mot de passe invalide', 'danger');
            $this->httpResponse->redirect('/admin/changePassword');
        }
        else if ($newPassword !== $newPasswordConfirm)
        {
            $this->flash->set('Les deux champs nouveau mot de passe ne correspondent pas', 'danger');
            $this->httpResponse->redirect('/admin/changePassword');
        }
        else
        {
            $user->setPassword($newPassword);

            if ($user->hasErrors())
            {
                $this->flash->set($user->getErrors()[0], 'danger');
                $this->httpResponse->redirect('/admin/changePassword');
            }
            else
            {
                $this->userManager->updatePassword($user);
                
                $this->flash->set('Mot de passe changé');
                
                $this->httpResponse->redirect('/admin');
            }
        }
    }
}
