<?php
namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Model\Eloquent
 *
 * @property-read $id
 * @property-read $text
 * @property-read $author_id
 * @property-read $image
 * @property-read $created_at
 * @property-read User $author
 *
 */
class Message extends Model
{
    /*
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = [
        'text',
        'created_at',
        'author_id',
        'image',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Загрузить картинку из сообщения
     * @param string $file
     */
    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            \move_uploaded_file($file,getcwd() . '/images/' . $this->image);
        }
    }

    /**
     * Сгенерировать название файла картинки
     * @return string
     */
    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }


    /**
     * Получить картнинку сообщения
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Получить всю информацию сообщения
     * @return array
     */
    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'text' => $this->text,
            'created_at' => $this->created_at,
            'image' => $this->image
        ];
    }
}