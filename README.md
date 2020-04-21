# Tiling

Tiling is an app to redraw a given picture using a variety of smaller images.

## Under the hood
### Python
Python scripts are used to take the average RGB value of every pixel in an array of images.  The results are output in JSON which is used later on the client side.
### PHP
On the server, PHP is used to try to creating an image object from the URL.  If that fails the image is downloaded and converted to a png.
Next, each pixel of the image is read and output to the client in JSON.
### JavaScript
A Canvas element is used to display the closest image for each pixel.

## Average Pixel JSON

The average pixel files are JSON in the following format:

```
{
"link to image" : [average red, average blue, average green],
...
}
```

## Examples

![before](https://i.imgur.com/xDoQ91Q.jpg)

![after](https://i.imgur.com/qekyQRn.png)
