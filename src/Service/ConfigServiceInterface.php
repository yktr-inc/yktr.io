<?php

namespace App\Service;

interface ConfigServiceInterface
{
  public function get(string $key): ?string;
  public function set(string $key, string $value): ?boolean;
}
