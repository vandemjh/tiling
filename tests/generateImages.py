from PIL import Image
import os
import pathlib
for i in range(5500):
    if (i % 250 == 0 and i != 0):
        img = Image.new("RGB", (i, i), color = "red")
        img.save(str(pathlib.Path().absolute()) + "/images/" + str(i) + ".png")

print("success")
