<?php
namespace App\Controller;

use App\Model\Eloquent\User;
use App\Model\Eloquent\Message;
use Base\AbstractController;
use Intervention\Image\ImageManagerStatic as Image;

class Admin extends AbstractController
{
    public function preDispatch()
    {
        parent::preDispatch();
        if(!$this->getUser() || !$this->getUser()->isAdmin()) {
            $this->redirect('/');
        }
    }

    public function deleteMessage()
    {
        $messageId = (int) $_GET['id'];
        Message::destroy($messageId);
        $this->redirect('/blog');
    }

    public function users()
    {
        return $this->view->render('admin/users.phtml',[
            'users' => User::all(),
        ]);
    }

    public function editUser()
    {
        $userId = (int) $_GET['user_id'];
        return $this->view->render('admin/editUser.phtml',[
            'user' => User::getById($userId)
        ]);
    }

    public function deleteUser()
    {

        $userId = (int) $_GET['user_id'];
        User::destroy($userId);
        $this->redirect('/users');

    }

    public function userSave()
    {
        $userId = (int) $_GET['user_id'];
        $user = User::getById($userId);
        $user->name = $_POST['userName'];
        // Если пользователь изменил email проверяем, не хочет ли он занять чужой
        if ($user->email !== $_POST['userNewEmail'] && User::getByEmail($_POST['userNewEmail']) !== null) {
            return 'Такой email уже существует у другого пользователя';
        }

        $user->email = $_POST['userNewEmail'];

        if (isset($_FILES['image']['tmp_name']) && trim($_FILES['image']['tmp_name'])) {
            $user->loadFile($_FILES['image']['tmp_name']);
            $img = Image::make('avatars/'.$user->image);

            $img->resize(100, null, function (\Intervention\Image\Constraint $constraint) {
                $constraint->aspectRatio();
            });


            $img->save('images/'.$user->image);
        }

        $user->save();
        $this->redirect('/users');
    }

    public function addUser()
    {
        return $this->view->render('admin/addUser.phtml');
    }

    public function createUser()
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

        if (isset($_FILES['image']['tmp_name']) && trim($_FILES['image']['tmp_name'])) {
            $user->loadFile($_FILES['image']['tmp_name']);
            $img = Image::make('avatars/'.$user->image);

            $img->resize(100, null, function (\Intervention\Image\Constraint $constraint) {
                $constraint->aspectRatio();
            });


            $img->save('images/'.$user->image);
        }

        $user->save();

        $this->redirect('/users');
    }
}