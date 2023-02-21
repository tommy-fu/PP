<?php

namespace Tests;

use App\Domain\Users\User;
use Closure;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\SQLiteBuilder;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Fluent;
use JMac\Testing\Traits\AdditionalAssertions;

abstract class DbTestCase extends BaseTestCase
{
    use WithFaker;
    use CreatesApplication;
    use DatabaseMigrations;
    use DatabaseTransactions;
    use AdditionalAssertions;


    protected function setUp(): void
    {
        $this->hotfixSqlite();
        parent::setUp();
    }


    public function hotfixSqlite()
    {
        \Illuminate\Database\Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new class($connection, $database, $prefix, $config) extends SQLiteConnection {
                public function getSchemaBuilder()
                {
                    if ($this->schemaGrammar === null) {
                        $this->useDefaultSchemaGrammar();
                    }

                    return new class($this) extends SQLiteBuilder {
                        protected function createBlueprint($table, Closure $callback = null)
                        {
                            return new class($table, $callback) extends Blueprint {
                                public function dropForeign($index)
                                {
                                    return new Fluent();
                                }
                            };
                        }
                    };
                }
            };
        });
    }


    protected function signIn($user = null)
    {
        $user = $user ?: Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->be($user);

        return $this;
    }

    //	public function __construct(?string $name = null, array $data = [], string $dataName = '')
//	{
//		$this->hotfixSqlite();
//		parent::__construct($name, $data, $dataName);
//
//	}
//	/**
//	 *
//	 */
//	public function hotfixSqlite()
//	{
//		\Illuminate\Database\Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
//			return new class($connection, $database, $prefix, $config) extends SQLiteConnection {
//				public function getSchemaBuilder()
//				{
//					if ($this->schemaGrammar === null) {
//						$this->useDefaultSchemaGrammar();
//					}
//					return new class($this) extends SQLiteBuilder {
//						protected function createBlueprint($table, Closure $callback = null)
//						{
//							return new class($table, $callback) extends Blueprint {
//								public function dropForeign($index)
//								{
//									return new Fluent();
//								}
//							};
//						}
//					};
//				}
//			};
//		});
//	}
}
