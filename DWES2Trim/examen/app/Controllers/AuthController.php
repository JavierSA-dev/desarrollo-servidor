<?php
    namespace App\Controllers;
    use App\Models\Usuario;
    
    class AuthController extends BaseController
    {
        public static function login($data){
            $user = Usuario::getInstancia();
            $user->setUser($data['user']);
            $user->setpasswd($data['pass']);
            if ($user->exists() && $data["forma"] == $data["formaCorrecta"]) {
                $_SESSION['user'] = $user->exists();
                $_SESSION['auth'] = $user->exists()[0]['perfil'];
                header('Location: http://examen.localhost/');
            }else{
                $_SESSION['error'] = 'Usuario ,contraseña o forma incorrectos';
                header('Location: http://examen.localhost/');
            }
        }
        public function logoutAction()
        {
            session_start();
            session_destroy();
            header('Location: http://examen.localhost/');
        }
    }
