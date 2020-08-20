<?php

class PackageViewMapper
{
    public function map($package): array
    {
        $description = Output::getDecoded($package->description);
        $description = Output::getPurified($description);

        return [
            'id' => $package->id,
            'name' => $package->name,
            'price' => number_format((float) $package->price, 2, ',', ''),
            'description' => $description,
            'image' => $package->image,
        ];
    }
}
