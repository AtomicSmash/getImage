# getImage


Package includes the excellent TimThumb alternative by Mathew Ruddy: https://github.com/MatthewRuddy/Wordpress-Timthumb-alternative

This helper function allows you call "getImage()" and it either pulls the default featured image or even an image from a ACF custom field. It will even load a placeholder image if it can't find anything set.

##How to use

###echo getImage($imageSize,$classes,$imageArray)

* $imageSize : please add the image sizes defined in your theme by 'add_image_size()'

* $classes : These passes classes directly to the final image tag for styling purposes.

* $imageArray : This is for an ACF image field.

##Placeholder images

If there is no image found a placeholder image will be loaded from the 'assets/images' directory in your theme folder.

> image showing theme name breakdown.

##Image resizing

By default, Wordpress doesn't handle some aspects of image resizing very well. For example, if there is a preset image that is 500x300 and the user uploads a smaller image that is 400x400 wordpress won't resize your image. Generally this is probably a stance to take, it stops lower resolution images being added to a site.

Yet there are some instances where this is needed, and it's far more acceptaple to have a lower resolution image that is the right aspect ratio, than a lower resolution image is completly the wrong sizing.

To combat this, we've included the TimThumb alternative by Mathew Ruddy.