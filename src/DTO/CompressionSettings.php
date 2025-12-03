<?php

namespace Bengelmedia\BengelCompress\DTO;

use Bengelmedia\BengelCompress\DTO\DtoInterface;

class CompressionSettings implements DtoInterface
{
    public function __construct(
        public bool $enable_webp = true,
        public bool $enable_avif = true,
        public string $compressionPreset = 'medium'
    )
    {

    }

    public static function fromArray(array $data): \Bengelmedia\BengelCompress\DTO\DtoInterface
    {
        return new self(
            enable_webp: $data['enable_webp'] ?? true,
            enable_avif: $data['enable_avif'] ?? true,
            compressionPreset: $data['compressionPreset'] ?? 'medium'
        );
    }

    public function toArray(): array
    {
        return [
            'enable_webp' => $this->enable_webp,
            'enable_avif' => $this->enable_avif,
            'compressionPreset' => $this->compressionPreset,
        ];
    }

    public static function fromOptions(): \Bengelmedia\BengelCompress\DTO\DtoInterface
    {
        $options = get_option('bengel_compress_image_settings', []);
        return self::fromArray(is_array($options) ? $options : []);
    }

    public function toOptions(): void
    {
        update_option('bengel_compress_image_settings', $this->toArray());
    }
}