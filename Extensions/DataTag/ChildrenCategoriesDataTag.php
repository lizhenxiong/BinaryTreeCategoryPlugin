<?php

namespace BinaryTreeCategoryPlugin\Extensions\DataTag;

use AppBundle\Extensions\DataTag\BaseDataTag;
use AppBundle\Extensions\DataTag\DataTag;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\BinaryTreeCategoryService;

class ChildrenCategoriesDataTag extends BaseDataTag implements DataTag
{
    public function getData(array $arguments)
    {
        $left = $arguments['left'];
        $right = $arguments['right'];
        $layer = $arguments['layer'];
        $type = $arguments['type'];

        $conditions = array(
            'left_GT' => $left,
            'right_LT' => $right,
            'layer' => $layer + 1,
            'type' => $type,
        );

        $childrenCategories = $this->getBinaryTreeCategoryService()->searchCategories(
            $conditions,
            array(),
            0,
            PHP_INT_MAX
        );

        return $childrenCategories;
    }

    /**
     * @return BinaryTreeCategoryService
     */
    protected function getBinaryTreeCategoryService()
    {
        return $this->getServiceKernel()->createService('BinaryTreeCategoryPlugin:BinaryTreeCategory:BinaryTreeCategoryService');
    }
}
