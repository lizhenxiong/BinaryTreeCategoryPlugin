<?php

namespace BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\Impl;

use AppBundle\Common\ArrayToolkit;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Dao\BinaryTreeCategoryDao;
use Biz\BaseService;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\BinaryTreeCategoryService;

class BinaryTreeCategoryServiceImpl extends BaseService implements BinaryTreeCategoryService
{
    public function createCategory($category)
    {
        $this->validateCategoryFields($category);
        $category = $this->filterCategoryFields($category);

        if (empty($category['leftValue'])) {
            $category['leftValue'] = 1;
        }

        if (empty($category['rightValue'])) {
            $category['rightValue'] = 2;
        }

        return $this->getBinaryTreeCategoryDao()->create($category);
    }

    public function createChildrenCategory($childrenCategory)
    {
        $parentCategory = $this->getCategory($childrenCategory['parentId']);

        $childrenCategory['leftValue'] = $parentCategory['rightValue'] + 0;
        $childrenCategory['rightValue'] = $parentCategory['rightValue'] + 1;
        $childrenCategory['layer'] = $parentCategory['layer'] + 1;
        $childrenCategory['type'] = $parentCategory['type'];

        $this->syncTreeRelationWithCreate($childrenCategory);
        $childrenCategory = $this->createCategory($childrenCategory);

        return $childrenCategory;
    }

    public function updateCategory($id, $fields)
    {
        $fields = $this->filterCategoryFields($fields);

        return $this->getBinaryTreeCategoryDao()->update($id, $fields);
    }


    public function deleteCategory($id)
    {
        return $this->getBinaryTreeCategoryDao()->delete($id);
    }

    public function deleteChildrenCategory($id)
    {
        $category = $this->getCategory($id);
        $childrenCategories = $this->findChildrenCategories($category);

        $this->deleteCategory($category['id']);
        if (!empty($childrenCategories)) {
            foreach ($childrenCategories as $childrenCategory) {
                $this->deleteCategory($childrenCategory['id']);
            }
        }

        $this->syncTreeRelationWithDelete($category);
    }

    public function getCategory($id)
    {
        return $this->getBinaryTreeCategoryDao()->get($id);
    }

    public function findChildrenCategories($category)
    {
        return $this->searchCategories(
            array(
                'left_GT' => $category['leftValue'],
                'right_LT' => $category['rightValue'],
            ),
            array(),
            0,
            PHP_INT_MAX
        );
    }

    public function searchCategories($conditions, $orderBys, $start, $limit)
    {
        return $this->getBinaryTreeCategoryDao()->search($conditions, $orderBys, $start, $limit);
    }

    public function countCategories($conditions)
    {
        return $this->getBinaryTreeCategoryDao()->count($conditions);
    }

    protected function validateCategoryFields($fields)
    {
        if (!ArrayToolkit::requireds($fields, array('name', 'code', 'type'), true)) {
            throw $this->createInvalidArgumentException('Lack of required fields');
        }
    }

    protected function filterCategoryFields($fields)
    {
        return ArrayToolkit::parts($fields, array('name', 'code', 'type', 'createdUserId', 'layer', 'leftValue', 'rightValue'));
    }

    protected function syncTreeRelationWithCreate($category)
    {
        $this->getBinaryTreeCategoryDao()->syncTreeRightWithCreate($category['leftValue']);
        $this->getBinaryTreeCategoryDao()->syncTreeLeftWithCreate($category['leftValue']);
    }

    protected function syncTreeRelationWithDelete($category)
    {
        $this->getBinaryTreeCategoryDao()->syncTreeRightWithDelete($category['leftValue'], $category['rightValue']);
        $this->getBinaryTreeCategoryDao()->syncTreeLeftWithDelete($category['leftValue'], $category['rightValue']);
    }

    /**
     * @return BinaryTreeCategoryDao
     */
    protected function getBinaryTreeCategoryDao()
    {
        return $this->createDao('BinaryTreeCategoryPlugin:BinaryTreeCategory:BinaryTreeCategoryDao');
    }
}