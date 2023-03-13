<?php

namespace App\Controllers;

use App\Models\User;
use Laminas\Diactoros\Response\RedirectResponse;
class UserController extends BaseController
{
    public function addUserAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $_POST;
            $user = new User();
            $user->nombre = $postData['name'];
            $user->user = $postData['username'];
            $user->email = $postData['email'];
            $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
            $user->perfil = 'admin';
            $user->save();
            header('Location: /');
        }
        return $this->renderHTML('addUser.twig');
    }

    public function logoutAction()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['perfil']);
        unset($_SESSION['user']);
        return new RedirectResponse('/');
    }

    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $_POST;
            $user = User::where('email', $postData['email'])->first();
            if ($user) {
                if (password_verify($postData['password'], $user->password)) {
                    $_SESSION['userId'] = $user->id;
                    $_SESSION['perfil'] = $user->perfil;
                    $_SESSION['user'] = $user->user;
                    print_r($_SESSION);
                    return new RedirectResponse('/admin');
                }else{
                    echo "Email o contraseña incorrectos";
                }
            }else{
                echo "Email o contraseña incorrectos";
            }
        }
        return $this->renderHTML('login.twig');
    }
}
