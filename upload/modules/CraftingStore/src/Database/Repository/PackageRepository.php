<?php

class PackageRepository
{
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function truncate(): void
    {
        $this->db->query('TRUNCATE TABLE ' . DatabaseTableEnum::PREFIX . DatabaseTableEnum::PACKAGES);
    }

    public function create(int $id, int $categoryId, int $order, string $name, string $price, string $description, ?string $image): void
    {
        $this->db->insert(DatabaseTableEnum::PACKAGES, [
            'id' => $id,
            'category_id' => $categoryId,
            'order' => $order,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $image
        ]);
    }

    public function getByCategoryId(int $categoryId): array
    {
        return $this->db->get(DatabaseTableEnum::PACKAGES, ['category_id', '=', $categoryId])->results();
    }
}
