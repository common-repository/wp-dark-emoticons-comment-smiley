<?php
/*************************************************************************************************************************************************************
Plugin Name: WP Dark Emoticons Comment Smiley
Plugin URI: http://www.adityawebs.com/wordpress/plugins/255-wpdarkemoticons-version100
Description: WP Dark Emoticons Comment Smiley is plugin will replace string like :D :( :) to emoticon and words filtering. For more, Edit this plugin manually.
Version: 1.1
Author: Aditya Subawa
Author URI: http://www.adityawebs.com
Donate Link: http://www.adityawebs.com
***************************************************************************************************************************************************************/

add_filter('the_content',array('emoticons','replace'));
add_filter('comment_text',array('emoticons','replace'));

$imgUrl = get_option('siteurl') . '/wp-content/plugins/wp-dark-emoticons-comment-smiley/images/';
$ReplaceAll	= array(
	/*DARK*/
	':D' => '<img src="'. $imgUrl.'dark/biggrin.png" style="border:none;background:none;"/>', //biggrin
	':p' => '<img src="'. $imgUrl.'dark/grimace.png" style="border:none;background:none;"/>', // grimace
	':)' => '<img src="'. $imgUrl.'dark/smiling.png" style="border:none;background:none;"/>', //smile
	':(' => '<img src="'. $imgUrl.'dark/crying.png" style="border:none;background:none;"/>', //crying
	':|' => '<img src="'. $imgUrl.'dark/straightface.png" style="border:none;background:none;"/>', //straight face
	'X-(' => '<img src="'. $imgUrl.'dark/angry.png" style="border:none;background:none;"/>', // angry
	':?:' => '<img src="'. $imgUrl.'dark/what.png" style="border:none;background:none;"/>', // what
	':-?' => '<img src="'. $imgUrl.'dark/confused.png" style="border:none;background:none;"/>', // confused
	'<3' => '<img src="'. $imgUrl.'dark/love.png" style="border:none;background:none;"/>', // love
	'>:(' => '<img src="'. $imgUrl.'dark/worried.png" style="border:none;background:none;"/>', // worried
	':x' => '<img src="'. $imgUrl.'dark/love.png" style="border:none;background:none;"/>', // love struck
	':">' => '<img src="'. $imgUrl.'dark/blushing.png" style="border:none;background:none;"/>', // blushing
	'(:|' => '<img src="'. $imgUrl.'dark/waiting.png" style="border:none;background:none;"/>', // waiting
	
	/*WORD FILTER*/
	'bangsat' => '<span style="color:red;font-style:italic;">Blocked</span>',
	'suck' => '<span style="color:red;font-style:italic;">Blocked</span>',
	'tai' => '<span style="color:red;font-style:italic;">Blocked</span>',
	'anjing' => '<span style="color:red;font-style:italic;">Blocked</span>',
	'asu' => '<span style="color:red;font-style:italic;">Blocked</span>',
	'fuck' => '<span style="color:red;font-style:italic;">Blocked</span>'

);

$ReplaceAll2 = $ReplaceAll;


if(!class_exists('emoticons')) {
    class emoticons {		
		function replace($string){
			$output = '';
			$textarr = preg_split('/(<\/?pre[^>]*>)|(<\/?p[^>]*>)|(<\/?a[^>]*>)|(<\/?object[^>]*>)|(<\/?img[^>]*>)|(<\/?embed[^>]*>)|(<\/?strong[^>]*>)|(<\/?b[^>]*>)|(<\/?i[^>]*>)|(<\/?em[^>]*>)/U', $string, -1, PREG_SPLIT_DELIM_CAPTURE); 
			$stop = count($textarr);
			$s=false;
			for ($i = 0; $i < $stop; $i++){
				$content = $textarr[$i];
				if(preg_match('/^<img/',trim($content))){
					$output .= $content;
					continue;
				}
				if(preg_match('/<pre/',trim($content)))$s = true;
				if(trim($content)=='</pre>')$s = false;
				if (!$s)
				{ 
					$content = emoticons::replace_code( $content ) ;
				}
				$output .= $content;
			}			
			return $output;			
		}
		function replace_code($content){
			global $ReplaceAll;
			return strtr($content,$ReplaceAll);
		}		
		}
	}
	
?>
