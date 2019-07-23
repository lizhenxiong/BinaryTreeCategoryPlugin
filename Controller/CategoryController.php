<?php

namespace BinaryTreeCategoryPlugin\Controller;

use AppBundle\Controller\BaseController;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\BinaryTreeCategoryService;

class CategoryController extends BaseController
{
    public function indexAction()
    {
        $categories = $this->getBinaryTreeCategoryService()->searchCategories(
            array(),
            array(),
            0,
            PHP_INT_MAX
        );

        return $this->render('BinaryTreeCategoryPlugin:Default:index.html.twig');
    }

    public function createAction()
    {

    }

    public function deleteAction()
    {

    }

    /**
     * @return BinaryTreeCategoryService
     */
    protected function getBinaryTreeCategoryService()
    {
        return $this->createService('BinaryTreeCategoryPlugin:BinaryTreeCategory:BinaryTreeCategoryService');
    }
}
