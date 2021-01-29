<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Classitem extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table  =  $this->table('classitem',array('engine'=>'MyISAM'));
        $table->addColumn('classid', 'integer',array('limit'  =>  10,'default'=>0,'comment'=>'价格类型id'))
            ->addColumn('name', 'string',array('limit'  =>  60,'default'=>'','comment'=>'配置项名称'))
            ->addColumn('sort', 'integer',array('limit'  => 10,'default'=>100,'comment'=>'排序'))
            ->addColumn('value', 'decimal',array('precision'=>10,'scale'=>4,'default'=>0,'comment'=>'值/价格'))
            ->addColumn('nvalue', 'decimal',array('precision'=>10,'scale'=>4,'default'=>0,'comment'=>'值/价格'))
            ->addColumn('formtype', 'integer',array('limit'  => 10,'default'=>100,'comment'=>'表单类型，1：单行，2：多行'))
            ->addIndex(array('name'), array('unique'  =>  false))
            ->create();
    }
}
