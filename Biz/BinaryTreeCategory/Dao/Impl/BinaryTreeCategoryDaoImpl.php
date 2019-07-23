<?php

namespace BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Dao\Impl;

use Codeages\Biz\Framework\Dao\GeneralDaoImpl;
use BinaryTreeCategoryPlugin\Biz\BinaryTreeCategory\Dao\BinaryTreeCategoryDao;

class BinaryTreeCategoryDaoImpl extends GeneralDaoImpl implements BinaryTreeCategoryDao
{
    protected $table = 'binary_tree_category';

    public function syncTreeRightWithCreate($value)
    {
        $sql = "UPDATE {$this->table} SET rightValue = rightValue + 2 WHERE rightValue >= ?";
        return $this->db()->executeUpdate($sql, array($value));
    }

    public function syncTreeLeftWithCreate($value)
    {
        $sql = "UPDATE {$this->table} SET leftValue = leftValue + 2 WHERE leftValue >= ?";
        return $this->db()->executeUpdate($sql, array($value));
    }

    public function syncTreeRightWithDelete($left, $right)
    {
        $sql = "UPDATE {$this->table} SET leftValue = (? - ? + 1) WHERE leftValue > ?";
        return $this->db()->executeUpdate($sql, array($right, $left, $left));
    }

    public function syncTreeLeftWithDelete($left, $right)
    {
        $sql = "UPDATE {$this->table} SET rightValue = (? - ? + 1) WHERE rightValue > ?";
        return $this->db()->executeUpdate($sql, array($right, $left, $right));
    }

    public function declares()
    {
        return array(
            'timestamps' => array('createdTime', 'updatedTime'),
            'serializes' => array(),
            'orderbys' => array('createdTime'),
            'conditions' => array(
                'id NOT IN (:excludeIds)',
                'id IN (:ids)',
                'name LIKE :likeName',
                'name = :name',
                'code = :code',
                'layer = :layer',
                'type = :type',
                'createdUserId = :createdUserId',
                'leftValue >= :left_GE',
                'leftValue > :left_GT',
                'leftValue <= :left_LE',
                'leftValue < :left_LT',
                'rightValue >= :right_GE',
                'rightValue > :right_GT',
                'rightValue <= :right_LE',
                'rightValue < :right_LT',
            ),
        );
    }

}