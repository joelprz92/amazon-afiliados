<?php
/*
Plugin Name: Amazon Affiliate Tag
Description: Añade automáticamente el tag de afiliado a todos los enlaces salientes a Amazon.es.
Version: 1.0
Author: Tu Nombre
*/

// Función para añadir el menú de configuración
function aat_add_admin_menu() {
    add_options_page('Amazon Affiliate Tag', 'Amazon Affiliate Tag', 'manage_options', 'amazon-affiliate-tag', 'aat_options_page');
}

add_action('admin_menu', 'aat_add_admin_menu');

// Función para registrar la configuración
function aat_settings_init() {
    register_setting('pluginPage', 'aat_settings');

    add_settings_section(
        'aat_pluginPage_section', 
        __('Configuración del Tag de Afiliado', 'wordpress'), 
        'aat_settings_section_callback', 
        'pluginPage'
    );

    add_settings_field( 
        'aat_text_field_0', 
        __('Tag de Afiliado', 'wordpress'), 
        'aat_text_field_0_render', 
        'pluginPage', 
        'aat_pluginPage_section' 
    );

    add_settings_field( 
        'aat_checkbox_field_1', 
        __('Añadir rel="nofollow"', 'wordpress'), 
        'aat_checkbox_field_1_render', 
        'pluginPage', 
        'aat_pluginPage_section' 
    );
}

add_action('admin_init', 'aat_settings_init');

// Función para renderizar el campo de texto
function aat_text_field_0_render() {
    $options = get_option('aat_settings');
    ?>
    <input type='text' name='aat_settings[aat_text_field_0]' value='<?php echo isset($options['aat_text_field_0']) ? $options['aat_text_field_0'] : ''; ?>'>
    <?php
}

// Función para renderizar el checkbox
function aat_checkbox_field_1_render() {
    $options = get_option('aat_settings');
    ?>
    <input type='checkbox' name='aat_settings[aat_checkbox_field_1]' <?php checked(isset($options['aat_checkbox_field_1']) ? $options['aat_checkbox_field_1'] : 0, 1); ?> value='1'>
    <?php
}

// Función de la sección de configuración
function aat_settings_section_callback() {
    echo __('Introduce tu tag de afiliado de Amazon y selecciona si deseas añadir rel="nofollow".', 'wordpress');
}

// Función para renderizar la página de opciones
function aat_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>Amazon Affiliate Tag</h2>
        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button();
        ?>
    </form>
    <?php
}

// Función para añadir el tag de afiliado a los enlaces de Amazon
function add_affiliate_tag_to_amazon_links($content) {
    $options = get_option('aat_settings');
    $affiliate_tag = isset($options['aat_text_field_0']) ? $options['aat_text_field_0'] : '';
    $nofollow = !empty($options['aat_checkbox_field_1']) ? ' rel="nofollow"' : '';

    // Patrón para encontrar enlaces a Amazon.es y añadir el tag de afiliado
    $pattern = '/<a\s+(.*?)href=["\'](https:\/\/www\.amazon\.es\/.*?)(\?.*?)?["\']/i';
    $replacement = function ($matches) use ($affiliate_tag, $nofollow) {
        $attributes = $matches[1];
        $url = $matches[2];
        $query = isset($matches[3]) ? $matches[3] : '';
        $separator = $query ? '&' : '?';
        return '<a ' . $attributes . 'href="' . $url . $query . $separator . 'tag=' . $affiliate_tag . '"' . $nofollow ;
    };

    // Reemplazar los enlaces en el contenido
    $content = preg_replace_callback($pattern, $replacement, $content);
    return $content;
}

add_filter('the_content', 'add_affiliate_tag_to_amazon_links');
add_filter('widget_text', 'add_affiliate_tag_to_amazon_links');
add_filter('widget_text_content', 'add_affiliate_tag_to_amazon_links');
?>
