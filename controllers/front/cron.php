<?php

class Zncr_DefaultproductattributecombinationCronModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $object;

    public function __construct()
    {
        parent::__construct();
        $this->context = Context::getContext();
    }

    public function init()
    {
        parent::init();

        $defaultProductAttributes = Db::getInstance()->ExecuteS('SELECT id_product_attribute, id_product FROM '._DB_PREFIX_.'product_attribute_shop WHERE default_on = 1 AND id_shop = '.(int)$this->context->shop->id);
        foreach($defaultProductAttributes as $productAttribute){
            if((int)StockAvailable::getQuantityAvailableByProduct($productAttribute['id_product'], $productAttribute['id_product_attribute']) <= 0){
                $this->setOtherProductAttributeAsDefault($productAttribute['id_product'], $productAttribute['id_product_attribute'], $this->context->shop->id);
            }
        }

        exit;
    }

    protected function setOtherProductAttributeAsDefault($idProduct, $idProductAttribute)
    {
        $product = new Product($idProduct);
        $productAttributes = Db::getInstance()->ExecuteS('SELECT id_product_attribute FROM '._DB_PREFIX_.'product_attribute_shop WHERE default_on IS NULL AND id_product = '.(int)$idProduct.' AND id_shop = '.(int)$this->context->shop->id.' ORDER BY price ASC');
        foreach($productAttributes as $productAttribute){
            if((int)StockAvailable::getQuantityAvailableByProduct($idProduct, $productAttribute['id_product_attribute'], $this->context->shop->id) > 0){
                $product->deleteDefaultAttributes();
                $product->setDefaultAttribute($productAttribute['id_product_attribute']);
                return;
            }
        }
    }
}