<?php

namespace BinaryTreeCategoryPlugin;

use Codeages\PluginBundle\System\PluginBase;

class BinaryTreeCategoryPlugin extends PluginBase
{
    public function boot()
    {
        parent::boot();
    }

    public function getEnabledExtensions()
    {
        return array('DataTag', 'StatusTemplate', 'DataDict', 'NotificationTemplate');
    }
}
