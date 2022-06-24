<?php

class CategoryRepository
{

    /**
     * @var DB
     */
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function truncate(): void
    {
        $this->db->query('TRUNCATE TABLE ' . DatabaseTableEnum::PREFIX . DatabaseTableEnum::CATEGORIES);
    }

    public function create(int $id, int $order, string $name, ?string $description, ?int $parentCategory = null): void
    {
        DB::getInstance()->insert(DatabaseTableEnum::CATEGORIES, [
            'id' => $id,
            'order' => $order,
            'name' => $name,
            'description' => $description === null ? '' : $description,
            'parent_category' => $parentCategory
        ]);
    }

    public function getWithoutParentOrdered(): array
    {
        return DB::getInstance()->orderWhere(DatabaseTableEnum::CATEGORIES, 'parent_category IS NULL', '`order`', 'ASC')->results();
    }

    public function getByParentCategoryId(int $parentCategoryId): array
    {
        return DB::getInstance()->get(DatabaseTableEnum::CATEGORIES, ['parent_category', '=', $parentCategoryId])->results();
    }

    public function firstById(int $id): ?stdClass
    {
        return DB::getInstance()->get(DatabaseTableEnum::CATEGORIES, ['id', '=', $id])->results()[0] ?? null;
    }
}
