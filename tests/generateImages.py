from PIL import Image
import os
for i in range(5500):
    if (i % 250 == 0 and i != 0):
        img = Image.new("RGB", (i, i), color = "red")
        img.save("images/" + str(i) + ".png")

print("success")
