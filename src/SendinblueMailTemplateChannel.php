<?php

namespace Mograine\Sendinblue;

use Exception;
use Illuminate\Notifications\Notification;
use Mograine\Sendinblue\Facades\Sendinblue as SendinblueFacade;

/**
 * Mail template channel for Sendinblue transactional template.
 */
class SendinblueMailTemplateChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws Exception
     */
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toMailTemplate')) {
            throw new Exception('SendInBlueMailTemplateChannel : notification do not have "toMailTemplate" method');
        }

        $email = '';
        if ($notifiable instanceof AnonymousNotifiable) {
            $email = $notifiable->routes['mail']; // Direct email string
        } elseif (is_object($notifiable) && property_exists($notifiable, 'email')) {
            $email = $notifiable->email;
        } else {
            throw new Exception('SendInBlueMailTemplateChannel : Unable to determine recipient email');
        }

        $message = $notification->toMailTemplate($notifiable);
        $message->to($email);
        SendinblueFacade::sendSendInBlueTemplate($message);
    }
}
