<?php namespace App\Repositories;

use Illuminate\Http\Response;
use GuzzleHttp\Client;
use App\Repositories\Secrets;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\File;

/**
 * Handles Dropbox APIs, Uploading Files and retrieveing public sharable urls
 */
class Dropbox{

    protected $client;
    protected $adapter;
    protected $request;
    protected $secrets;
    protected $uploadHeaders;
    protected $sharableLinkHeaders;

    protected $MODE_ADD = "add";
    protected $TRUE = true;
    protected $FALSE = false;

    public function __construct()
    {
        $this->secrets = new Secrets();
        $this->client = new Client();
        $this->uploadHeaders = ["Authorization" => $this->secrets->getDropboxAuthHeader()];
        $this->sharableLinkHeaders = ["Authorization" => $this->secrets->getDropboxAuthHeader()];
    }

    /**
     * uploadFile - description
     *
     * @param  {type} $file      description
     * @param  {type} $fileName  description
     * @param  {type} $directory description
     * @return {type}            description
     */
    public function uploadFile($file,$fileName,$directory){
        $file  = File::get($file->getRealPath());
        $this->uploadHeaders["Content-Type"] = "application/octet-stream";
        $options = ["path"=>$directory.$fileName,
                    "mode"=>$this->MODE_ADD,
                    "autorename"=>$this->TRUE,
                    "mute"=>$this->FALSE ];
        $this->uploadHeaders["Dropbox-API-Arg"] = json_encode($options);

        $request = new Request('POST', $this->secrets->getDropboxUploadUrl(), $this->uploadHeaders, $file);
        $response = $this->client->send($request);
        return $response->getBody();
    }

    /**
     * getSharableLink - description
     *
     * @param  {type} $filepath description
     * @return {type}           description
     */
    public function getSharableLink($filePath){
        $this->sharableLinkHeaders["Content-Type"] = "application/json";
        $body = ["path"=>$filePath,"short_url"=>$this->TRUE];
        $body = json_encode($body);
        $request = new Request('POST', $this->secrets->getDropboxSharedLinkUrl(), $this->sharableLinkHeaders, $body);
        $response = $this->client->send($request);
        return $response->getBody();
    }

    /**
     * uploadAndObtainSharableLink - description
     *
     * @param  {type} $file      description
     * @param  {type} $directory description
     * @param  {type} $fileName  description
     * @return {type}            description
     */
    public function uploadAndObtainSharableLink($file,$fileName,$directory){
        $this->uploadFile($file,$fileName,$directory);
        $response = $this->getSharableLink($directory.$fileName);
        $response = json_decode($response, TRUE);
        return $response["url"];
    }
}
