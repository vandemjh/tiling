# All emojis found at https://unicode.org/emoji/charts/full-emoji-list.html
# Creates JSON with all emojis
# Requires requests
import os
import urllib.request
import sys
# insert at 1, 0 is the script path (or '' in REPL)
# os.chdir('..')
# sys.path.insert(1, str(os.getcwd()))
sys.path.append('../')
from avgcolor import getPixelData

os.chdir('unicode')
print (os.getcwd())

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

count = 0
emojisOut.write("const emojis = {\n")
for table in emojiSplit.split("<table"):
    # rows += table.split("<tr")
    # count = 0
    for row in table.split("<tr"):
        # if (count % 4 == 0):
        for cell in row.split("<td"):
            for word in cell.split(" "):
                if ("src=" in word):
                    for src in word.split("\""):
                        if ("data:image/png" in src):
                            emojisOut.write(str(count) + " : " + src + "\n")
                            # urllib.request.urlretrieve(src, str(count) + ".png")
                            # Used for downloading images
                            count += 1
                            if (count > 100):
                                exit()
                # cells += column.split(" ");


emojisOut.write("}")
emojisIn.close
