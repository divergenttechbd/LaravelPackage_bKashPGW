<?php

namespace Divergent\Bkash\Apis\Webhook;

use App\Models\WebhookPayload;
use Divergent\Bkash\Consts\BkashConstant;
use Exception;
use Illuminate\Support\Facades\Http;

class Webhook
{

    private $payload;
    private $messageType;
    private $signingCertURL;

    public function __construct()
    {
        $this->payload = json_decode(file_get_contents('php://input'));
        $this->messageType = $_SERVER['HTTP_X_AMZ_SNS_MESSAGE_TYPE'] ?? null;
    }

    public function processWebhookRequest($logId)
    {
        $this->signingCertURL = $this->payload->SigningCertURL ?? $_SERVER['HTTP_SIGNINGCERTURL'];
        $certUrlValidation = $this->validateUrl($this->signingCertURL);
        if ($certUrlValidation == '1') {
            $pubCert = $this->get_content($this->signingCertURL);

            $signature = $this->payload->Signature;
            $signatureDecoded = base64_decode($signature);

            $content = $this->getStringToSign($this->payload);
            if ($content != '') {
                try {
                    $verified = openssl_verify($content, $signatureDecoded, $pubCert, OPENSSL_ALGO_SHA1);
                    //$verified = '1';
                    //if ($verified === '1')
                    if ($verified) {
                        if ($this->messageType == "SubscriptionConfirmation") {

                            $subscribeURL = $this->payload->SubscribeURL;

                            $url = curl_init($subscribeURL);
                            curl_exec($url);

                            return[
                                "code" => 200,
                                "status" => "success",
                                "message" => "Subscribed Successfully",
                                'data' => $this->payload
                            ];

                        } else if ($this->messageType == "Notification") {

                            $notificationData = $this->payload->Message;
                            return [
                                "code" => 200,
                                "status" => "success",
                                "message" => "Notification received successfully",
                                'data' => $notificationData
                            ];
                        } else {
                            return [
                                "code" => 400,
                                "status" => "failed",
                                "message" => "Invalid Message Type"
                            ];
                        }
                    }
                } catch (Exception $e) {
                    
                    $webhookData = WebhookPayload::find($logId);
                    $webhookData->log = $e;
                    $webhookData->save();

                    return [
                        "code" => 500,
                        "status" => "failed",
                        "message" => $e->getMessage()
                    ];
                }
            }
        }
    }

    public function processRecurringWebhookRequest()
    {
        return [
            "code" => 200,
            "status" => "success",
            "message" => "Notification received successfully",
            'data' => $this->payload
        ];
    }

    function validateUrl($url)
    {
        $defaultHostPattern = '/^sns\.[a-zA-Z0-9\-]{3,}\.amazonaws\.com(\.cn)?$/';
        $parsed = parse_url($url);

        if (empty($parsed['scheme']) || empty($parsed['host']) || $parsed['scheme'] !== 'https' || substr($url, -4) !== '.pem' || !preg_match($defaultHostPattern, $parsed['host'])) {
            return false;
        } else {
            return true;
        }
    }

    function get_content($URL)
    {
        $response = Http::get($URL);
        return $response->json();
    }

    function getStringToSign($message)
    {
        $signableKeys = [
            'Message',
            'MessageId',
            'Subject',
            'SubscribeURL',
            'Timestamp',
            'Token',
            'TopicArn',
            'Type'
        ];

        $stringToSign = '';

        if ($message->SignatureVersion !== '1') {
            return "The SignatureVersion \"{$message['SignatureVersion']}\" is not supported.";
        } else {

            foreach ($signableKeys as $key) {

                if (property_exists($message, $key) && is_object($message->$key)) {
                    $m = json_encode($message->$key);
                    $stringToSign .= "{$key}\n{$m}\n";
                }
            }
        }
        return $stringToSign;
    }
}
