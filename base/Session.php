<?php
namespace Base;

class Session
{
    public function init()
    {
        session_start();
    }

    /**
     * Авторизация пользователя
     * @param int $id
     */
    public function authUser(int $id)
    {
        $_SESSION['user_id'] = $id;
    }

    /**
     * Выход
     */
    public function logout() {
        $_SESSION['user_id'] = null;
    }

    /**
     * Получить id юзера из сессии
     * @return bool
     */
    public function getUserId()
    {
        return $_SESSION['user_id'] ?? false;
    }
}