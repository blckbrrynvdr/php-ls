<?php
namespace App\Controller;

use App\Model\Eloquent\Message;
use Base\AbstractController;

class Api extends AbstractController
{
    public function getUserMessages()
    {
        $userId = (int) $_GET['user_id'] ?? 0;
        if (!$userId) {
            return $this->response(['error' => 'no_user_id']);
        }
        /** @var \Illuminate\Database\Eloquent\Collection $message */
        $messages = Message::where('author_id', '=', $userId)->get();
        if (!$messages) {
            return $this->response(['error' => 'no_messages']);
        }
        $data = [];
        foreach ($messages as $message) {
            $data[$message->id]['id'] = $message->id;
            $data[$message->id]['author_id'] = $message->author_id;
            $data[$message->id]['image'] = $message->image;
            $data[$message->id]['text'] = $message->text;
            $data[$message->id]['created_at'] = $message->created_at;
        }


        return $this->response(['messages' => $data]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}