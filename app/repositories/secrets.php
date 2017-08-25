<?php namespace App\Repositories;

use Illuminate\Http\Response;
use App;


/**
 * Stores and provides all secrets :-)
 */
class Secrets{

    // FCM Constants
    protected $fcmUrl = "";
    protected $fcmAuthHeader = "";
    protected $debugFcmToken = "";

    // Dropbox Constants
    protected $dropboxUploadUrl = "";
    protected $dropboxSharedLinkUrl = "";
    protected $dropboxAuthHeader = "";

    public function __construct(){

        /**
         * TODO: Externalize these secrets to external file
         */
        $this->fcmUrl = "https://fcm.googleapis.com/fcm/send";
        $this->fcmAuthHeader = env('FCM_AUTH_KEY',"");
        $this->debugFcmToken = env('FCM_DEBUG_TOKEN',"");

        $this->dropboxUploadUrl = "https://content.dropboxapi.com/2/files/upload";
        $this->dropboxSharedLinkUrl = "https://api.dropboxapi.com/2/sharing/create_shared_link";
        $this->dropboxAuthHeader = env('DROPBOX_AUTH_KEY',"");
    }

    /**
     * getFcmHeaderAuthKey - description
     *
     * @return {type}  description
     */
    public function getFcmHeaderAuthKey(){
        return $this->fcmAuthHeader;
    }

    /**
     * getFcmUrl - description
     *
     * @return {type}  description
     */
    public function getFcmUrl(){
        return $this->fcmUrl;
    }

    /**
     * getDebugFcmToken - description
     *
     * @return {type}  description
     */
    public function getDebugFcmToken(){
        return $this->debugFcmToken;
    }

    /**
     * getDropboxUploadUrl - description
     *
     * @return {type}  description
     */
    public function getDropboxUploadUrl(){
        return $this->dropboxUploadUrl;
    }

    /**
     * getDropboxSharedLinkUrl - description
     *
     * @return {type}  description
     */
    public function getDropboxSharedLinkUrl(){
        return $this->dropboxSharedLinkUrl;
    }

    /**
     * getDropboxAuthHeader - description
     *
     * @return {type}  description
     */
    public function getDropboxAuthHeader(){
        return $this->dropboxAuthHeader;
    }
}
