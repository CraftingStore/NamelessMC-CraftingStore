<?php

class UpdateCategoryFlow
{
    /**
     * @var CategoryUpdater
     */
    protected $categoryUpdater;

    /**
     * @var CategoryRetriever
     */
    protected $categoryRetriever;

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
