<?php
namespace Mograine\Sendinblue;

use Exception;
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
    private array $tags = [];
    private array $attributes = [];
    private array $messageVersions = [];

    /**
     * @param int $templateId
     * @param bool $useMessageVersions true
     */
    public function __construct(
        int $templateId,
        private readonly bool $useMessageVersions = true
    )
    {
        $this->sendSmtpEmail = new SendSmtpEmail();
        $this->sendSmtpEmail["templateId"] = $templateId;
        $this->sendSmtpEmail["sender"] = new SendSmtpEmailSender(["name" => config('sendinblue.name'), "email" => config('sendinblue.email')]);
        $this->sendSmtpEmail["replyTo"] = new SendSmtpEmailReplyTo(["email" => config('sendinblue.email')]);
    }

    /**
     * @param string $email
     * @return $this
     * @throws Exception
     */
    public function to(string $email): self
    {
        if (!$this->useMessageVersions) {
            $this->sendSmtpEmail->setTo([new SendSmtpEmailTo(['email' => $email])]);
        } else {
            $messageVersion = [];
            $messageVersion['to'] = [
                [
                    'email' => $email
                ]
            ];
            $this->messageVersions[] = $messageVersion;

            if (count($this->messageVersions) > 2000) {
                throw new Exception("messageVersions limit reached");
            }
        }

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function attribute(string $key, string $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function tag(string $tag): self
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * Return the SendInBlue SendSmtpEmail instance used in api->sendTransacEmail
     *
     * @return SendSmtpEmail
     */
    public function getSmtpEmail(): SendSmtpEmail
    {
        if (!empty($this->attributes)) {
            $this->sendSmtpEmail['params'] = (object)$this->attributes;
        }

        if (!empty($this->tags)) {
            $this->sendSmtpEmail['tags'] = $this->tags;
        }

        if ($this->useMessageVersions) {
            $this->sendSmtpEmail["messageVersions"] = $this->messageVersions;
        }

        return $this->sendSmtpEmail;
    }
}
