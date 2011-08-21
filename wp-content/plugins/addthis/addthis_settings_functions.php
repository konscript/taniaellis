<?php
/**
 * Get the list of styles
 */

function _get_style_options()
{
    global $addthis_new_styles;
    return apply_filters('addthis_style_options', $addthis_new_styles );
}

/**
 * AddThis replacement for kses
 *
 */
function addthis_kses($string)
{
    global $allowedposttags;
    $mytags = $allowedposttags;
    $mytags['a'][ 'gplusonesize' ] = array();
    $mytags['a'][ 'gplusonecount' ]= array();
    $mytags['a'][ 'fblikelayout' ]= array();
    $mytags['a'][ 'fblikesend' ]= array();
    $mytags['a'][ 'fblikeshow_faces' ]= array();
    $mytags['a'][ 'fblikewidth' ]= array();
    $mytags['a'][ 'fblikeaction' ]= array();
    $mytags['a'][ 'fblikefont' ]= array();
    $mytags['a'][ 'fblikecolorscheme' ]= array();
    $mytags['a'][ 'fblikeref' ]= array();
    $mytags['a'][ 'fblikehref' ]= array();
    $mytags['a'][ 'twcount' ]= array();
    $mytags['a'][ 'twurl' ]= array();
    $mytags['a'][ 'twvia' ]= array();
    $mytags['a'][ 'twtext' ]= array();
    $mytags['a'][ 'twrelated' ]= array();
    $mytags['a'][ 'twlang' ]= array();
    $mytags['a'][ 'twcounturl' ]= array();
    
    $pretags = array( 'g:plusone:', 'fb:like:', 'tw:');
    $posttags = array('gplusone', 'fblike', 'tw');

    foreach($pretags as $attr)
    {
        $pre_pattern[] = '/'.$attr.'/';
    }
    foreach($posttags as $attr)
    {
        $post_pattern[] = '/[^_]'.$attr.'/';
    }
    $temp_string = preg_replace( $pre_pattern, $posttags, $string);
    $new_temp_string = wp_kses($temp_string, $mytags);
    $new_string = preg_replace( $post_pattern, $pretags, $new_temp_string);

    // Add in our %s so that the url and title get added properly


    return $new_string;
}

/**
 * The icon choser row.  Should be made to look a bit prettier
 */
 function _addthis_choose_icons($name, $options)
 {
     $addthis_new_styles = _get_style_options();
     global $addthis_default_options;

     extract($options);
     if ($name == 'above')
     {
        $option = $above;
        $custom_size = $above_custom_size;
        $do_custom_services  = ( isset( $above_do_custom_services ) && $above_do_custom_services  ) ? 'checked="checked"' : '';
        $do_custom_preferred = ( isset( $above_do_custom_preferred ) &&  $above_do_custom_preferred ) ? 'checked="checked"' : '';
        $custom_services = $above_custom_services;
        $custom_preferred  = $above_custom_preferred;
        $custom_more = $above_custom_more;
        $custom_string = $above_custom_string;
     }
     else
     {
         $option = $below;
         $custom_size =  $below_custom_size;
        $do_custom_services  = ( isset( $below_do_custom_services ) && $below_do_custom_services  ) ? 'checked="checked"' : '';
        $do_custom_preferred = ( isset( $below_do_custom_preferred ) &&  $below_do_custom_preferred ) ? 'checked="checked"' : '';
        $custom_services = $below_custom_services;
        $custom_preferred  = $below_custom_preferred;
        $custom_more = $below_custom_more;
        $custom_string = $below_custom_string;
     }
?>
        <tr>
            <td id="<?php echo $name ?>" colspan="2">
                <p><?php _e("$name the post", 'addthis_trans_domain') ?>&nbsp;&nbsp;<span class="description"><input type="checkbox" name="addthis_settings[show_<?php echo $name; ?>]" <?php echo ('none' == $option) ? 'checked="checked"' : '';?> />&nbsp;none</span></p>
                <?php  $imgLocationBase = apply_filters( 'at_files_uri',  plugins_url( '' , basename(dirname(__FILE__)))) . '/addthis/img/'  ;
                 $imgLocationBase = apply_filters( 'addthis_files_uri',  plugins_url( '' , basename(dirname(__FILE__)))) . '/addthis/img/'  ;
                 foreach ($addthis_new_styles as $k => $v)
                {
                    $class = 'hidden';
                    $checked = '';
                    if ($option == $k || ($option == 'none' && $k == $addthis_default_options[$name]  ) ){
                        $checked = 'checked="checked"';
                        $class = '';
                    }
                    echo "<p class='$name"."_option select_row $class '><input $checked type='radio' value='".$k."' name='addthis_settings[$name]' /><img alt='".$k."'  src='". $imgLocationBase  .  $v['img'] ."'/></p>";
                }
                
                $class = 'hidden';
                $checked = '';
                if ($option == 'custom' || ($option == 'none' && 'custom' == $addthis_default_options[$name]  ) ){
                    $checked = 'checked="checked"';
                    $class = '';
                }

                echo "<div class='$name"."_option select_row $class '><input $checked type='radio' value='custom' name='addthis_settings[$name]' id='$name"."_custom_button' /> Build your own</input>";

                echo "<ul class='$name"."_option_custom hidden'>";
                $custom_16 = ($custom_size == 16) ? 'selected="selected"' : '' ;
                $custom_32 = ($custom_size == 32) ? 'selected="selected"' : '' ;

                echo "<li class='nocheck'><span class='at_custom_label'>Size:</span><select name='addthis_settings[$name"."_custom_size]'><option value='16' $custom_16 >16x16</option><option value='32' $custom_32 >32x32</option></select><br/><span class='description'>The size of the icons you want to display</span></li>";
                echo "<li><input $do_custom_services class='at_do_custom'  type='checkbox' name='addthis_settings[$name"."_do_custom_services]' value='true' /><span class='at_custom_label'>Services to always show:</span><input class='at_custom_input' name='addthis_settings[$name"."_custom_services]' value='$custom_services'/><br/><span class='description'>Enter a comma-separated list of <a href='//addthis.com/services'>service codes</a> </span></li>";
                echo "<li><input type='checkbox' $do_custom_preferred class='at_do_custom'  name='addthis_settings[$name"."_do_custom_preferred]' value='true' /><span class='at_custom_label'>Auto Personalized:</span>
                    <select name='addthis_settings[$name"."_custom_preferred]' class='at_custom_input'>";
                    for($i=0; $i <= 11; $i++)
                    {
                        $selected = '';
                        if ($custom_preferred == $i)
                            $selected = 'selected="selected"';
                        echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';

                    }
                echo "</select><br/><span class='description'>Enter the number of automatticly user personalized items you want displayed</span></li>";
               $custom_more = ( $custom_more ) ? 'checked="checked"' : '';
                
                echo "<li><input $custom_more type='checkbox' class='at_do_custom' name='addthis_settings[$name"."_custom_more]' value='true' /><span class='at_custom_label'>More</span><br/><span class='description'>Display our iconic orange plus sign that offers sharing to over 300 destinations</span></li>";
                echo "</ul></div>";
               
                    $class = 'hidden';
                    $checked = '';
                    if ($option == 'custom_string' || $option == 'none' && 'custom_strin' == $addthis_default_options[$name] )
                    {
                        $checked = 'checked="checked"';
                        $class = '';
                    }

                    echo "<div class='$name"."_option select_row $class '> <input $checked type='radio' value='custom_string' name='addthis_settings[$name]' id='$name"."_custom_string' />Custom Button</input>";
                    echo "<br />";
                    echo "<textarea rows='5' cols='120' name='addthis_settings[$name"."_custom_string]' id='$name"."_custom_string_input' />".esc_textarea($custom_string)."</textarea>";

                    echo '</div>';
                ?>
               

                <a class="<?php echo $name;?>_option" href="#<?php echo $name;?>_more" id="<?php echo $name;?>_more">addtional style options</a>
            </td>
        </tr>

<?php
 }


?>
