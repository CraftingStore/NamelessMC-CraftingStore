<?php

class UpdateCategoryFlow
{
    /**
     * @var CategoryUpdater
     */
    protected CategoryUpdater $categoryUpdater;

    /**
     * @var CategoryRetriever
     */
    protected CategoryRetriever $categoryRetriever;

    public function __construct(CategoryUpdater $categoryUpdater, CategoryRetriever $categoryRetriever)
    {
        $this->categoryUpdater = $categoryUpdater;
        $this->categoryRetriever = $categoryRetriever;
    }

    public function performFlow(string $serverKey): void
    {
        $this->categoryUpdater->update(
            $this->categoryRetriever->retrieve($serverKey)['data']
        );
    }
}
