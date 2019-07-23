<?php
namespace BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service;

interface BinaryTreeCategoryService
{
    public function createCategory($category);

    public function createChildrenCategory($childrenCategory);

    public function updateCategory($id, $fields);

    public function deleteCategory($id);

    public function deleteChildrenCategory($id);

    public function getCategory($id);

    public function searchCategories($conditions, $orderBys, $start, $limit);

    public function countCategories($conditions);
}