<?php

namespace Bengelmedia\BengelCompress\Enums;

use Bengelmedia\BengelCompress\Compressor\CompressorInterface;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;


/**
 * Local compressor is an implementation of CompressorInterface that uses
 * the local server's resources to compress images. It supports reading images
 * from both local file paths and URLs.
 */
class LocalCompressor implements CompressorInterface
{

    private function __construct(
        protected string $filePath
    )
    {

    }

    public static function fromFile(string $filePath): CompressorInterface
    {
        return new self($filePath);
    }

    public static function fromUrl(string $url): CompressorInterface
    {
        // download the file to a temporary location
        $tempFilePath = tempnam(sys_get_temp_dir(), 'compressor_');
        file_put_contents($tempFilePath, file_get_contents($url));
        return new self($tempFilePath);
    }

    public function compress(string $outputPath, int $quality, OutputFormat $outputFormat = OutputFormat::WEBP): bool
    {

        $driver = match (true) {
            extension_loaded('imagick') => new ImagickDriver(),
            default => new GdDriver(),
        };

        $manager = new ImageManager($driver);
        $image = $manager->read($this->filePath);

        $encoded = match ($outputFormat) {
            OutputFormat::JPEG => $image->toJpeg(quality: $quality, strip: true),
            OutputFormat::PNG => $image->toPng(),
            OutputFormat::WEBP => $image->toWebp(quality: $quality, strip: true),
            OutputFormat::AVIF => $image->toAvif(quality: $quality, strip: true),
        };

        $encoded->save(
            $outputPath
        );

        // implement compression logic here
        return true;
    }

}