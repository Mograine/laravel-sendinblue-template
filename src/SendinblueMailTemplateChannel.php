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

        $message = $notification->toMailTemplate($notifiable);
        $message->to($notifiable->email);
        SendinblueFacade::sendSendInBlueTemplate($message);
    }
}
