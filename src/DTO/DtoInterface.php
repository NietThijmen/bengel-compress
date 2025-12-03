<?php

namespace Bengelmedia\BengelCompress\DTO;

interface DtoInterface
{
    public static function fromArray(array $data): self;
    public function toArray(): array;

    public static function fromOptions(): self;
    public function toOptions(): void;
}