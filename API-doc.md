 # SnTC-Streamify
 
 ## Register User
 + URL: http://sntc.online/app/register
 + Method Type: POST
 + Request: (RollNo should be unique)
 ```json
 {
 	"name":"Akshay",
 	"rollNo":16123004,
 	"email":"contact@imakshay.com",
 	"contact":"7510099853",
 	"fcmToken":"f39EdXwrcsw:APA91bHA2sVz_wolG0jGHPudsmEiVawdv3C4NP1KIkey9TOa3KA8iJOVy8Sg9ZYyBAFYQA8CbbO0Y3BBIzTkoptUtpAq213p4KBiDe7BDKI248lSD7dF4CVVhaXBLb7CcZUY-bvL-DnIqFFzYX6bDXi25E_35F05Lw"
 }
 ```
 + Response:
 ```json
 {
     "status": "OK",
     "data": {
         "id": 2,
         "name": "Akshay",
         "email": "contact@imakshay.com",
         "contact": "7510099853",
         "rollNo": 16123004,
         "fcmToken": "f39EdXwrcsw:APA91bHA2sVz_wolG0jGHPudsmEiVawdv3C4NP1KIkey9TOa3KA8iJOVy8Sg9ZYyBAFYQA8CbbO0Y3BBIzTkoptUtpAq213p4KBiDe7BDKI248lSD7dF4CVVhaXBLb7CcZUY-bvL-DnIqFFzYX6bDXi25E_35F05Lw"
     }
 }
 
 ```
 
 ## Get Events
 + URL: http://sntc.online/app/get_events
 + Method Type: POST
 + Request:
 ```json
 {
     "rollNo":16123004,
     "last_event_id":3
 }
 
 ```
 + Response:
 ```json
 {
     "status":"OK",
     "status_code":200,
     "events":[
         {
             "id":4,
             "...":"..."
         },
         {
             "id":5,
             "...":"..."
         } 
     ]
 }
 
 ```
 
 ## Subscribe to a Stream
 + URL: http://sntc.online/app/subscribe
 + Method Type: POST
 + Request:
 ```json
 {
 	"rollNo":16123004,
 	"stream_id":1
 }
 ```
 + Response:
 ```json
 {
     "status_code": "1",
     "status": "OK",
     "data": "something"
 }
 ```
 
 ## Unsubscribe Streams
 + URL: http://sntc.online/app/get_streams
 + Method Type: POST
 + Request:
 ```json
 {
 	"rollNo":16123004,
 	"stream_id":1
 }
 ```
 + Response:
 ```json
 {
     "status_code": "1",
     "status": "OK",
     "data": {
         "streams": [
             {
                 "id": 1,
                 "title": "Demo Title",
                 "subtitle": "Demo SubTitle",
                 "description": "Demo description",
                 "image": "",
                 "author_id": 1,
                 "created_at": "2018-07-16 11:25:50",
                 "updated_at": "2018-07-16 11:25:50",
                 "is_subscribed": false,
                 "author": {
                     "id": 1,
                     "name": "Akshay Sharma",
                     "email": "akshay@akshay.com",
                     "contact": "7510099853",
                     "image": "",
                     "created_at": "2018-07-16 11:19:46",
                     "updated_at": "2018-07-16 11:19:46"
                 },
                 "position_holders": [],
                 "bodies": []
             },
             {
                 "id": 2,
                 "title": "Demo Title2",
                 "subtitle": "Demo SubTitle2",
                 "description": "Demo description2",
                 "image": "",
                 "author_id": 1,
                 "created_at": "2018-07-16 11:25:50",
                 "updated_at": "2018-07-16 11:25:50",
                 "is_subscribed": true,
                 "author": {
                     "id": 1,
                     "name": "Akshay Sharma",
                     "email": "akshay@akshay.com",
                     "contact": "7510099853",
                     "image": "",
                     "created_at": "2018-07-16 11:19:46",
                     "updated_at": "2018-07-16 11:19:46"
                 },
                 "position_holders": [],
                 "bodies": []
             }
         ]
     }
 }
 ```
 
 ## Get User Subscribed Streams
 + URL: http://sntc.online/app/get_streams
 + Method Type: POST
 + Request:
 ```json
 {
 	"rollNo":16123004
 }
 ```
 + Response:
 ```json
 {
     "status_code": "1",
     "status": "OK",
     "data": {
         "streams": [
             {
                 "id": 1,
                 "title": "Demo Title",
                 "subtitle": "Demo SubTitle",
                 "description": "Demo description",
                 "image": "",
                 "author_id": 1,
                 "created_at": "2018-07-16 11:25:50",
                 "updated_at": "2018-07-16 11:25:50",
                 "is_subscribed": true,
                 "author": {
                     "id": 1,
                     "name": "Akshay Sharma",
                     "email": "akshay@akshay.com",
                     "contact": "7510099853",
                     "image": "",
                     "created_at": "2018-07-16 11:19:46",
                     "updated_at": "2018-07-16 11:19:46"
                 },
                 "position_holders": [],
                 "bodies": []
             }
         ]
     }
 }
 ```
 
 ## Get Notifications
 + URL: http://sntc.online/app/get_notifications
 + Method Type: POST
 + Request:
 ```json
 {
     "rollNo":16123004,
     "last_notification_id":5
 }
 
 ```
 + Response:
 ```json
 {
     "status":"OK",
     "status_code":200,
     "events":[
         {
             "id":6,
             "...":"..."
         },
         {
             "id":7,
             "...":"..."
         } 
     ]
 }
 
 ```
 
 ## Create a post
 + URL: http://sntc.online/app/post
 + Method Type: POST
 + Request:
 ```json
 {
     "rollNo":16123004,
     "title":"Demo title",
     "type":"some string",
     "post_content":"Enter post contents here"
 }
 ```
 + Response:
 ```json
 {
     "status":"OK"
 }
 
 ```