<?php

namespace App\Providers;

use App\DBrepo\Item\DBitem;
use App\DBrepo\User\DBauth;
use App\DBrepo\User\DBuser;
use App\DBrepo\General\DBpos;
use App\DBrepo\payment\DBTax;

use App\DBrepo\table\DBtable;

use App\DBrepo\Item\DBoptions;
use App\DBrepo\Item\DBPackage;

use App\DBrepo\General\DBOrder;
use App\DBrepo\waiter\DBwaiter;
use App\DBrepo\General\DBservice;
use App\DBrepo\Item\DBitemCategory;
use App\DBrepo\Order\DBorderPayment;
use App\DBrepo\payment\DBpaymentType;
use App\DBrepo\Item\DBitemSubCategory;
use Illuminate\Support\ServiceProvider;
use App\RepoInterface\Item\ItemInterface;
use App\RepoInterface\User\AuthInterface;

use App\RepoInterface\User\UserInterface;

use App\RepoInterface\General\PosInterface;
use App\RepoInterface\Order\OrderInterface;

use App\RepoInterface\payment\TaxInterface;
use App\RepoInterface\table\TableInterface;
use App\RepoInterface\Item\OptionsInterface;
use App\RepoInterface\Item\PackageInterface;
use App\RepoInterface\waiter\waiterInterface;
use App\RepoInterface\General\ServiceInterface;
use App\RepoInterface\Item\ItemCategoryInterface;
use App\RepoInterface\Order\orderPaymentInterface;
use App\RepoInterface\payment\PaymentTypeInterface;
use App\RepoInterface\Item\ItemSubCategoryInterface;


class RpoServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {



        $this->app->bind(UserInterface::class, DBuser::class);

        $this->app->bind(AuthInterface::class, DBauth::class);
        $this->app->bind(PosInterface::class, DBpos::class);
        $this->app->bind(ServiceInterface::class, DBservice::class);
        $this->app->bind(ItemCategoryInterface::class, DBitemCategory::class);
        $this->app->bind(ItemSubCategoryInterface::class, DBitemSubCategory::class);
        $this->app->bind(ItemInterface::class, DBitem::class);
        $this->app->bind(OptionsInterface::class, DBoptions::class);
        $this->app->bind(TaxInterface::class, DBTax::class);
        $this->app->bind(PackageInterface::class, DBPackage::class);
        $this->app->bind(OrderInterface::class, DBOrder::class);
        $this->app->bind(orderPaymentInterface::class, DBorderPayment::class);



        $this->app->bind(PaymentTypeInterface::class, DBpaymentType::class);
        $this->app->bind(TableInterface::class, DBtable::class);
        $this->app->bind(waiterInterface::class, DBwaiter::class);
    }
}
