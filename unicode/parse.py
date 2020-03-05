# All emojis found at https://unicode.org/emoji/charts/full-emoji-list.html
# Creates JSON with all emojis
# Requires requests
import os
import urllib.request
import sys
# insert at 1, 0 is the script path (or '' in REPL)
# os.chdir('..')
# sys.path.insert(1, str(os.getcwd()))
sys.path.append("../")
from avgcolor import getPixelData

# print (os.getcwd())

# URL = "https://unicode.org/emoji/charts/full-emoji-list.html"
# page = requests.get(URL)
# print(page)

emojisIn = open("Full Emoji List, v13.0.html","r") #  HTML Tables.html
emojisOut = open("emoji.data","w") # Full Emoji List, v13.0.html

emojiSplit = emojisIn.read()
# emojiSplit = emojiSplit.split("<table")
# rows = []
# columns = []
# cells = []
COLUMN = 1

colCount = 0
count = 0
toBreak = False

emojisOut.write("const emojis = {\n")
for table in emojiSplit.split("<table"):
    # rows += table.split("<tr")
    # colCount = 0
    for row in table.split("<tr"):
        # if (colCount % 4 == 0):
        toBreak = False
        colCount = 0
        for cell in row.split("<td"):
            if (toBreak):
                break
            for word in cell.split(" "):
                if (toBreak):
                    break
                if ("src=" in word):
                    for src in word.split("\""):
                        if ("data:image/png" in src): # TODO un-hard code this
                            colCount += 1
                            if (colCount == COLUMN):
                                urllib.request.urlretrieve(src, "temp" + ".png")
                                # Used for downloading images
                                emojisOut.write(",\n\"" + src + "\":[" + getPixelData("temp.png") + "]")
                                count += 1
                                if (count >= 45):
                                    exit()
                            else:
                                toBreak = True
                                break

print(count)
emojisOut.write("\n}\n")
emojisIn.close
emojisOut.close
