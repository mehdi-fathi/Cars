<?php
use Migrations\AbstractMigration;

class Cars extends AbstractMigration
{
    public function up()
    {

        $this->table('companies')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('established_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('logo_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('locations')
            ->addColumn('latitube', 'string', [
                'default' => null,
                'limit' => 70,
                'null' => false,
            ])
            ->addColumn('longitube', 'string', [
                'default' => null,
                'limit' => 70,
                'null' => false,
            ])
            ->create();

        $this->table('logos')
            ->addColumn('path', 'string', [
                'default' => null,
                'limit' => 250,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('size', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 250,
                'null' => true,
            ])
            ->addColumn('error', 'integer', [
                'default' => '0',
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('tmp_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('companies');
        $this->dropTable('locations');
        $this->dropTable('logos');
    }
}
