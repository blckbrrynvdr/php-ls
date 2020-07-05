<?php
namespace App\Controller;

use Base\AbstractController;
use App\Model\Eloquent\User;

class Register extends AbstractController
{
    public function index()
    {
        return $this->view->render('register.phtml');
    }

    public function register()
    {
        $name = (string) $_POST['name'];
        $email = (string) $_POST['email'];
        $password = (string) $_POST['password'];
        $password_confirm = (string) $_POST['password_confirm'];

        if (!trim($name) || !trim($password)) {
            return 'Не заданы имя и пароль';
        }

        if (!trim($email)) {
            return 'Не задан email';
        }

        if ($password !== $password_confirm) {
            return 'Введенные пароли не совпадают';
        }

        if (mb_strlen($password) < 5) {
            return 'Пароль слишком короткий (нужно более 5 символов!)';
        }

        if ($user = User::getByEmail($email)) {
            return 'Пользователь с таким email уже существует';
        }

        $userData = [
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
            'password' => $password,
            'email' => $email,
        ];

        $user = new User($userData);
        $user->save();

        $this->session->authUser($user->getId());
        $this->redirect('/blog');
    }
}