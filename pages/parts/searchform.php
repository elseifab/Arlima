<div class="search-wrapper">
    <form action="#">
        <?php

        $posttypes = apply_filters('arlima_search_posttypes', null);
        if ($posttypes) {
            echo "<select name=\"posttype\" id=\"posttype\">";
            echo "<option value=\"\">" . __('Select posttype', 'arlima') . "</option>";
            $allPosttypes = get_post_types([], 'objects');
            foreach ($allPosttypes as $posttype) {
                if (property_exists($posttype, 'name') && in_array($posttype->name, $posttypes)) {
                    echo "<option value=\"" . $posttype->name ."\">", $posttype->label, "</option>";
                }
            }
            echo "</select>";
        }

        if (apply_filters('arlima_search_categories', true)) {
            $args = array(
                'orderby' => 'name',
                'show_option_all' => __('All categories', 'arlima'),
                'name' => 'catid',
                'id' => 'arlima-posts-category'
            );
            wp_dropdown_categories(apply_filters('arlima_dropdown_categories', $args));
        }

        $args = array(
            'show_option_all' => __('All authors', 'arlima'),
            'name' => 'author',
            'id' => 'arlima-posts-author',
            'who' => 'authors',
            'show' => 'display_name'
        );
        wp_dropdown_users($args);
        ?>
        <input type="text" name="search" id="arlima-posts-search"
               placeholder="<?php _e('Search word', 'arlima') ?>"/>
        <input class="button-secondary action" type="submit"
               value="<?php _e('Search', 'arlima') ?>"/>
        <img src="<?php echo ARLIMA_PLUGIN_URL . '/images/ajax-loader-trans.gif'; ?>"
             class="ajax-loader"/>
        <div class="search-opts">
            <?php Arlima_PostSearchModifier::invokeFormCallbacks() ?>
        </div>
    </form>
</div>
