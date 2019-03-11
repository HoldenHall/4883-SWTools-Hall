#Holden Hall
#A06 - Emoji Scraper
#3-11-2019
"""
This program scrapes https://www.webfx.com/tools/emoji-cheat-sheet/ using
BeautifulScraper. After finding the emoji location the program gets the
image url. Then the image name is derived from the url path. The
requests library then takes the image url and saves the images(emojis)
in the current directory under the folder named "emojis".
"""
import os
from beautifulscraper import BeautifulScraper
import requests

url = 'https://www.webfx.com/tools/emoji-cheat-sheet/'

#Scrap website using BeautifulScraper
scraper = BeautifulScraper()
page = scraper.go(url)

for emoji in page.find_all("span",{"class":"emoji"}):
    image_path = emoji['data-src']
    print(url+image_path)
    full_url = url+image_path

    #Use split to create image name using url
    filename = full_url.split("/")[-1] 

    # save the image using requests library
    r = requests.get(full_url, stream=True)

    #save path: current directory\emojis\filename.png
    with open(os.getcwd()+"\\emojis\\"+filename, 'wb') as emoji:
        emoji.write(r.content) 
