This program scrapes https://www.webfx.com/tools/emoji-cheat-sheet/ using
BeautifulScraper. After finding the emoji location the program gets the
image url. Then the image name is derived from the url path. The
requests library then takes the image url and saves the images(emojis)
in the current directory under the folder named "emojis".
