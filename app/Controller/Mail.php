<?php

namespace App\Controller;

use Base\AbstractController;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class Mail extends AbstractController
{
    public function send()
    {

        $mailTo = trim($_POST['mail_to']);
        $mailBody = trim($_POST['mail_body']);
        $mailSubject = trim($_POST['mail_subject']);

        if ($mailTo && $mailBody && $mailSubject) {

            $transport = (new Swift_SmtpTransport(MAILING_HOST, MAILING_PORT, MAILING_ENCRYPTION))
                ->setUsername(MAILING_USER)
                ->setPassword(MAILING_PASS)
            ;


            $mailer = new Swift_Mailer($transport);


            $message = (new Swift_Message('Test subj'))
                ->setFrom([MAILING_USER => 'Сервис рассылки неблагоприятных вестей'])
                ->setTo([$mailTo])
                ->setBody($mailBody)
            ;


            $result = $mailer->send($message);
            return $result
                ? 'Послание отправлено, <a href="/mail">Вертаться взад</a>'
                : 'Произошла ошибка, всё сломалось, не надо так(';
        }
        return 'Вы не ввели Адресъ аль текст сообщения, а то и тему депеши! ЪУЪ!';
    }

    public function index()
    {
        return $this->view->renderTwig(
            'mail.twig',
            [
                'title' => 'Отправить почту и не попасть на казнь(в спам тобишь)',
                'user' => $this->getUser() ?? ''
            ]
        );
    }
}