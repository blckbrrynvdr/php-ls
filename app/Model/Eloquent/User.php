<?php
namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Model\Eloquent
 *
 * @property-read $id
 * @property $name
 * @property-read $password
 * @property $email
 * @property $image
 *
 */
class User extends Model
{
    /*
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'created_at',
        'password',
        'email',
        'image',
    ];

    /**
     * Получить пользователя по Email
     * @param string $email
     * @return User|null
     */
    public static function getByEmail(string $email)
    {
        return self::where('email', '=', $email)->first();
    }


    /**
     * Получить пользователя по id
     * @param int $id
     * @return User|null
     */
    public static function getById(int $id): ?self
    {
        return self::find($id);
    }


    /**
     * Загрузить картинку из сообщения
     * @param string $file
     */
    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            \move_uploaded_file($file,getcwd() . '/avatars/' . $this->image);
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
     * Получить хэш пароля
     * @param string $password
     * @return string
     */
    public static function getPasswordHash(string $password)
    {
        return sha1('.,f.akjsduf' . $password);
    }

    /**
     * Получить id пользователя
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Получить имя пользователя
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Получить почту пользователя
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Получить пароль пользователя
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Проверка является ли пользователь админом
     * @return bool
     */
    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }
}