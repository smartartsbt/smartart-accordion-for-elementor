<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

class Smart_Accordion_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'smart_accordion';
    }

    public function get_title() {
        return __( 'Smart Accordion', 'smartart-accordion-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'smartart-accordion-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Text Content (WYSIWYG)
        $this->add_control(
            'text_content',
            [
                'label'   => __( 'Text', 'smartart-accordion-for-elementor' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => __( 'Enter your text here...', 'smartart-accordion-for-elementor' ),
                'dynamic' => [ 'active' => true ],
            ]
        );

        // Accordion Enable/Disable
        $this->add_control(
            'enable_accordion',
            [
                'label'        => __( 'Enable Accordion', 'smartart-accordion-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'smartart-accordion-for-elementor' ),
                'label_off'    => __( 'No', 'smartart-accordion-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        // Visible Lines for Accordion
        $this->add_control(
            'visible_lines',
            [
                'label'     => __( 'Visible Lines', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 10,
                'step'      => 1,
                'default'   => 3,
                'condition' => [
                    'enable_accordion' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Icons & Labels Section
        $this->start_controls_section(
            'section_icons_labels',
            [
                'label' => __( 'Icons & Labels', 'smartart-accordion-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_icons',
            [
                'label'        => __( 'Enable Icons', 'smartart-accordion-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'smartart-accordion-for-elementor' ),
                'label_off'    => __( 'No', 'smartart-accordion-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'open_icon',
            [
                'label' => __( 'Open Icon', 'smartart-accordion-for-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'condition' => [ 'enable_icons' => 'yes' ],
            ]
        );

        $this->add_control(
            'close_icon',
            [
                'label' => __( 'Close Icon', 'smartart-accordion-for-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'condition' => [ 'enable_icons' => 'yes' ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle .accordion-open svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                    '{{WRAPPER}} .accordion-toggle .accordion-close svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle .accordion-open svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .accordion-toggle .accordion-close svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        

        $this->add_control(
            'open_text',
            [
                'label' => __( 'Open Text', 'smartart-accordion-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'smartart-accordion-for-elementor' ),
            ]
        );

        $this->add_control(
            'close_text',
            [
                'label' => __( 'Close Text', 'smartart-accordion-for-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read Less', 'smartart-accordion-for-elementor' ),
            ]
        );

        $this->end_controls_section();


        // Style Section for Content
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'smartart-accordion-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color for Content
        $this->add_control(
            'content_bg_color',
            [
                'label'     => __( 'Content Background Color', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .normal-text'       => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        // Padding for Content Area
        $this->add_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'smartart-accordion-for-elementor' ),
                'type'  => Controls_Manager::DIMENSIONS,
                //'size_units' => [ 'px', 'em', '%' ],
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .normal-text'       => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border for Content Area
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'content_border',
                'selector' => '{{WRAPPER}} .accordion-content, {{WRAPPER}} .normal-text',
            ]
        );
        
        // Border Radius
        $this->add_control(
            'content_border_radius',
            [
                'label' => __( 'Content Border Radius', 'smartart-accordion-for-elementor' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .normal-text'       => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Box Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .accordion-content, {{WRAPPER}} .normal-text',
            ]
        );
        
        
        // Text Color
        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .normal-text'       => 'color: {{VALUE}};',
                ],
            ]
        );

        // Typography (Group Control)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => __( 'Typography', 'smartart-accordion-for-elementor' ),
                'selector' => '{{WRAPPER}} .accordion-content, {{WRAPPER}} .normal-text',
            ]
        );

        // Text Alignment
        $this->add_control(
            'text_alignment',
            [
                'label'     => __( 'Text Alignment', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'smartart-accordion-for-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'smartart-accordion-for-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'smartart-accordion-for-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .accordion-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .normal-text'       => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Button Style Section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __( 'Button Style', 'smartart-accordion-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Button Text Color
        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Button Text Color', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Background Color
        $this->add_control(
            'button_bg_color',
            [
                'label'     => __( 'Button Background Color', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         // Button Hover Background Color
         $this->add_control(
            'button_bg_hover_color',
            [
                'label'     => __( 'Button Hover Background Color', 'smartart-accordion-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

       // Button Border Radius
        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'smartart-accordion-for-elementor' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       // Button Padding
        $this->add_control(
            'button_padding',
            [
                'label' => __( 'Button Padding', 'smartart-accordion-for-elementor' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Button Typography (Group Control)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Button Typography', 'smartart-accordion-for-elementor' ),
                'selector' => '{{WRAPPER}} .accordion-toggle',
            ]
        );
        
        // Button Position
        $this->add_control(
            'button_alignment',
            [
                'label'   => __( 'Button Alignment', 'smartart-accordion-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'smartart-accordion-for-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'smartart-accordion-for-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'smartart-accordion-for-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle-wrapper' => 'display: flex; justify-content: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'flex-start' => 'flex-start',
                    'center'     => 'center',
                    'flex-end'   => 'flex-end',
                ],
            ]
        );

        // Button Margin
        $this->add_control(
            'button_margin',
            [
                'label' => __( 'Button Margin', 'smartart-accordion-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings        = $this->get_settings_for_display();
        $text            = wp_kses_post( $settings['text_content'] );
        $enableAccordion = $settings['enable_accordion'];
        $visibleLines    = intval( $settings['visible_lines'] );
        $buttonText      = esc_html( $settings['open_text'] );
        $buttonToggleText = esc_html( $settings['close_text'] );
        $collapsedHeight = $visibleLines * 1.5;
        ?>


<div class="smart-accordion-widget">
    <?php if ( 'yes' === $enableAccordion ) : ?>
         <!-- Initial collapsed state with dynamic height -->
        <div class="accordion-content" style="max-height: <?php echo esc_attr( $collapsedHeight ); ?>em; overflow: hidden;">
            <div class="accordion-inner">
                <?php echo $text; ?>
            </div>
        </div>
        
        <div class="accordion-toggle-wrapper">
            <button class="accordion-toggle" 
                data-read-more="<?php echo esc_attr( $buttonText ); ?>" 
                data-read-less="<?php echo esc_attr( $buttonToggleText ); ?>"
                data-collapsed-height="<?php echo esc_attr( $collapsedHeight ); ?>">
                
                <?php if ( 'yes' === $settings['enable_icons'] ) : ?>
                    <span class="accordion-open">
                        <?php Icons_Manager::render_icon( $settings['open_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <span class="accordion-close hidden">
                        <?php Icons_Manager::render_icon( $settings['close_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                <?php endif; ?>
                
                <span class="accordion-text"><?php echo esc_html( $buttonText ); ?></span>
            </button>
        </div>

    <?php else : ?>
        <div class="normal-text"><?php echo $text; ?></div>
    <?php endif; ?>



        </div>
        <?php
    }
}
