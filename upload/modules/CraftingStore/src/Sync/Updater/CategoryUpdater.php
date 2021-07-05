<?php

class CategoryUpdater
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function update(array $categories): void
    {
        $this->categoryRepository->truncate();

        foreach ($categories as $category) {
            if (($category['enabled'] ?? true) === false) {
                continue;
            }

            $this->categoryRepository->create(
                $category['id'],
                $category['order'],
                $category['name'],
                $category['description'],
                $category['parentId']
            );
        }
    }
}
