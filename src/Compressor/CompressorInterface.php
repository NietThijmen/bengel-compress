<?php

namespace Bengelmedia\BengelCompress\Compressor;

use Bengelmedia\BengelCompress\Enums\OutputFormat;

/**
 * CompressorInterface defines the methods required for any image compressor.
 * It supports creating compressors from local files or URLs and compressing
 * images to specified output formats and quality levels.
 */
interface CompressorInterface
{
    public static function fromFile(
        string $filePath
    ): self;
    public static function fromUrl(
        string $url
    ): self;

    public function compress(
        string $outputPath,
        int $quality,
        OutputFormat $outputFormat = OutputFormat::WEBP
    ): bool;
}