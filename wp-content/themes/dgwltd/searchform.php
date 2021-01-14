<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @package dgwltd
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="s" class="visually-hidden"><?php esc_html_e('Search', 'dgwltd'); ?></label>
    <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e('Type something&#8230;', 'dgwltd'); ?>" />
    <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'dgwltd'); ?>" />
</form>
