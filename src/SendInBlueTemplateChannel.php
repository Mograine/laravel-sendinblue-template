<?php

namespace Mograine\Sendinblue;

use Exception;
use Illuminate\Notifications\Notification;

/**
 * Class SendInBlueTemplateChannel.
 *
 * Mail template channel for Sendinblue transactional template.
 */
class SendInBlueTemplateChannel
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
            throw new Exception('SendInBlueTemplateChannel called with notification parameter without toMailTemplate method');
        }

        $message = $notification->toMailTemplate($notifiable);
        $message->to($notifiable->email);
        Sendinblue::SendSendInBlueTemplate($message);
    }
}
