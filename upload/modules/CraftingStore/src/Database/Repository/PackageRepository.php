<?php

class PackageRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    /**
     * @var DB
     */
    protected $db;

    public function __construct(Queries $queries, DB $db)
    {
        $this->queries = $queries;
        $this->db = $db;
    }

    public function truncate(): void
    {
        $this->db->createQuery('TRUNCATE TABLE ' . DatabaseTableEnum::PREFIX . DatabaseTableEnum::PACKAGES);
    }

    public function create(int $id, int $categoryId, int $order, string $name, string $price, string $description, ?string $image): void
    {
        $this->queries->create(DatabaseTableEnum::PACKAGES, [
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
        return $this->queries->getWhere(DatabaseTableEnum::PACKAGES, ['category_id', '=', $categoryId]);
    }
}
