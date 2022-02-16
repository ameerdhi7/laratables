<?php

namespace Freshbitsweb\Laratables\Tests;

use Freshbitsweb\Laratables\Tests\Traits\CreatesUsers;
use Freshbitsweb\Laratables\Tests\Traits\PreparesDatatablesUrl;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesUsers, PreparesDatatablesUrl;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->withFactories(__DIR__.'/database/factories');

        $this->setupRoutes();
    }

    /**
     * Specify the package service provider.
     */
    protected function getPackageProviders($app)
    {
        return ['Freshbitsweb\Laratables\LaratablesServiceProvider'];
    }

    /**
     * Specifies routes for testing.
     *
     * @return void
     */
    private function setupRoutes()
    {
        Route::middleware('web')
            ->namespace('Freshbitsweb\Laratables\Tests\Stubs\Controllers')
            ->group(function () {
                Route::get('/datatables-simple', 'DatatablesController@simple');
                Route::get('/datatables-records-of-closure', 'DatatablesController@recordsOfClosure');
                Route::get('/datatables-records-of-class', 'DatatablesController@recordsOfClass');
                Route::get('/datatables-customized-column', 'DatatablesController@customizeColumn');
                Route::get('/datatables-custom-query', 'DatatablesController@customQuery');
                Route::get('/datatables-custom-relation-query', 'DatatablesController@customRelationQuery');
                Route::get('/datatables-custom-search', 'DatatablesController@customSearch');
                Route::get('/datatables-order', 'DatatablesController@order');
                Route::get('/datatables-custom-order', 'DatatablesController@customOrder');
                Route::get('/datatables-custom-order-raw', 'DatatablesController@customOrderRaw');
                Route::get('/datatables-multi-column-order', 'DatatablesController@multiColumnOrder');
                Route::get('/datatables-additional-column', 'DatatablesController@additionalColumn');
                Route::get('/datatables-modify-collection', 'DatatablesController@modifyCollection');
                Route::get('/datatables-searchable-columns', 'DatatablesController@searchableColumns');
                Route::get('/datatables-non-searchable-columns', 'DatatablesController@nonSearchableColumns');
                Route::get('/datatables-limit-1-record', 'DatatablesController@limit1Record');
                Route::get('/datatables-no-limit', 'DatatablesController@noLimit');
                Route::get('/datatables-max-limit-20', 'DatatablesController@maxLimit20');
            })
        ;
    }
}
