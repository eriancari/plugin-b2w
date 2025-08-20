<?php

/**
 * Custom Widget Link
 */

class B2w_Link_Widget extends \Elementor\Widget_Base {

    public function get_name()
    {
        return 'b2w_link';
    }

    public function get_title()
    {
        return __('Link', 'plugin-b2w');
    }

    public function get_icon()
    {
        return 'eicon-editor-link';
    }

    public function get_keywords()
    {
        return ['b2w', 'button', 'link', 'happy'];
    }

    public function get_categories()
    {
        return ['b2w_category'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'b2w_link',
            [
                'label' => __('Link', 'plugin-b2w'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // add our controls

        $this->add_control(
            'link_text',
            [
                'label' => __('Link Text', 'plugin-b2w'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Link Text', 'plugin-b2w'),
                'default' => __('Click here ->', 'plugin-b2w'),
            ]
        );

        $this->add_control(
            'link_url',
            [
                'label' => __('Link URL', 'plugin-b2w'),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => false
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => __('Link Color', 'plugin-b2w'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff3366',
                'selectors' => [
                    '{{WRAPPER}} .colored-link' => 'color: {{VALUE}}',
                ]
            ],
        );

        $this->add_control(
            'link_color_hover',
            [
                'label' => __('Hover Color', 'plugin-b2w'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .colored-link:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'link_align',
            [
                'label' => __('Link Align', 'plugin-b2w'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugin-b2w'),
                        'icon' => 'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' => __('Center', 'plugin-b2w'),
                        'icon' => 'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' => __('Right', 'plugin-b2w'),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .link-box' => 'text-align: {{VALUE}};',
                ],
            ],
        );


        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $target = $settings['link_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link_url']['nofollow'] ? ' rel="nofollow"' : '';

        echo '<div class="link-box">';
        echo '<a class="colored-link" href="' . $settings['link_url']['url'] . '" ' . $target . $nofollow . '>' . $settings['link_text'] . '</a>';
        echo '</div>';
    }

}

// Register widget
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \B2w_Link_Widget());