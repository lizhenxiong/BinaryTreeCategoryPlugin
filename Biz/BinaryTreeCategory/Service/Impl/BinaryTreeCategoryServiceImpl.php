<?php
namespace BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\Impl;

/**
 * EduSoho系统可引用以下BaseService
 * Biz\BaseService
 */
use Codeages\Biz\Framework\Service\BaseService;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\BinaryTreeCategoryService;

class BinaryTreeCategoryServiceImpl extends BaseService implements BinaryTreeCategoryService
{
    protected function getBinaryTreeCategoryDao()
    {
        return $this->createDao('BinaryTreeCategoryPlugin:BinaryTreeCategory:BinaryTreeCategoryDao');
    }
}