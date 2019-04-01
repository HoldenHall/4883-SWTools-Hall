#Holden Hall
#4-1-2019
#A08
from dominant_color import get_dominant_colors
from PIL import Image, ImageDraw, ImageFont, ImageFilter

import sys
import os

def process_argv(args):
    """Takes arguments of type k=v and places them into 
    a dictionary. Arguments must ALL be k=v and not have
    any spaces.
    
    Example:
        python3 program.py key1=val1 key2=val2 key3=val3

        results in:

        {key1:val1,key2:val2,key3:val3}

    Arguments:
        argv   -- [list] sys.argv list of arguments
    Returns:
        dictionary
    """
    argd = {}
    for arg in args[1:]:
        k,v = arg.split('=')
        argd[k] = v
    return argd
def resize(img,width):

        """

        This resizes the img while maintining aspect ratio. Keep in 

        mind that not all images scale to ascii perfectly because of the

        large discrepancy between line height line width (characters are 

        closer together horizontally then vertically)

        """

    

        img = img.resize((width ,width), Image.ANTIALIAS)



        return img


if __name__ == '__main__':
    
    argd ={}
    picture_dominant_color = {}
    argd = process_argv(sys.argv)
    image_list = []
    path = (os.getcwd()+"\downloads\\"+argd['input_folder'])
    image_list=os.listdir(path)

    #gets subimage dominant color then stores in picture_dominant_color[]
    for x in range(0,len(image_list)):
        path = (os.getcwd()+"\downloads\\"+argd['input_folder']+"\\"+image_list[x])
        im = Image.open(path)
        im = resize(im,int(argd['size']))
        im.save(path) 
        colors = get_dominant_colors(path)
        percent_rgb = {}
        for i in range(0,3):
            #get largest percent dominant color
            percent_rgb[float(colors[i]['percent'])] = (colors[i]['rgb'])

        picture_dominant_color[image_list[x]] = percent_rgb[max(percent_rgb)]



    path = (os.getcwd()+"\input\\"+argd['input'])

    filename = os.path.basename(path)
    name,ext = filename.split('.')
    #I can only get pil to save as png
    newname = name+'_mosaic'+'.png'

    im = Image.open(path)
    im = resize(im,100)
    w,h = im.size
    #get all picture pixel values then store in pixel_list
    pixel_list =[]
    x = 0
    y = 0
    for y in range(h):
        for x in range(w):
            pixel_list.append(im.getpixel((x,y)))
    imlist = list(im.getdata())

    newImg = Image.new('RGBA', (w*int(argd['size']),h*int(argd['size'])), (255,255,255,255))
    i = 1
    x = 0
    y = 0
    for val in imlist:
        rgb = pixel_list[i-1]
        flag = False
        delta = 20

        while(flag == False):
            for a in range(0,len(image_list)):
                    #compare rgb values with delta
                    if((picture_dominant_color[image_list[a]][0]>=rgb[0]-delta)and(picture_dominant_color[image_list[a]][0]<=rgb[0]+delta)and
                    (picture_dominant_color[image_list[a]][1]>=rgb[1]-delta)and(picture_dominant_color[image_list[a]][1]<=rgb[1]+delta)and
                    (picture_dominant_color[image_list[a]][2]>=rgb[2]-delta)and(picture_dominant_color[image_list[a]][2]<=rgb[2]+delta)):
                        flag = True
                        similar_image = (image_list[a])
                        break

            delta = delta + 10


        sub = Image.open(os.getcwd()+"\downloads\\"+argd['input_folder']+"\\"+similar_image)
        #paste subimage on input image
        newImg.paste(sub,(x,y))   
        i += 1
        x += int(argd['size'])

        if i % w == 0:
            y += int(argd['size'])
            x = 0

    newImg.show()
    newImg.save(os.getcwd()+"\\"+argd['output_folder']+"\\"+newname)
    










