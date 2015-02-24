<?php

/*
*
* This helper function allows you call "getImage()" and it either pulls the default
* featured image or even an image from a ACF custom field. It will even load a placeholder
* image if it can't find anything set.
*
*/

//#ASTODO document what is actually happening here

function getImage($imageSize='',$classes="",$imageArray = ''){
	
	global $_wp_additional_image_sizes;
	
	
	if($imageArray == ''){
		if (has_post_thumbnail()){
			//the_post_thumbnail($imageSize);
			
			//$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

			$thumb_id = get_post_thumbnail_id();
			
			
			$attrs = array(
				'class'	=> $classes
			);
			
			$image_attributes = wp_get_attachment_image_src( $thumb_id, $imageSize ); // returns an array

			$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
			
			if($alt == ""){
				
				$alt = get_the_title($thumb_id);
			}
			
			
			
			if($image_attributes[1] != $_wp_additional_image_sizes[$imageSize]['width'] || $image_attributes[2] != $_wp_additional_image_sizes[$imageSize]['height']){
			
			
			
				$image_attributes = wp_get_attachment_image_src( $thumb_id, 'full' ); // returns an array
			
				//echo("New Super crops");
				
				$url = $image_attributes[0];
				$width = $_wp_additional_image_sizes[$imageSize]['width'];
				$height = $_wp_additional_image_sizes[$imageSize]['height'];
				$crop = true;
				$retina = false;
				
				// Call the resizing function (returns an array)
				$image = matthewruddy_image_resize( $url, $width, $height, $crop, $retina );
				
				$imageTag = "<img src='".$image['url']."' class='$classes' />";
				
			}else{

				$imageTag = "<img src='".$image_attributes[0]."' alt='".$alt."' class='$classes' />";
			
			};
		
			
		}else{

			$imageTag = ("<img src='".get_bloginfo('template_directory')."/assets/images/no-$imageSize.jpg' class='$classes' />");
			
		};
	}else{
		//echo($imageArray['sizes'][$imageSize]);
		if(!empty($imageArray)){

			
			//I think this is for a gallery...
			if(isset($imageArray[0]) == 1){
				//echo "No alt tag";
				
				//print_r($imageArray);
				
				if($imageArray[0]['alt'] == ""){
					$altTag = $imageArray[0]['title'];
	
				}else{
					$altTag = $imageArray[0]['alt'];
					
				}
			
			
				$imageTag = "<img src='".$imageArray[0]['sizes'][$imageSize]."' alt='".$altTag."' class='$classes' />";
			}else{
				//echo "<pre>";
				//print_r($imageArray);
				//echo "</pre>";
				
				if($imageArray['alt'] == ""){
					$altTag = $imageArray['title'];
	
				}else{
					$altTag = $imageArray['alt'];
					
				}

				//added functionality for ACF image cropper
				if($imageSize != "crop"){
				
					$imageTag = "<img src='".$imageArray['sizes'][$imageSize]."' alt='".$altTag."' class='$classes' />";
				
					if($imageArray['sizes'][$imageSize.'-width'] != $_wp_additional_image_sizes[$imageSize]['width'] || $imageArray['sizes'][$imageSize.'-height'] != $_wp_additional_image_sizes[$imageSize]['height']){
					
						//echo("Second check no image");
						
						$url = $imageArray['url'];
						$width = $_wp_additional_image_sizes[$imageSize]['width'];
						$height = $_wp_additional_image_sizes[$imageSize]['height'];
						$crop = true;
						$retina = false;
						
						// Call the resizing function (returns an array)
						$image = matthewruddy_image_resize( $url, $width, $height, $crop, $retina );
	
						$imageTag = "<img src='".$image['url']."' alt='".$altTag."' class='$classes' />";
						
					}else{
						$imageTag = "<img src='".$imageArray['sizes'][$imageSize]."' alt='".$altTag."' class='$classes' />";
						
					
					};
				}else{

					$imageTag = "<img src='".$imageArray['url']."' alt='".$altTag."' class='$classes' />";
				}				
				
			}
		}else{
			$imageTag = "<img src='".get_bloginfo('template_directory')."/assets/images/no-$imageSize.jpg' class='$classes' />";
		};
	}
	
	
	return $imageTag;

};
