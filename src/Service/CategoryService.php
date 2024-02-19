<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryDataForApi(): array
    {
        $categories = $this->categoryRepository->findAll();
        return array_map(function ($category) {
            return [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ];
        }, $categories);
    }
}
