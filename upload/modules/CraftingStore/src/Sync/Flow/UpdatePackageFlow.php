<?php

class UpdatePackageFlow
{
    /**
     * @var PackageUpdater
     */
    protected PackageUpdater $packageUpdater;

    /**
     * @var PackageRetriever
     */
    protected PackageRetriever $packageRetriever;

    public function __construct(PackageUpdater $packageUpdater, PackageRetriever $packageRetriever)
    {
        $this->packageUpdater = $packageUpdater;
        $this->packageRetriever = $packageRetriever;
    }

    public function performFlow(string $serverKey): void
    {
        $this->packageUpdater->update(
            $this->packageRetriever->retrieve($serverKey)['data']
        );
    }
}
