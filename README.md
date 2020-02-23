# Apex Legends nightbot

Apex Legends chat command for any Twitch.tv bot that has a an URI fetch command system.

**Works with:** *[Nightbot, Ankhbot, Deepbot](https://blog.thomassen.xyz/custom-apis/), Phantombot and probably more unknown.* 

Apex Legends Twitch streamers, this is a PHP script that uses the API statistics and gathers end-points of the Apex Legends Rank stats and forwards them to [Nightbot](http://nightbot.tv).

This server-side script is making use of Nightbot's dynamic response system (mostly [$(urlfetch)](https://docs.nightbot.tv/commands/variables/urlfetch)) with which you are able to fetch the resources forwarded by my Heroku App.

Do not worry! Nothing is saved server-side.

## How to add commands to Nightbot

With chat:  
["!commands add !command_name command_response"](https://docs.nightbot.tv/commands/commands)  
With interface:  
https://beta.nightbot.tv/commands/custom  

## Deployment to Heroku

replace **$apikey = '';** in **apexstats.php** your api key. [GET API KEY HERE](https://api.mozambiquehe.re/getkey)
replace **$platform = '';** with X1, PC, or PS4
replace **$player = '';** with your username


    $ git init
    $ git add -A
    $ git commit -m "Initial commit"

    $ heroku create
    $ git push heroku master

    $ heroku run python manage.py migrate

See also, a [ready-made application](https://github.com/heroku/python-getting-started), ready to deploy.

## Credit

**Giuthub** https://github.com/HugoDerave/ApexLegendsAPI

**Discord** https://discord.gg/TZ4Y9EB


