<?php

namespace BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Dao;

use Codeages\Biz\Framework\Dao\GeneralDaoInterface;

interface BinaryTreeCategoryDao extends GeneralDaoInterface
{
    public function syncTreeRightWithCreate($value);

    public function syncTreeLeftWithCreate($value);

    public function syncTreeRightWithDelete($leftValue, $rightValue);

    public function syncTreeLeftWithDelete($leftValue, $rightValue);
}