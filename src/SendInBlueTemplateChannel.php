<?php

namespace Mograine\Sendinblue;

use Exception;
use Illuminate\Notifications\Notification;

/**
 * Mail template channel for Sendinblue transactional template.
 */
class SendInBlueMailTemplateChannel
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

        $message = $notification->toMailTemplate($notifiable);
        $message->to($notifiable->email);
        Sendinblue::sendSendInBlueTemplate($message);
    }
}
