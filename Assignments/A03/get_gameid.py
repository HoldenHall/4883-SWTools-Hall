from beautifulscraper import BeautifulScraper
from pprint import pprint
import urllib
import json
import sys
from time import sleep
from random import shuffle

scraper = BeautifulScraper()

f = open("nfl_gameid.json","w")

years= [x for x in range(2009,2018)]
weeks= [x for x in range(1,17)]

pages = [x+1 for x in range(5)]

gameids = {"REG":{},"POST":{}}

delays = [.01,.02,.03,.04,.05]

for year in years:
        gameids["REG"][year] ={}
        for week in weeks:
                gameids["REG"][year][week] =[]
                url = "http://www.nfl.com/schedules/%s/REG%s" % (str(year),str(week))
                page = scraper.go(url)
                divs = page.find_all('div',{"class":"schedules-list-content"})
                for div in divs[:]:
                        gameids["REG"][year][week].append(div['data-gameid'])
                        shuffle(delays)
                        sleep(delays[0])

for year in years:
        gameids["POST"][year] ={}
        url = "http://www.nfl.com/schedules/%s/POST" % (str(year))
        page = scraper.go(url)
        divs = page.find_all('div',{"class":"schedules-list-content"})
        for div in divs[:]:
                gameids["POST"][year]= div['data-gameid']
                shuffle(delays)
                sleep(delays[0])

f.write(json.dumps(gameids))
