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
 

### Why do this?

Why not?


### Requirements
* PHP >= 7.0
* nginx (recommended, don't use built-in server in production)
* npm
* Database engine (pref, PostgreSQL)
* Composer


### Installation
- Clone the repository, 

```sh
$ git clone https://github.com/Shisei-Sekai/Laravel-Shisei
$ cd Laravel-Shisei
$ npm install
$ composer install
```

Configure email settings in .env file.

You'll also need to configure the `.env` file. In this repository, there's a example.
For user avatar upload, set up this variables.
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

### Final Advice
> ORA!

