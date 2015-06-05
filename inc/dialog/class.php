<?php
if (!class_exists('aiobtnDialog')) {

	class aiobtnDialog {
	
		public function ajax_aiobtn_dialog() {
			global $AIO_Buttons_Data;
			global $AIO_Buttons_Path;
			
			if (!wp_verify_nonce( $_REQUEST['aiobtn_dialog_nonce'], 'aiobtn_dialog')) {
				die(__('We\'re sorry, something went wrong with your request. Please contact support for further assistance.','aiobtn'));
			}
			
			?>
			<!DOCTYPE HTML>
			<html lang="en-US">
				<head>
					<title><?php _e('All In One Buttons','aiobtn'); ?></title>
					<meta charset="UTF-8">
					<!-- StyleSheets -->
					<link href="<?php echo $AIO_Buttons_Path . '/css/dialog.css' ?>" rel="stylesheet" type="text/css" />
					<link href="<?php echo $AIO_Buttons_Path . '/css/display.css' ?>" rel="stylesheet" type="text/css" />
					<!-- JavaScript -->
					<script type="text/javascript" src="<?php echo $AIO_Buttons_Path . '/js/libs/jquery-1.8.3.min.js' ?>"></script>
					<script type="text/javascript" src="<?php echo $AIO_Buttons_Path . '/js/libs/tiny_mce_popup.js' ?>"></script>					
					<script type="text/javascript" src="<?php echo $AIO_Buttons_Path . '/js/dialog.min.js' ?>"></script>
				</head>
				<body class="aiobtnWindow">
					<form id="aiobtn_Form">
						<p class="header-form">
							<label><?php _e('CREATE A BUTTON','aiobtn'); ?></label>
						</p>
						<div id="aiobtn_Options">
						<?php
							$html = '';
							if(is_array($AIO_Buttons_Data) && array_key_exists('default_animation',$AIO_Buttons_Data)) {
								$default_animation = $AIO_Buttons_Data['default_animation'];
							} else {
								$default_animation = 'flash';
							}
							$html .= $this->select_option('aiobtn_animation',__('ANIMATION:','aiobtn'),array('none' => __('None','aiobtn'),'flash' => __('Flash','aiobtn'),'bounce' => __('Bounce','aiobtn'),'pulse' => __('Pulse','aiobtn'),'shake' => __('Shake','aiobtn'),'swing' => __('Swing','aiobtn')),$default_animation);
							$html .= $this->select_option('aiobtn_align',__('ALIGNMENT:','aiobtn'),array('none' => __('None','aiobtn'),'center' => __('Center','aiobtn'),'left' => __('Left','aiobtn'),'right' => __('Right','aiobtn')),'none');
							if(is_array($AIO_Buttons_Data) && array_key_exists('default_color',$AIO_Buttons_Data)) {
								$default_color = $AIO_Buttons_Data['default_color'];
							} else {
								$default_color = 'red';
							}
							$html .= $this->select_option('aiobtn_color',__('COLOR:','aiobtn'),array('black' => __('Black','aiobtn'),'blue' => __('Blue','aiobtn'),'brown' => __('Brown','aiobtn'),'gray' => __('Gray','aiobtn'),'green' => __('Green','aiobtn'),'orange' => __('Orange','aiobtn'),'pink' => __('Pink','aiobtn'),'purple' => __('Purple','aiobtn'),'red' => __('Red','aiobtn'),'yellow' => __('Yellow','aiobtn')),$default_color);
							if(is_array($AIO_Buttons_Data) && array_key_exists('default_size',$AIO_Buttons_Data)) {
								$default_size = $AIO_Buttons_Data['default_size'];
							} else {
								$default_size = 'small';
							}
							$html .= $this->select_option('aiobtn_size',__('SIZE:','aiobtn'),array('small' => __('Small','aiobtn'),'medium' => __('Medium','aiobtn'),'large' => __('Large','aiobtn')),$default_size);
							$html .= $this->select_option('aiobtn_icon',__('ICON:','aiobtn'),array('none' => __('No icon','aiobtn'),'glass' => __('Glass icon','aiobtn'),'music' => __('Music icon','aiobtn'),'search' => __('Search icon','aiobtn'),'envelope' => __('Envelope icon','aiobtn'),'heart' => __('Heart icon','aiobtn'),'star' => __('Star icon','aiobtn'),'star-empty' => __('Empty star icon','aiobtn'),'user' => __('User icon','aiobtn'),'film' => __('Film icon','aiobtn'),'th-large' => __('Large table header icon','aiobtn'),'th' => __('Table header icon','aiobtn'),'th-list' => __('Table header list icon','aiobtn'),'ok' => __('Ok icon','aiobtn'),'remove' => __('Remove icon','aiobtn'),'zoom-in' => __('Zoom-in icon','aiobtn'),'zoom-out' => __('Zoom-out icon','aiobtn'),'off' => __('Off icon','aiobtn'),'signal' => __('Signal icon','aiobtn'),'cog' => __('Cog icon','aiobtn'),'trash' => __('Trash icon','aiobtn'),'home' => __('Home icon','aiobtn'),'file' => __('File icon','aiobtn'),'time' => __('Time icon','aiobtn'),'road' => __('Road icon','aiobtn'),'download-alt' => __('Download alternative icon','aiobtn'),'download' => __('Download icon','aiobtn'),'upload' => __('Upload icon','aiobtn'),'inbox' => __('Inbox icon','aiobtn'),'play-circle' => __('Play circle icon','aiobtn'),'repeat' => __('Repeat icon','aiobtn'),'refresh' => __('Refresh icon','aiobtn'),'list-alt' => __('List alternative icon','aiobtn'),'lock' => __('Lock icon','aiobtn'),'flag' => __('Flag icon','aiobtn'),'headphones' => __('Headphones icon','aiobtn'),'volume-off' => __('Volume off icon','aiobtn'),'volume-down' => __('Volume down icon','aiobtn'),'volume-up' => __('Volume up icon','aiobtn'),'qrcode' => __('QR code icon','aiobtn'),'barcode' => __('Barcode icon','aiobtn'),'tag' => __('Tag icon','aiobtn'),'tags' => __('Tags icon','aiobtn'),'book' => __('Book icon','aiobtn'),'bookmark' => __('Bookmark icon','aiobtn'),'print' => __('Print icon','aiobtn'),'camera' => __('Camera icon','aiobtn'),'font' => __('Font icon','aiobtn'),'bold' => __('Bold icon','aiobtn'),'italic' => __('Italic icon','aiobtn'),'text-height' => __('Text height icon','aiobtn'),'text-width' => __('Text width icon','aiobtn'),'align-left' => __('Align left icon','aiobtn'),'align-center' => __('Align center icon','aiobtn'),'align-right' => __('Align right icon','aiobtn'),'align-justify' => __('Align justify icon','aiobtn'),'list' => __('List icon','aiobtn'),'indent-left' => __('Indent left icon','aiobtn'),'indent-right' => __('Indent right icon','aiobtn'),'facetime-video' => __('Facetime video icon','aiobtn'),'picture' => __('Picture icon','aiobtn'),'pencil' => __('Pencil icon','aiobtn'),'map-marker' => __('Map marker icon','aiobtn'),'adjust' => __('Adjust icon','aiobtn'),'tint' => __('Tint icon','aiobtn'),'edit' => __('Edit icon','aiobtn'),'share' => __('Share icon','aiobtn'),'check' => __('Check icon','aiobtn'),'move' => __('Move icon','aiobtn'),'step-backward' => __('Step backward icon','aiobtn'),'fast-backward' => __('Fast backward icon','aiobtn'),'backward' => __('Backward icon','aiobtn'),'play' => __('Play icon','aiobtn'),'pause' => __('Pause icon','aiobtn'),'stop' => __('Stop icon','aiobtn'),'forward' => __('Forward icon','aiobtn'),'fast-forward' => __('Fast forward icon','aiobtn'),'step-forward' => __('Step forward icon','aiobtn'),'eject' => __('Eject icon','aiobtn'),'chevron-left' => __('Chevron left icon','aiobtn'),'chevron-right' => __('Chevron right icon','aiobtn'),'plus-sign' => __('Plus sign icon','aiobtn'),'minus-sign' => __('Minus sign icon','aiobtn'),'remove-sign' => __('Remove sign icon','aiobtn'),'ok-sign' => __('Ok sign icon','aiobtn'),'question-sign' => __('Question sign icon','aiobtn'),'info-sign' => __('Info sign icon','aiobtn'),'screenshot' => __('Screenshot icon','aiobtn'),'remove-circle' => __('Remove circle icon','aiobtn'),'ok-circle' => __('Ok circle icon','aiobtn'),'ban-circle' => __('Ban circle icon','aiobtn'),'arrow-left' => __('Arrow left icon','aiobtn'),'arrow-right' => __('Arrow right icon','aiobtn'),'arrow-up' => __('Arrow up icon','aiobtn'),'arrow-down' => __('Arrow down icon','aiobtn'),'share-alt' => __('Share alternative icon','aiobtn'),'resize-full' => __('Resize full icon','aiobtn'),'resize-small' => __('Resize small icon','aiobtn'),'plus' => __('Plus icon','aiobtn'),'minus' => __('Minus icon','aiobtn'),'asterisk' => __('Asterisk icon','aiobtn'),'exclamation-sign' => __('Exclamation sign icon','aiobtn'),'gift' => __('Gift icon','aiobtn'),'leaf' => __('Leaf icon','aiobtn'),'fire' => __('Fire icon','aiobtn'),'eye-open' => __('Eye open icon','aiobtn'),'eye-close' => __('Eye close icon','aiobtn'),'warning-sign' => __('Warning sign icon','aiobtn'),'plane' => __('Plane icon','aiobtn'),'calendar' => __('Calendar icon','aiobtn'),'random' => __('Random icon','aiobtn'),'comment' => __('Comment icon','aiobtn'),'magnet' => __('Magnet icon','aiobtn'),'chevron-up' => __('Chevron up icon','aiobtn'),'chevron-down' => __('Chevron down icon','aiobtn'),'retweet' => __('Retweet icon','aiobtn'),'shopping-cart' => __('Shopping cart icon','aiobtn'),'folder-close' => __('Folder close icon','aiobtn'),'folder-open' => __('Folder open icon','aiobtn'),'resize-vertical' => __('Resize vertical icon','aiobtn'),'resize-horizontal' => __('Resize horizontal icon','aiobtn'),'hdd' => __('HDD icon','aiobtn'),'bullhorn' => __('Bullhorn icon','aiobtn'),'bell' => __('Bell icon','aiobtn'),'certificate' => __('Certificate icon','aiobtn'),'thumbs-up' => __('Thumbs up icon','aiobtn'),'thumbs-down' => __('Thumbs down icon','aiobtn'),'hand-right' => __('Hand right icon','aiobtn'),'hand-left' => __('Hand left icon','aiobtn'),'hand-up' => __('Hand up icon','aiobtn'),'hand-down' => __('Hand down icon','aiobtn'),'circle-arrow-right' => __('Circle arrow right icon','aiobtn'),'circle-arrow-left' => __('Circle arrow left icon','aiobtn'),'circle-arrow-up' => __('Circle arrow up icon','aiobtn'),'circle-arrow-down' => __('Circle arrow down icon','aiobtn'),'globe' => __('Globe icon','aiobtn'),'wrench' => __('Wrench icon','aiobtn'),'tasks' => __('Tasks icon','aiobtn'),'filter' => __('Filter icon','aiobtn'),'briefcase' => __('Briefcase icon','aiobtn'),'fullscreen' => __('Fullscreen icon','aiobtn')),'none');
							if(is_array($AIO_Buttons_Data) && array_key_exists('default_text',$AIO_Buttons_Data)) {
								$default_text = $AIO_Buttons_Data['default_text'];
							} else {
								$default_text = 'Download Now';
							}
							$html .= $this->text_option('aiobtn_text',__('TEXT:','aiobtn'),$default_text);
							$html .= $this->select_option('aiobtn_target',__('TARGET:','aiobtn'),array('_self' => __('_self','aiobtn'),'_blank' => __('_blank','aiobtn')),'_self');
							$html .= $this->text_option('aiobtn_url',__('DESTINATION URL:','aiobtn'),'');
							if (is_array($AIO_Buttons_Data) && array_key_exists('shortcode_name',$AIO_Buttons_Data)) {
								$shortcode_name = $AIO_Buttons_Data['shortcode_name'];
							} else {
								$shortcode_name = 'aio_button';
							}
							$html .= $this->hidden_option('aiobtn_shortcode',$shortcode_name);
							$html .= $this->start_footer();
							$html .= $this->button('aiobtn_cancel','cancel',__('Cancel','aiobtn'),'#');
							$html .= $this->button('aiobtn_insert','insert',__('Create Button','aiobtn'),'#');
							$html .= $this->end_footer();
							echo $html;
						?>
						</div>
					</form>
					<form id="aiobtn_Preview">
						<div id="aiobtn_Live">
							
						</div>
					</form>
					<div style="clear:both;height:1px;">&nbsp;</div>
				</body>
			</html>
			<?php
			die();
		}
		
		public function start_footer() {				
			$html = '';
			$html .= '<p class="footer-form">';
			return $html;
		}
		
		public function end_footer() {				
			$html = '';
			$html .= '</p>';
			return $html;
		}
		
		public function button($id,$class,$label,$href) {			
			$html = '';
			$html .= '<button id="'.$id.'" class="'.$class.'" href="'.$href.'">'.$label.'</button>';
			return $html;
		}
		
		public function hidden_option($id,$value) {
			$html = '';
			$html .= '<input id="'.$id.'" type="hidden" value="'.$value.'" />';
			return $html;
		}
		
		public function text_option($id,$label,$value,$default=false) {
			//set optional default value
			if($default){
				$default = ' onfocus="if(this.value == this.defaultValue) { this.value = \'\'; }" onblur="if(this.value==\'\')this.value=this.defaultValue" ';
			} else {
				$default = ' ';
			}
			
			$html = '';
			$html .= '<p class="content-form">';
			$html .= '<label for="'.$id.'">'.$label.'</label><br/>';
			$html .= '<input id="'.$id.'" type="text"'.$default.'value="'.$value.'" size="45" />';
			$html .= '</p>';
			return $html;
		}
		
		public function select_option($id,$label,$options,$selected=false) {			
			$html = '';
			$html .= '<p class="content-form">';
			$html .= '<label for="'.$id.'">'.$label.'</label><br/>';
			$html .= '<select id="'.$id.'">';
			
			if (is_array($options)) {
				foreach ($options as $val=>$value) {
					$html .= '<option value="' . $val . '" ' . ($val == $selected ? 'selected="selected"':'') . '>' . $value . '</option>';
				}
			}
			
			$html .= '</select></p>';

			return $html;
		}
	
		public function ajax_aiobtn_nonce() {
			echo wp_create_nonce('aiobtn_dialog');
			die();
		}
		
	} // end class
	
}
?>