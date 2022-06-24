<?php

class PackageBuilder
{
    /**
     * @var PackageRepository
     */
    protected PackageRepository $packageRepository;

    /**
     * @var PackageViewMapper
     */
    protected PackageViewMapper $packageViewMapper;

    public function __construct(PackageRepository $packageRepository, PackageViewMapper $packageViewMapper)
    {
        $this->packageRepository = $packageRepository;
        $this->packageViewMapper = $packageViewMapper;
    }

    public function build(int $categoryId): array
    {
        $packages = [];

        $databasePackages = $this->packageRepository->getByCategoryId($categoryId);
        foreach ($databasePackages as $databasePackage) {
            $packages[] = $this->packageViewMapper->map($databasePackage);
        }

        return $packages;
    }
}
