<?php

declare(strict_types=1);

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group([
    'key' => 'group_modularity_contact_card_settings',
    'title' => __('Kontaktkort', 'modularity-contact-card'),
    'fields' => [
        [
            'key' => 'field_contact_card_editor_info',
            'label' => __('Instruktion', 'modularity-contact-card'),
            'name' => '',
            'type' => 'message',
            'message' => __('Välj ett kontaktkort. Modulens innehåll hämtas från kontaktkortets rubrik och brödtext.', 'modularity-contact-card'),
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        ],
        [
            'key' => 'field_contact_card_panel_title',
            'label' => __('Titel', 'modularity-contact-card'),
            'name' => 'panel_title',
            'type' => 'text',
            'required' => 0,
            'instructions' => __('Rubriken som visas överst i kontaktytan, till exempel "Kontakt".', 'modularity-contact-card'),
            'default_value' => __('Kontakt', 'modularity-contact-card'),
        ],
        [
            'key' => 'field_contact_card_selected_post',
            'label' => __('Kontaktkort', 'modularity-contact-card'),
            'name' => 'contact_card',
            'type' => 'post_object',
            'required' => 1,
            'post_type' => [
                0 => 'kontaktkort',
            ],
            'taxonomy' => '',
            'return_format' => 'id',
            'multiple' => 0,
            'allow_null' => 0,
            'ui' => 1,
        ],
        [
            'key' => 'field_contact_card_background_color',
            'label' => __('Bakgrundsfärg', 'modularity-contact-card'),
            'name' => 'background_color',
            'type' => 'select',
            'required' => 1,
            'choices' => [
                'blue' => __('Blå', 'modularity-contact-card'),
                'green' => __('Grön', 'modularity-contact-card'),
                'orange' => __('Orange', 'modularity-contact-card'),
                'purple' => __('Lila', 'modularity-contact-card'),
                'red' => __('Röd', 'modularity-contact-card'),
                'teal' => __('Turkos', 'modularity-contact-card'),
                'yellow' => __('Gul', 'modularity-contact-card'),
            ],
            'default_value' => 'red',
            'return_format' => 'value',
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
            'ajax' => 0,
            'placeholder' => '',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'mod-contact-card',
            ],
        ],
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/contact-card',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
]);
