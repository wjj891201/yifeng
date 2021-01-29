<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Classs extends Migrator
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
        $table  =  $this->table('classs',array('engine'=>'MyISAM'));
        $table->addColumn('name', 'string',array('limit'  =>  60,'default'=>'','comment'=>'价格类型'))
            ->addColumn('label', 'string',array('limit'  =>  60,'default'=>'','comment'=>'标识'))
            ->addColumn('sort', 'integer',array('limit'  => 10,'default'=>100,'comment'=>'排序'))
            ->addIndex(array('name'), array('unique'  =>  true))
            ->addIndex(array('label'), array('unique'  =>  true))
            ->create();
    }
}
