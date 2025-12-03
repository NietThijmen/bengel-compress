<?php

namespace Bengelmedia\BengelCompress\Api;
use Bengelmedia\BengelCompress\DTO\DtoInterface;

class DtoApi
{
    public function __construct(
        protected string $entityName,
        protected DtoInterface $dtoInstance
    ) {
        $this->init();
    }

    public function init()
    {
        add_action("wp_ajax_bengel_compress_save_{$this->entityName}", [$this, 'save']);
        add_action("wp_ajax_bengel_compress_get_{$this->entityName}", [$this, 'get']);

    }

    public function get(): void
    {
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized', 403);
        }

        $data = $this->dtoInstance::fromOptions();
        wp_send_json_success($data->toArray());
    }

    public function save(): void
    {
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized', 403);
        }

        $dataString = $_POST['data'];
        $data = json_decode(stripslashes($dataString), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            wp_send_json_error('Invalid JSON data', 400);
        }

        $data = $this->dtoInstance::fromArray($data);
        $data->toOptions();


        wp_send_json_success('Saved');
    }

}
