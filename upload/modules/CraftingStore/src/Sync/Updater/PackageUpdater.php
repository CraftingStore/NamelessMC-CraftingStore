<?php

class PackageUpdater
{
    /**
     * @var PackageRepository
     */
    protected $packageRepository;

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function update(array $packages): void
    {
        $this->packageRepository->truncate();

        foreach ($packages as $package) {
            if (!$package['enabled']) {
                continue;
            }
            
            $this->packageRepository->create(
                $package['id'],
                $package['categoryId'],
                $package['order'],
                $package['name'],
                $package['price'],
                $package['description'],
                $package['image']
            );
        }
    }
}
