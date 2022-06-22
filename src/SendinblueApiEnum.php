<?php
namespace Mograine\Sendinblue;

enum SendinblueApiEnum: string
{
    case AccountApi             = \SendinBlue\Client\Api\AccountApi::class;
    case AttributesApi          = \SendinBlue\Client\Api\AttributesApi::class;
    case ContactsApi            = \SendinBlue\Client\Api\ContactsApi::class;
    case CRMApi                 = \SendinBlue\Client\Api\CRMApi::class;
    case EmailCampaignsApi      = \SendinBlue\Client\Api\EmailCampaignsApi::class;
    case FoldersApi             = \SendinBlue\Client\Api\FoldersApi::class;
    case InboundParsingApi      = \SendinBlue\Client\Api\InboundParsingApi::class;
    case ListsApi               = \SendinBlue\Client\Api\ListsApi::class;
    case MasterAccountApi       = \SendinBlue\Client\Api\MasterAccountApi::class;
    case ProcessApi             = \SendinBlue\Client\Api\ProcessApi::class;
    case ResellerApi            = \SendinBlue\Client\Api\ResellerApi::class;
    case SendersApi             = \SendinBlue\Client\Api\SendersApi::class;
    case SMSCampaignsApi        = \SendinBlue\Client\Api\SMSCampaignsApi::class;
    case TransactionalEmailsApi = \SendinBlue\Client\Api\TransactionalEmailsApi::class;
    case TransactionalSMSApi    = \SendinBlue\Client\Api\TransactionalSMSApi::class;
    case WebhooksApi            = \SendinBlue\Client\Api\WebhooksApi::class;
}
