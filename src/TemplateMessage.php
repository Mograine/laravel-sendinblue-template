<?php
namespace Mograine\Sendinblue;

use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailReplyTo;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendSmtpEmailTo;

/**
 * Class TemplateMessage.
 *
 * TemplateMessage is a wrapper for Laravel notifications messages
 *
 * @package Mograine\Sendinblue
 */
class TemplateMessage
{
    private SendSmtpEmail $sendSmtpEmail;
    private array $attributes = [];

    public function __construct(int $templateId)
    {
        $this->sendSmtpEmail = new SendSmtpEmail();
        $this->sendSmtpEmail["templateId"] = $templateId;
        $this->sendSmtpEmail["sender"] = new SendSmtpEmailSender(["name" => config('sendinblue.name'), "email" => config('sendinblue.email')]);
        $this->sendSmtpEmail["replyTo"] = new SendSmtpEmailReplyTo(["email" => config('sendinblue.email')]);
    }

    public function to(string $email): self
    {
        $this->sendSmtpEmail->setTo([new SendSmtpEmailTo(['email' => $email])]);
        return $this;
    }

    public function attribute(string $key, string $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function getSmtpEmail(): SendSmtpEmail
    {
        if (!empty($this->attributes)) {
            $this->sendSmtpEmail['params'] = (object)$this->attributes;
        }

        return $this->sendSmtpEmail;
    }
}
