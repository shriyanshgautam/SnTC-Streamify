<?php namespace App\Repositories;

use Illuminate\Http\Response;
use GuzzleHttp\Client;
use App\Repositories\Secrets;
use GuzzleHttp\Psr7\Request;

/**
 * Handles Firebase Cloud Messaging APIs
 */
class FirebaseCloudMessaging{

    protected $client;
    protected $adapter;
    protected $request;
    protected $secrets;
    protected $headers;

    public function __construct()
    {
        $this->secrets = new Secrets();
        $this->client = new Client();
        $this->headers = ["Authorization" => $this->secrets->getFcmHeaderAuthKey(),
                    "Content-Type" => "application/json"];
    }

    /**
     * sendNotification - description
     *
     * @param  {type} $msg       description
     * @param  {type} $fcmTokens description
     * @return {type}            description
     */
    public function sendNotification($msg,$fcmTokens)
    {
        if($fcmTokens=="DEBUG"){
            $fcmTokens = [$this->secrets->getDebugFcmToken()];
        }
        $data = ["registration_ids" => $fcmTokens,"data"=>$msg];
        $body = json_encode($data);
        $request = new Request('POST', $this->secrets->getFcmUrl(), $this->headers, $body);
        $response = $this->client->send($request);
        return $response->getBody();
    }
}
