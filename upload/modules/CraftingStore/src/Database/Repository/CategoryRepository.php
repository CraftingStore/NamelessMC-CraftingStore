<?php

class CategoryRepository
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
        $this->db->createQuery('TRUNCATE TABLE ' . DatabaseTableEnum::PREFIX . DatabaseTableEnum::CATEGORIES);
    }

    public function create(int $id, int $order, string $name, ?string $description, ?int $parentCategory = null): void
    {
        $this->queries->create(DatabaseTableEnum::CATEGORIES, [
            'id' => $id,
            'order' => $order,
            'name' => $name,
            'description' => $description === null ? '' : $description,
            'parent_category' => $parentCategory
        ]);
    }

    public function getWithoutParentOrdered(): array
    {
        return $this->queries->orderWhere(DatabaseTableEnum::CATEGORIES, 'parent_category IS NULL', '`order`', 'ASC');
    }

    public function getByParentCategoryId(int $parentCategoryId): array
    {
        return $this->queries->getWhere(DatabaseTableEnum::CATEGORIES, ['parent_category', '=', $parentCategoryId]);
    }

    public function firstById(int $id): ?stdClass
    {
        return $this->queries->getWhere(DatabaseTableEnum::CATEGORIES, ['id', '=', $id])[0] ?? null;
    }
}
