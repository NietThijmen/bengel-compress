<?php

namespace Bengelmedia\BengelCompress;

use Bengelmedia\BengelCompress\Api\DtoApi;
use Bengelmedia\BengelCompress\DTO\CompressionSettings;
use Bengelmedia\BengelCompress\Pages\Settings;
use Bengelmedia\BengelCompress\Svelte\InjectVite;

class Plugin
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
        $this->init();
        $this->setupPrivateApis();
    }

    /**
     * Set up the private CRUD APIs
     * @return void
     */
    private function setupPrivateApis(): void
    {
        new DtoApi(
            'image_settings',
            new CompressionSettings()
        );

    }

    /**
     * Initialise the main plugin flow
     * @return void
     */
    private function init(): void
    {
        Settings::getInstance();
        InjectVite::get_instance();
    }


}