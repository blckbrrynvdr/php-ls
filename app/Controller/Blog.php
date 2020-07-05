<?php
namespace App\Controller;

use App\Model\Eloquent\Message;
use App\Model\Eloquent\User;
use Base\AbstractController;
use Intervention\Image\ImageManagerStatic as Image;

class Blog extends AbstractController
{

    public function preDispatch()
    {
        parent::preDispatch();

        if (!$this->getUser()) {
            $this->redirect('/login');
        }
    }

    public function index()
    {

        $messages = Message::with('author')
            ->orderBy('id','desc')
            ->limit(MESSAGES_PER_PAGE)
            ->get();

        return $this->view->render('blog.phtml', [
            'messages' => $messages,
            'last_id' => $messages->last()->id,
            'user' => $this->getUser()
        ]);
    }

    public function loadList()
    {

        $lastId = (int) ($_GET['last_id'] ?? 0);
        if(!$lastId) {
            $lastId = 0;
        }
        $messages = Message::with('author')
            ->where('id', '<', $lastId)
            ->orderBy('id','desc')
            ->limit(MESSAGES_PER_PAGE)
            ->get();

        return $this->view->render('messageList.phtml', [
            'messages' => $messages,
            'last_id' => $messages->last()->id,
            'user' => $this->getUser()
        ]);
    }

    public function addMessage()
    {

        $text = (string) $_POST['text'];

        if (!trim($text)) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
            'text' => $text,
            'author_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($_FILES['image']['tmp_name']) && trim($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
            $img = Image::make('images/'.$message->image);

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

            $img->save('images/'.$message->image);
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