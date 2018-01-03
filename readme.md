# Shisei-Sekai forum
0.5

Shisei sekai is a unofficial JoJo's Bizare Adventures fan made role-based forum. 

# Features

  - Roles, multiple per user, select one to display
  - Admin panel, to manage most of the contents
  - User panel, to display user "record card". Combat card is private, only staff can see it. Also, you can see it by clicking in user avatar in any post
  - Admin verification of user cards.
  - Shop, buy ~~useless~~ items.
  - Decide which ~~useless~~ items display to other users from your user panel.
  - Email confirmation
  - Real-time chat
 

### Why do this?

Why not?


### Requirements
* PHP >= 7.0
* nginx (recommended, don't use built-in server in production)
* npm
* Database engine (pref, PostgreSQL)
* Composer
* Redis
* NodeJs >= 9.1


### Installation
- Clone the repository and install the dependencies

```sh
$ git clone https://github.com/Shisei-Sekai/Laravel-Shisei
$ cd Laravel-Shisei
$ npm install
$ composer install
```

- Start socket.io server
```sh
$ cd nodejs
$ node server.js
```

- Configure email settings in .env file.

- Configure `POMF` settings in `.env` 
```
POMF_URL
POMF_CLIENT_TOKEN (optional)
POMF_CLIENT_SECRET (optional)
```
With the config of your pomf server (or not)

### TODO

- Messenger
- Events
- Badges
- ~~Store~~
- ~~Vendors~~


### Advice
This is an alpha release, still need to clean some things and reorganize them. Feel free to reorganize them yourself.

Also, since my main language is spanish, and it's also the main language of the "population" of the forum (or, at least, our targeted population), the templates are in that language.
If you want them translated to english, feel free to ask me o do it by yourself.

### Final Advice
> ORA!

### Screenshots

###### Admin panel

![Main page](https://u.rindou.moe/SnkKZEU45g7EcSd7h9Zk.png)

![Categories](https://u.rindou.moe/4PsmycfZLyHKI0Tm8hS6.png)