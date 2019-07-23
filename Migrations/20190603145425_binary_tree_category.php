<?php

use Phpmig\Migration\Migration;

class BinaryTreeCategory extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $biz = $this->getContainer();
        $db = $biz['db'];

        $db->exec("
            CREATE TABLE IF NOT EXISTS `binary_tree_category` (
              `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类ID',
              `code` varchar(64) NOT NULL DEFAULT '' COMMENT '分类编码',
              `name` varchar(255) NOT NULL COMMENT '分类名称',
              `layer` int(11) NOT NULL DEFAULT '0' COMMENT '分类层级',
              `left` int(11) NOT NULL DEFAULT '0' COMMENT '分类左值',
              `right` int(11) NOT NULL DEFAULT '0' COMMENT '分类右值',
              `createdTime` int(11) NOT NULL DEFAULT '0',
              `updatedTime` int(10) NOT NULL DEFAULT '0',
              `description` text,
              PRIMARY KEY (`id`),
              UNIQUE KEY `uri` (`code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $biz = $this->getContainer();
        $db = $biz['db'];

        $db->exec("
            DROP TABLE IF EXISTS `binary_tree_category`;
        ");
    }
}
