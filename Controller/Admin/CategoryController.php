<?php

namespace BinaryTreeCategoryPlugin\Controller\Admin;


use AppBundle\Controller\Admin\BaseController;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Service\BinaryTreeCategoryService;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends BaseController
{
    public function indexAction(Request $request)
    {
        $categories = $this->getBinaryTreeCategoryService()->searchCategories(
            array('layer' => 1),
            array('createdTime' => 'DESC'),
            0,
            PHP_INT_MAX
        );

        return $this->render(
            'BinaryTreeCategoryPlugin::admin/category/index.html.twig',
            array(
                'categories' => $categories,
            )
        );
    }

    public function createAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $fields = $request->request->all();
            $fields['layer'] = 1;
            $this->getBinaryTreeCategoryService()->createCategory($fields);

            return $this->redirect($this->generateUrl('admin_binary_tree_category'));
        }

        return $this->render(
            'BinaryTreeCategoryPlugin::admin/category/create-modal.html.twig'
        );
    }

    public function createChildrenAction(Request $request, $parentId)
    {
        if ($request->getMethod() == 'POST') {
            $fields = $request->request->all();
            $fields['parentId'] = $parentId;

            $this->getBinaryTreeCategoryService()->createChildrenCategory($fields);

            return $this->redirect($this->generateUrl('admin_binary_tree_category'));
        }

        $parentCategory = $this->getBinaryTreeCategoryService()->getCategory($parentId);
        return $this->render(
            'BinaryTreeCategoryPlugin::admin/category/create-children-modal.html.twig',
            array(
                'parentCategory' => $parentCategory,
            )
        );
    }

    public function deleteAction(Request $request, $id)
    {
        return $this->getBinaryTreeCategoryService()->deleteChildrenCategory($id);
    }

    /**
     * @return BinaryTreeCategoryService
     */
    protected function getBinaryTreeCategoryService()
    {
        return $this->createService('BinaryTreeCategoryPlugin:BinaryTreeCategory:BinaryTreeCategoryService');
    }
}