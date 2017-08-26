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
HEADERS  : "Authorization: Bearer <get access token>" \
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
### Firebase Cloud Messaging API
### Google Maps API (Static)


## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## How to contribute
Coding style

## Contributors

**Shriyansh Gautam**

## Security Vulnerabilities

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
