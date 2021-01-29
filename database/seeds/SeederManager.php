<?php

use think\migration\Seeder;
use think\facade\Db;

class SeederManager extends Seeder
{

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ];
        Db::name('manager')->save($data);
    }

}
