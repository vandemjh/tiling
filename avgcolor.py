# All Pokemon ripped by veekun.com/dex/downloads

from PIL import Image
import os

def getPixelData(file):
    img = Image.open('pokemon/' + file).convert('RGBA')
    pixels = list(img.getdata())

    #print(pixels)
    rAvg = 0
    gAvg = 0
    bAvg = 0
    count = 0

    for pixel in pixels:
        if (type(pixel) is int): # Some files with extra chars throw an error
            return "error at " + str(file) + str(img.getdata())
        if (pixel[3] != 0):
            rAvg += pixel[0]
            gAvg += pixel[1]
            bAvg += pixel[2]
            count += 1

    rAvg = rAvg / count
    gAvg = gAvg / count
    bAvg = bAvg / count

    return("\"" + file + "\" : [" + str(rAvg) +"," + str(gAvg) +"," + str(bAvg) + "]")


pokemon = open("pokemon.data","w")
pokemon.write("pokemon = {\n")
numberOfPokemon = len(os.listdir("pokemon/"))
pokemonCount = 0

for file in os.listdir("pokemon/"):
    if file.endswith(".png"):
        pokemon.write(getPixelData(file))
        #print i
        if (pokemonCount < numberOfPokemon - 1):
            pokemon.write(",\n")
        pokemonCount += 1

pokemon.write("\n};")
pokemon.close
