<?php
namespace Base;

use App\Model\User;

class AbstractController
{
    /** @var View */
    protected $view;
    /** @var Session */
    protected $session;

    public function setView(View $view)
    {
        $this->view = $view;
    }


    /**
     * Получить пользователя из сессии
     * @return User|null
     */
    public function getUser(): ?User
    {
        $userId = $this->session->getUserId();
        if (!$userId) {
            return null;
        }

        $user = User::getById($userId);
        if (!$user) {
            return null;
        }

        return $user;
    }

    /**
     * Получить id юзера
     * @return bool|mixed
     */
    public function getUserId()
    {
        if ($user = $this->getUser()) {
            return $user->getId();
        }

        return false;
    }

    /**
     * Установить сессию
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Сбросить сессию
     */
    public function resetSession() {
        $this->session = null;
    }

    /**
     * Сдеалть редирект
     * @param string $url
     * @throws RedirectException
     */
    public function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    public function preDispatch()
    {

    }
}