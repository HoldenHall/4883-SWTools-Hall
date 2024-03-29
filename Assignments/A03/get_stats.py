from beautifulscraper import BeautifulScraper
from pprint import pprint
import urllib
import json
import sys
from time import sleep
from random import shuffle

scraper = BeautifulScraper()

with open('nfl_gameid.json', 'r') as f:
    data = json.load(f)

years= [x for x in range(2009,2018)]
weeks= [x for x in range(1,17)]
teams= [x for x in range(0,16)]
#print(data["REG"])

for year in years:
        for week in weeks:
            for team in teams:
                try:
                   sgameid = gameid = data["REG"][str(year)][str(week)][team]
                   f = open(gameid+".json","w")
                except:
                    pass
                else:
                    url = "http://www.nfl.com/liveupdate/game-center/%s/%s_gtd.json" % (sgameid,gameid)
                    page = scraper.go(url)
                    f.write(json.dumps(page.text))

for year in years:
            for team in teams:
                try:
                   sgameid = gameid = data["POST"][str(year)]
                   f = open(gameid+".json","w")
                except:
                    pass
                else:
                    url = "http://www.nfl.com/liveupdate/game-center/%s/%s_gtd.json" % (sgameid,gameid)
                    page = scraper.go(url)
                    f.write(json.dumps(page.text))
