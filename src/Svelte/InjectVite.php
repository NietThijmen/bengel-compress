<?php

namespace Bengelmedia\BengelCompress\Svelte;

class InjectVite
{
    private static self $instance;

    public static function get_instance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_vite_assets']);
        add_action('admin_head', function () {
            AjaxHelper::generateAjaxScript();
        });
    }

    private function enqueue_dev_assets()
    {
        $manifest_path = BENGEL_COMPRESS_PLUGIN_DIR . 'frontend/dist/manifest.dev.json';
        $manifest = json_decode(file_get_contents($manifest_path), true);

        $url = $manifest['url'];
        // load the @vite/client script as a module
        wp_enqueue_script_module(
            'bengel-compress-main-js',
            $url . '@vite/client',
            [],
            false
        );

        // load the inputs as modules
        foreach ($manifest['inputs'] as $key => $file) {
            $path = $url . $file;
            $path_parts = pathinfo($file);
            if ($path_parts['extension'] === 'js' || $path_parts['extension'] === 'ts') {
                wp_enqueue_script_module(
                    'bengel-compress-' . $key,
                    $path,
                    [],
                    null,
                    true
                );
            } elseif ($path_parts['extension'] === 'scss' || $path_parts['extension'] === 'css') {
                wp_enqueue_style(
                    'bengel-compress-' . $key,
                    $path,
                    [],
                    null
                );
            }
        }

    }

    private function enqueue_production_assets()
    {
        $manifest_path = BENGEL_COMPRESS_PLUGIN_DIR . 'frontend/dist/.vite/manifest.json';
        $manifest = json_decode(file_get_contents($manifest_path), true);

        if (isset($manifest['src/main.ts'])) {
            $main_js = $manifest['src/main.ts'];
            wp_enqueue_script(
                'bengel-compress-main-js',
                BENGEL_COMPRESS_PLUGIN_URL . 'frontend/dist/' . $main_js['file'],
                [],
                null,
                true
            );

            if (isset($main_js['css'])) {
                foreach ($main_js['css'] as $css_file) {
                    wp_enqueue_style(
                        'bengel-compress-' . basename($css_file, '.css'),
                        BENGEL_COMPRESS_PLUGIN_URL . 'frontend/dist/' . $css_file,
                        [],
                        null
                    );
                }
            }
        }

    }

    public function enqueue_vite_assets()
    {
        // read the manifest file
        $dev_manifest_path = BENGEL_COMPRESS_PLUGIN_DIR . 'frontend/dist/manifest.dev.json';
        if (file_exists($dev_manifest_path)) {
            $this->enqueue_dev_assets();
        } else {
            $this->enqueue_production_assets();
        }
    }

}
