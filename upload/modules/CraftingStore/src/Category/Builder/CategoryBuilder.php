<?php

class CategoryBuilder
{
    /**
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    /**
     * @var CategoryViewMapper
     */
    protected CategoryViewMapper $categoryViewMapper;

    public function __construct(CategoryRepository $categoryRepository, CategoryViewMapper $categoryViewMapper)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryViewMapper = $categoryViewMapper;
    }

    public function build(string $storePath): array
    {
        $categories = [];

        $mainCategories = $this->categoryRepository->getWithoutParentOrdered();

        foreach ($mainCategories as $mainCategory) {

            // Add sub-categories
            $dbSubCategories = $this->categoryRepository->getByParentCategoryId($mainCategory->id);
            foreach ($dbSubCategories as $dbSubCategory) {
                $mainCategory->subCategories[] = $this->categoryViewMapper->map($dbSubCategory, $storePath);
            }

            $categories[] = $this->categoryViewMapper->map($mainCategory, $storePath);
        }

        return $categories;
    }
}
