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
}