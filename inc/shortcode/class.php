<?php
if (!class_exists('aiobtnShortcode')) {
	class aiobtnShortcode {
		public function shortcode($atts) {
			global $AIO_Buttons_Data;
			
			if(is_array($AIO_Buttons_Data) && array_key_exists('default_animation',$AIO_Buttons_Data)) {
				$default_animation = $AIO_Buttons_Data['default_animation'];
			} else {
				$default_animation = 'flash';
			}
			
			if(is_array($AIO_Buttons_Data) && array_key_exists('default_color',$AIO_Buttons_Data)) {
				$default_color = $AIO_Buttons_Data['default_color'];
			} else {
				$default_color = 'red';
			}
			
			if(is_array($AIO_Buttons_Data) && array_key_exists('default_size',$AIO_Buttons_Data)) {
				$default_size = $AIO_Buttons_Data['default_size'];
			} else {
				$default_size = 'small';
			}
			
			if(is_array($AIO_Buttons_Data) && array_key_exists('default_text',$AIO_Buttons_Data)) {
				$default_text = $AIO_Buttons_Data['default_text'];
			} else {
				$default_text = 'Download Now';
			}
			
			// Extract the attributes
			extract(shortcode_atts(array(
				'align' => 'none',
				'color' => $default_color,
				'icon' => 'none',
				'url' => '#',
				'animation' => $default_animation,
				'size' => $default_size,
				'target' => '_self',
				'text' => $default_text
				), $atts));
				
			// You can now access the attribute values
			switch($align) {
				case 'none':
					$wrapper = 'aio-button';
					break;
					
				case 'center':
					$wrapper = 'aio-button-center';
					break;
					
				case 'left':
					$wrapper = 'aio-button-left';
					break;

				case 'right':
					$wrapper = 'aio-button-right';
					break;				
			}
			
			switch($animation) {
				case 'flash':
					$sfx = 'aio-flash';
					break;

				case 'shake':
					$sfx = 'aio-shake';
					break;

				case 'bounce':
					$sfx = 'aio-bounce';
					break;

				case 'swing':
					$sfx = 'aio-swing';
					break;

				case 'pulse':
					$sfx = 'aio-pulse';
					break;
			}

			switch($color) {
				case 'yellow':
					$hue = 'aio-yellow';
					break;

				case 'red':
					$hue = 'aio-red';
					break;

				case 'blue':
					$hue = 'aio-blue';
					break;

				case 'black':
					$hue = 'aio-black';
					break;

				case 'orange':
					$hue = 'aio-orange';
					break;

				case 'green':
					$hue = 'aio-green';
					break;

				case 'purple':
					$hue = 'aio-purple';
					break;

				case 'gray':
					$hue = 'aio-gray';
					break;

				case 'brown':
					$hue = 'aio-brown';
					break;

				case 'pink':
					$hue = 'aio-pink';
					break;
			}
			
			switch($size) {
				case 'small':
					$size = '';
					break;
					
				case 'medium':
					$size = '-medium';
					break;
					
				case 'large':
					$size = '-large';
					break;
			}
			
			if($target == 'blank' || $target == '_blank') {
				$target = 'target="_blank" ';
			} else {
				$target = '';
			}
			
			if($icon == 'none') {
				$icon = '';
			} else {
				$icon = '<i class="icon-'.$icon.'"></i>';
			}

			return '<div class="'.$wrapper.'"><div class="'.$sfx.'"><a '.$target.'href="'.$url.'" class="'.$hue.''.$size.'" title="'.$text.'">'.$icon.$text.'</a></div></div>';
		}
	} // end class	
}
?>