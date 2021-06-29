<?php
namespace Controller\Admin;

//商品模块
class ProductsController
{
    //获取商品列表
    public function listAction()
    {
        //实例化模型
        $model = \Model\ProductsModel();
        $list = $model->getList();
        //加载视图
        require __VIEW__.'products_list.html';
    }

    //删除商品
    public function delAction()
    {
        $model = new \Model\ProductsModel();
    }
}

