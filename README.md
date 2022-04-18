<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Gaming App Backend
We're developing a backend for a party-finder fictional app. Our client needs an app that connects employees from different areas of the company. 

Our backend has to have the following:
- Users will be able to register/log/logout from the app. User & password required.
- Users will be able to create parties for any game.
- Users will be able to search parties according to their desired game.
- Users will be able to join and unjoin a party
- Users will be able to send messages in their party, and those ones will only be available to edit from its original user.
- Users will be able to update their profiles. 

### Database
![readmephoto](https://user-images.githubusercontent.com/96541489/163828458-62bce1f5-ae8a-4c60-9dba-7a8a899aa026.png)

### Endpoints


#### Users

Register an user (POST):
/api/users/add

Log as user (POST):
/api/users/log

Logout (POST):
/api/users/logout

Show my profile (user data) (GET):
/api/users/show/me

Show all users (GET):
/api/users/show/all

Show users by Id (GET):
/api/users/show/{id}

Show users by company area (GET):
/api/users/show/area

Update your user data (PUT):
/api/users/update/{id}

Delete user (DELETE):
/api/users/delete/{id}

    
#### Games

Show all games (POST):
/api/games/add

Show all games (GET):
/api/games/show/all

Show games by Id (GET):
/api/games/show/{id}

Update game data (PUT):
/api/games/update/{id}

Delete game (DELETE):
/api/games/delete/{id}

#### Parties

Show all parties (POST):
/api/parties/add

Show all parties (GET):
/api/parties/show/all

Show parties by Id (GET):
/api/parties/show/{id}

Show parties by game Id (GET):
/api/parties/show/game/{id}

Update party data (PUT):
/api/parties/update/{id}

Delete party (DELETE):
/api/parties/delete/{id}
    
#### Messages

Show all messages (POST):
/api/messages/add

Show all messages (GET):
/api/messages/show/all

Show messages by Id (GET):
/api/messages/show/{id}

Show messages by user Id (GET):
/api/messages/show/user/{id}

Show messages by party Id (GET):
/api/messages/show/party/{id}

Show messages by message Id (GET):
/api/messages/show/message/

Update message data (PUT):
/api/messages/update/{id}

Delete message (DELETE):
/api/messages/delete/{id}

#### Members
<b> Members are the users when they have joined a party. </b>

Show all members/(POST):
/api/members/add

Show all members (GET):
/api/members/show/all

Show members by Id (GET):
/api/members/show/{id}

Show members by party Id (GET):
/api/members/show/party/{id}

Delete all members from a party (DELETE):
/api/members/delete/party/{id}

Update member data (PUT):
/api/members/update/{id}

Delete member (DELETE):
/api/members/delete/{id}
   
###### Friends

Show all friends/(POST):
/api/friends/add

Show all friends (GET):
/api/friends/show/all

Show friend by Id (GET):
/api/friends/show/{id}

Update friend data (PUT):
/api/friends/update/{id}

Delete friend (DELETE):
/api/friends/delete/{id}

### Tecnologies used

This backend has been writen in PHP code and we have used the framework [Laravel](https://laravel.com/) to develop the backend. 
[Composer](https://getcomposer.org/) has been used as a deependency manager, and [jwt-auth](https://jwt-auth.readthedocs.io/en/develop/quick-start/) as the authentification system for the api. 
Heroku has been used for the deploy.

