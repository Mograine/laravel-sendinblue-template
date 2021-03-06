<?php

namespace Mograine\Sendinblue;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\CreateSmtpEmail;

/**
 * Wrapper for the Sendinblue's Configuration class.
 *
 * @category Class
 * @author   Thomas Van Steenwinckel
 * @link     https://github.com/vansteen/sendinblue
 */
class Sendinblue
{
    /**
     * An instance of the Sendinblue's Configuration class.
     * @var \SendinBlue\Client\Configuration
     */
    protected $configuration;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $apikey = config('sendinblue.apikey');
        $partnerkey = config('sendinblue.partnerkey');

        // Configure API key authorization: api-key
        $this->configuration = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apikey);

        if ($partnerkey) {
            // (Optional) The partner key should be passed in the request headers as
            // partner-key along with api-key pair for successful authentication of partner.
            $this->configuration->setApiKey('partner-key', $partnerkey);
        }
    }

    /**
     * Gets the default configuration instance.
     *
     * @return \SendinBlue\Client\Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Sets the detault configuration instance.
     *
     * @param \SendinBlue\Client\Configuration $configuration An instance of the Configuration Object
     */
    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getApi(SendinblueApiEnum $api)
    {
        return new $api->value(
            new Client(),
            $this->getConfiguration()
        );
    }

    public function sendSendInBlueTemplate(TemplateMessage $templateMessage): CreateSmtpEmail|false
    {
        try {
            $transactionalApi = $this->getApi(SendinblueApiEnum::TransactionalEmailsApi);
            return $transactionalApi->sendTransacEmail($templateMessage->getSmtpEmail());
        }
        catch (\Exception $exception) {
            Log::channel('email')->error("Couldn't send SendInBlue template email", [ "error" => $exception->getMessage() ]);
        }

        return false;
    }
}
