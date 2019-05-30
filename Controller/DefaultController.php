<?php

namespace BinaryTreeCategoryPlugin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BinaryTreeCategoryPlugin:Default:index.html.twig');
    }
}
