Running get_gameid.py gets the gameids and puts them into a json file(nfl_gameid.json).
get_stats.py uses nfl_gameid.json to input the gameids into http://www.nfl.com/liveupdate/game-center/%s/%s_gtd.json.
I couldn't get get_stats.py to grab the json file, instead it grabs the text from the scrapped page. The json file it creates isn't
fully json and contains escape characters.
