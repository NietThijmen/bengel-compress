<?php

namespace Bengelmedia\BengelCompress\DTO;

use Bengelmedia\BengelCompress\Compressor\CompressorInterface;
use Bengelmedia\BengelCompress\Enums\LocalCompressor;

class CompressorSettings implements DtoInterface
{

    public function __construct(
        protected string $compressor
    )
    {

    }

    public static function fromArray(array $data): self
    {
        return new self(
            compressor: $data['compressor']
        );
    }

    public function toArray(): array
    {
        return [
            'compressor' => $this->compressor
        ];
    }

    public static function fromOptions(): self
    {
        $compressor = get_option('bengel_compress_compressor', 'local');

        return new self(
            compressor: $compressor
        );
    }

    public function toOptions(): void
    {
        update_option('bengel_compress_compressor', $this->compressor);
    }

    /**
     * Get the class name of the selected compressor
     * @return class-string<CompressorInterface>
     */
    public function toClass(): string
    {
        return match ($this->compressor) {
            'local' => LocalCompressor::class
        };
    }
}