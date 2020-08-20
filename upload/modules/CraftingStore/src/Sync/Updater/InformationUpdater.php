<?php

class InformationUpdater
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function update(array $information): void
    {
        $this->settingRepository->createOrUpdateByName(SettingEnum::STORE_NAME, $information['store']['name']);
        $this->settingRepository->createOrUpdateByName(SettingEnum::STORE_URL, $information['store']['domain']);
        $this->settingRepository->createOrUpdateByName(SettingEnum::STORE_CURRENCY, $information['store']['currency']);
    }
}
