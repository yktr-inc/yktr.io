<?php

namespace App\Service;

use App\Service\ConfigServiceInterface;
use App\Repository\SettingRepository;

class ConfigService implements ConfigServiceInterface
{
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function get(string $key): ?string
    {
        $setting = $this->settingRepository->findByKey($key);
        return $setting->getValue();
    }
    public function set(string $key, string $value): ?boolean
    {
    }
}
