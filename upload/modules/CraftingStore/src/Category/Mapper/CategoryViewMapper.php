<?php

class CategoryViewMapper
{
    /**
     * @param mixed $category
     * @param string $storePath
     * @return array
     */
    public function map($category, string $storePath): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'subCategories' => $category->subCategories,
            'link' => URL::build($storePath . '/category/' . $category->id)
        ];
    }
}
