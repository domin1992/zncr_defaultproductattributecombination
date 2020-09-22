<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class Zncr_Defaultproductattributecombination extends Module implements WidgetInterface
{
    public function __construct()
    {
        $this->name = 'zncr_defaultproductattributecombination';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Dominik Nowak';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Zncr Default Product Attribute Combination');
        $this->description = $this->l('Zncr Default Product Attribute Combination');
        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);
        $this->controllers = array('cron');
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getWidgetVariables($hookName, array $params)
    {
        return array();
    }

    public function renderWidget($hookName, array $params)
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $params));
        return $this->fetch('module:zncr_defaultproductattributecombination/zncr_defaultproductattributecombination.tpl');
    }
}
