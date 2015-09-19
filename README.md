# Respio
An easy way of having pixel perfect responsive images on every device.

  - Retina ready
  - No 3rd party cloud service needed
  - Works with images and background images

### Version
1.0.0

### Demo
http://dev.janwagner-design.de/respio/

### Requires

* [php]
* [jQuery]
* [Timthumb] - or any other php image resize alternative

## Responsive images
#### 1. Markup
```sh
<img data-lazy-src="timthumb.php?src=yourimage.jpg" width="<?php echo getimagesize('yourimage.jpg')[0] ;?>">
```
We need to remove the src attribute of your image and replace it by a new custom data attribute to prevent it from loading. Your images should have a max-width of 100% and should also be wider than your content/container.
#### 2. Script
```sh
function responsiveImages() {
  $('[data-lazy-src]').each(function () {
      var $img = $(this);
      var $devicePixelRatio = 1;
      if(window.devicePixelRatio > 1) {
          $devicePixelRatio = window.devicePixelRatio
      };
      $imgWidth = $img.width() * $devicePixelRatio;
      $img.attr('src',$img.data('lazy-src') + '&w=' + $imgWidth);
  });
}
```
We can also load a new generatrd image on window resize.  
```sh
$(window).on('resize', function() {
    setTimeout(responsiveImages, 2000);
});
```

We use jQuery to calculate the actual width of the image on your screen. Timthumb will create new pixel perfect images for you and also x2 images for retina devices. It is also possible to use any other timthumb parameter to manipulate your ne image.  
#### 3. Result
```sh
<img src="timthumb.php?src=yourimage.jpg&w=YOUR-RESPONSIVE-IMAGE-WIDTH">
```
## Responsive background images
#### 1. Markup
```sh
<div data-lazy-bg-src="timthumb.php?src=yourimage.jpg">
```
#### 2. Script
```sh
function responsiveImages() {
  $('[data-lazy-bg-src]').each(function () {
      var $element = $(this);
      var $devicePixelRatio = 1;
      if(window.devicePixelRatio > 1) {
          $devicePixelRatio = window.devicePixelRatio
      };
      $imgWidth = $element.width() * $devicePixelRatio;
      $element.css('background-image', 'url(' + $element.data('lazy-bg-src') + '&w=' + $imgWidth + ')');
  });
}
```
#### 3. Result
```sh
<div style="background-image:url(timthumb.php?src=yourimage.jpg&w=YOUR-RESPONSIVE-IMAGE-WIDTH)">
```

[//]: # 
   [timthumb]: <http://www.binarymoon.co.uk/2010/08/timthumb/>
   [jQuery]: <http://jquery.com/>
   [php]: <https://secure.php.net/>
