#Holden Hall
#3-6-2019
"""
This program takes an image and converts it to an "ascii picture" by determining the appropriate "ascii" compared to it's darkness.
Then coloring the "ascii" to match the original picture.
"""
import os
import sys
from PIL import Image, ImageDraw, ImageFont, ImageFilter


"""
img_to_ascii:
Does most of the work, first grabs the rgb values of all the pixels in the input image and puts them in pixel_list.
Next it converts the image to grayscale, and creates a new image multiplying the original size by 6(otherwise it wouldn't show all of it).
Then it's gets font information from the user. Aftewards the program can use the avg rgb of the grayscale image to apply a character
to match the darkness of the original pixel. Next it uses the characters and places them on the image using pixel list to color the 
characters. After getting the output path from the user the program saves the image and stops.
"""



def img_to_ascii(**kwargs):

    ascii_chars = [ "曜", '数', '同', '母', '日', '十', '八', '口', '二', '一', '.']
    width = kwargs.get('width',200)
    path = kwargs.get('path',None)
    im = Image.open(path)
    im = resize(im,width)
    w,h = im.size

    pixel_list =[]

    x = 0
    y = 0

    for y in range(h):
        for x in range(w):
            pixel_list.append(im.getpixel((x,y)))

    im_g = im.convert("L") # convert to grayscale

    imlist = list(im_g.getdata())

    newImg = Image.new('RGBA', (w*6,h*6), (255,255,255,255))

    font_directory = input("Enter Font Directory\n")
    font_name = input("Enter Font Name(and file extension--.ttf)\n")
    font_size = input("Enter Font Size\n")

    fnt = ImageFont.truetype(font_directory+font_name, int(font_size))

    drawOnMe = ImageDraw.Draw(newImg)

    i = 1
    x = 0
    y = 0

    for val in imlist:
        uni = ascii_chars[val // 25]      
        drawOnMe.text((x,y), uni, font=fnt, fill=pixel_list[i-1])

        i += 1

        #for width positioning
        x += 6

        if i % width == 0:
            #new line
            y += 6

            #reset x
            x = 0

    newImg.show()

    output_directory = input("Enter Output Directory\n")
    output_name = input("Enter Output Image Name(and file extension--.png)\n")
    newImg.save(output_directory+output_name)

    #ends program
    return 0



#I did not make any changes to this function
def resize(img,width):

    """

    This resizes the img while maintining aspect ratio. Keep in 

    mind that not all images scale to ascii perfectly because of the

    large discrepancy between line height line width (characters are 

    closer together horizontally then vertically)

    """

    

    wpercent = float(width / float(img.size[0]))

    hsize = int((float(img.size[1])*float(wpercent)))

    img = img.resize((width ,hsize), Image.ANTIALIAS)



    return img

"""
Main: gets the input path, by asking the user for the input directory and name
then calls img_to_ascii function
"""

if __name__=='__main__':

    input_directory = input("Enter Image Directory(end with /)\n")
    input_name = input("Enter Image Name(and file extension--.png)\n")
    path = input_directory+input_name

    Ascii = img_to_ascii(path=path,width=200)
