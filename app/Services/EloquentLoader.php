<?php namespace App\Services;

use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentLoader
{
    /**
     * @var array
     */
    private $dbConfig;

    /**
     * @param array $dbConfig
     */
    public function __construct(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }

    public function load()
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $this->dbConfig['DATABASE_HOST'],
            'database'  => $this->dbConfig['DATABASE_NAME'],
            'username'  => $this->dbConfig['DATABASE_USER'],
            'password'  => $this->dbConfig['DATABASE_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}
