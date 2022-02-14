<?php

namespace Divergent\Bkash\Apis\Webhook;

use Divergent\Bkash\BkashLog;

class Webhook
{

    private $payload;
    private $messageType;
    private $signingCertURL;

    public function __construct()
    {
        $this->payload = json_decode(file_get_contents('php://input'));
        $this->messageType = $_SERVER['HTTP_X_AMZ_SNS_MESSAGE_TYPE'];
        $this->signingCertURL = $this->payload->SigningCertURL;
    }

    public function processWebhookRequest()
    {
        $certUrlValidation = validateUrl($this->signingCertURL);
        if ($certUrlValidation == '1') {
            $pubCert = get_content($this->signingCertURL);

            $signature = $this->payload->Signature;
            $signatureDecoded = base64_decode($signature);

            $content = getStringToSign($this->payload);
            if ($content != '') {
                $verified = openssl_verify($content, $signatureDecoded, $pubCert, OPENSSL_ALGO_SHA1);
                if ($verified == '1') {
                    if ($this->messageType == "SubscriptionConfirmation") {

                        $subscribeURL = $this->payload->SubscribeURL;
                        $content = 'Webhook => Subscribe' . "\n DATE TIME = " . date('d M, Y h:i:s A') . "\n Subscribe URL = " . $subscribeURL  . "\n ------------------------------------------------------------------------------------------------------------------------ \n\n";
                        BkashLog::writeLog($content);
                        //subscribe
                        $url = curl_init($subscribeURL);
                        curl_exec($url);
                    } else if ($this->messageType == "Notification") {

                        $notificationData = $this->payload->Message;
                        $content = 'Webhook => NotificationData-Message' . "\n DATE TIME = " . date('d M, Y h:i:s A') . "\n Notification Data = " . $notificationData  . "\n ------------------------------------------------------------------------------------------------------------------------ \n\n";
                        BkashLog::writeLog($content);
                    }
                }
            }
        }
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $URL);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
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

        if ($message['SignatureVersion'] !== '1') {
            $errorLog =  "The SignatureVersion \"{$message['SignatureVersion']}\" is not supported.";
            $content = 'Webhook => SignatureVersion-Error' . "\n DATE TIME = " . date('d M, Y h:i:s A') . "\n Error Message = " . $errorLog  . "\n ------------------------------------------------------------------------------------------------------------------------ \n\n";
            BkashLog::writeLog($content);
        } else {
            foreach ($signableKeys as $key) {
                if (isset($message[$key])) {
                    $stringToSign .= "{$key}\n{$message[$key]}\n";
                }
            }
            $content = 'Webhook => StringToSign-Error' . "\n DATE TIME = " . date('d M, Y h:i:s A') . "\n stringToSign = " . $stringToSign  . "\n ------------------------------------------------------------------------------------------------------------------------ \n\n";
            BkashLog::writeLog($content);
        }
        return $stringToSign;
    }
}
