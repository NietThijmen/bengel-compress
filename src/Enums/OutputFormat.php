<?php

namespace Bengelmedia\BengelCompress\Enums;

/**
 * OutputFormat enum defines the supported image output formats for compression.
 * It includes JPEG, PNG, WEBP, and AVIF formats.
 * Each format is associated with its corresponding MIME type.
 */
enum OutputFormat: string
{
    case JPEG = 'image/jpeg';
    case PNG = 'image/png';
    case WEBP = 'image/webp';
    case AVIF = 'image/avif';
}
