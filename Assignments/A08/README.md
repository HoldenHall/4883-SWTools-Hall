This program takes an input_folder of subimages resizes them to a specific size, than gets the dominant color of all the sub images, afterwards putting them into a picture_dominant_color list. The program then takes the input and then adds _mosiac.png to the end of it.
The input image is opened and it gets itterated over. It then compares each pixel to the picture_dominant_color list to get the closest matching subimage to the pixel color. The delta will increase if no image is found. The new mosiac is then saved to the output_folder destination.

Only works with jpg images,then outputs png.

Sample input:
```
$ python mosaic.py input_folder=serial_experiments_lain size=16 input=4.jpg output_folder=output
```
"input_folder" needs to be a folder name in downloads, (couldn't get "\\" to work with **kwargs)
serial_experiments_lain is a folder in the downloads folder.
Next the size of the image, this has to be smaller or equal to the subimage becuase the subimages get resized.
Next "input" is a file in the input folder.
"output_folder" needs to be a folder in the current directory.
