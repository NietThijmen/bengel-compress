<?php

namespace Bengelmedia\BengelCompress\Pages;


class Settings
{
    private static self $instance;
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action('admin_menu', [$this, 'add_settings_page']);
    }

    public function add_settings_page()
    {
        add_menu_page(
            'Bengel Compress',
            'Bengel Compress',
            'manage_options',
            'bengel-compress-settings',
            [$this, 'render_settings_page'],
            'dashicons-image-flip-vertical',
            80
        );

    }

    public function render_settings_page()
    {
        echo "<bengel-compress-settings/>";
    }

}
