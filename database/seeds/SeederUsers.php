<?php

use think\migration\Seeder;
use think\facade\Db;

class SeederUsers extends Seeder
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
        $data = [];
        for ($i = 1; $i < 100; $i++) {
            $data[] = [
                'username' => 'test' . $i,
                'password' => password_hash("123456", PASSWORD_DEFAULT),
            ];
        }
        Db::name('users')->insertAll($data);
    }
}