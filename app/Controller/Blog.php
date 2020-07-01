<?php
namespace App\Controller;

use App\Model\Message;
use App\Model\User;
use Base\AbstractController;
use Intervention\Image\ImageManagerStatic as Image;

class Blog extends AbstractController
{
    public function index()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }
        $messages = Message::getList();
        if ($messages) {
            $userIds = array_map(function (Message $message) {
                return $message->getAuthorId();
            }, $messages);
            $users = \App\Model\User::getByIds($userIds);
            array_walk($messages, function (Message $message) use ($users) {
                if (isset($users[$message->getAuthorId()])) {
                    $message->setAuthor($users[$message->getAuthorId()]);
                }
            });
        }
        return $this->view->render('blog.phtml', [
            'messages' => $messages,
            'user' => $this->getUser()
        ]);
    }

    public function addMessage()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }

        $text = (string) $_POST['text'];

        if (!trim($text)) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
            'text' => $text,
            'author_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
            $img = Image::make('images/'.$message->getImage());

            $img->resize(200, null, function (\Intervention\Image\Constraint $constraint) {
               $constraint->aspectRatio();
            });
            $img->text(
                'WATERMARK! YEAH!',
                30,
                30,
                function (\Intervention\Image\AbstractFont $font) {
                    $font->size(98);
                    $font->color('#ff0000');
                    $font->align('left');
                    $font->valign('bottom');
                }
            );

            $img->save('images/'.$message->getImage());
        }

        $message->save();
        $this->redirect('/blog');

    }

    private function error(string $text)
    {
        echo $text;
        echo '<br><a href="/blog">Вернуться назад и написать всё что я думаю об этом блоге!</a>';
        die();
    }

    public function logout() {
        $this->session->logout();
        $this->redirect('/');
    }
}