<?php

class FullSyncFlow
{
    /**
     * @var InformationRetriever
     */
    protected $informationRetriever;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var UpdateCategoryFlow
     */
    protected $updateCategoryFlow;

    /**
     * @var UpdatePackageFlow
     */
    protected $updatePackageFlow;

    /**
     * @var UpdatePaymentFlow
     */
    protected $updatePaymentFlow;

    public function __construct(
        InformationRetriever $informationRetriever,
        SettingRepository $settingRepository,
        InformationUpdater $informationUpdater,
        UpdateCategoryFlow $updateCategoryFlow,
        UpdatePackageFlow $updatePackageFlow,
        UpdatePaymentFlow $updatePaymentFlow
    ) {
        $this->informationRetriever = $informationRetriever;
        $this->settingRepository = $settingRepository;
        $this->informationUpdater = $informationUpdater;
        $this->updateCategoryFlow = $updateCategoryFlow;
        $this->updatePackageFlow = $updatePackageFlow;
        $this->updatePaymentFlow = $updatePaymentFlow;
    }

    public function performFlow(): bool
    {
        $serverKey = $this->settingRepository->firstValueByName(SettingEnum::SERVER_KEY, null);
        if ($serverKey === null) {
            return false;
        }

        // Update: Information
        $information = $this->informationRetriever->retrieve($serverKey);
        if (!($information['success'] ?? false)) {
            return false;
        }
        $this->informationUpdater->update($information['data']);

        // Update data
        $this->updatePaymentFlow->performFlow($serverKey);
        $this->updatePackageFlow->performFlow($serverKey);
        $this->updateCategoryFlow->performFlow($serverKey);

        return true;
    }
}
