# SnTC Streamify Laravel Web Server

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

## Installation
### Docker

Ubuntu 16.04 : [Follow this tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04)

## Conponents
### Docker
### Laravel 5.4
### MySql
### Naginx

## APIs Used
### Dropbox API
We have used Dropbox API v2 is a set of HTTP endpoints for this app

**[/upload](https://www.dropbox.com/developers/documentation/http/documentation#files-upload)** - for uploading files

```
URL : https://content.dropboxapi.com/2/files/upload
REQUEST TYPE : HTTP Post
HEADERS  : "Authorization: Bearer <access token>"
           "Dropbox-API-Arg: {"path": "/Homework/math/Matrices.txt","mode": "add","autorename": true,"mute": false}"
           "Content-Type: application/octet-stream"

            Options
            path: String(pattern="(/(.|[\r\n])*)|(ns:[0-9]+(/.*)?)|(id:.*)") Path in the user's Dropbox to save the file.

            mode: WriteMode Selects what to do if the file already exists. The default for this union is add.

            autorename: Boolean If there's a conflict, as determined by mode, have the Dropbox server try to autorename
            the file to avoid conflict. The default for this field is False.

            client_modified: Timestamp(format="%Y-%m-%dT%H:%M:%SZ")? The value to store as the client_modified timestamp.  
            Dropbox automatically records the time at which the file was written to the Dropbox servers. It can also record an
            additional timestamp, provided by Dropbox desktop clients, mobile clients, and API apps of when the file was
            actually created or modified. This field is optional.

            mute: Boolean Normally, users are made aware of any file modifications in their Dropbox account via
            notifications in the client software. If true, this tells the clients that this modification shouldn't result in a
            user notification. The default for this field is False.

BODY : file as binary data

```

**[/create_shared_link](https://www.dropbox.com/developers/documentation/http/documentation#sharing-create_shared_link)** - for getting a sharable link to the file

```
URL : https://api.dropboxapi.com/2/sharing/create_shared_link
REQUEST TYPE : HTTP Post
HEADERS : "Authorization: Bearer <access token>"
          "Content-Type: application/json"
BODY : {
           "path": "/Homework/Math/Prime_Numbers.txt",
           "short_url": false
       }

       Options
       path: String The path to share.

       short_url: Boolean Whether to return a shortened URL. The default for this field is False.

       pending_upload: PendingUploadMode? If it's okay to share a path that does not yet exist, set this to either
       PendingUploadMode.file or PendingUploadMode.folder to indicate whether to assume it's a file or folder. This field is
       optional.
```

### Firebase Cloud Messaging API

**[Server setup Doc](https://firebase.google.com/docs/cloud-messaging/server)**

```
URL : https://fcm.googleapis.com/fcm/send
HEADER : "Content-Type : application/json"
         "Authorization : key=AIzaSyZ-1u...0GBYzPu7Udno5aA
BODY : { "data": {
             "score": "5x1",
             "time": "15:10"
           },
           "to" : "bk3RNwTe3H0:CI2k_HHwgIpoDKCIZvvDMExUdFQ3P1..."
           "registration_ids" :["id1","id2",.....]
       }

       Options
       data : JSON data to be sent to user device
       to : Firebase Token of the user (for sending notification to single user only)
       registration_ids : array to Firebase Tokens (for sending notification to multiple users)

```

### Google Maps API (Static)

**[Statis Map Doc](https://developers.google.com/maps/documentation/static-maps/intro)**
```
URL : https://maps.googleapis.com/maps/api/staticmap?parameters
```

### JQuery Location Picker

**[Location Picker Docs](http://logicify.github.io/jquery-locationpicker-plugin/)**

[Missing API Key issue](https://github.com/Logicify/jquery-locationpicker-plugin/issues/85) - just enable the Javascript API and use the previous key no need to generate new key

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## How to contribute
Coding style

## Contributors

**Shriyansh Gautam**

## Security Vulnerabilities

## License

This project is licensed under the Apache License - see the [LICENSE](LICENSE.txt) file for details
