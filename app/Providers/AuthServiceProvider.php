<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\SupportTicket;
use App\Models\Review;
use App\Policies\OrderPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ShippingPolicy;
use App\Policies\SupportTicketPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\BrandPolicy;
use App\Policies\UserCredentialPolicy;
use App\Policies\MetricsPolicy;
use App\Models\Brand;
use App\Models\UserCredential;
use App\Models\Metrics;
use App\Policies\CartItemPolicy;
use App\Models\CartItem;
use App\Policies\MetricPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Order::class => OrderPolicy::class,
        Payment::class => PaymentPolicy::class,
        Product::class => ProductPolicy::class,
        Shipping::class => ShippingPolicy::class,
        SupportTicket::class => SupportTicketPolicy::class,
        Review::class => ReviewPolicy::class,
        Brand::class => BrandPolicy::class,
        UserCredential::class => UserCredentialPolicy::class,
        CartItem::class => CartItemPolicy::class,
        Metrics::class => MetricsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        // Define basic role gates
        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });
        
        Gate::define('staff', function ($user) {
            return $user->isStaff();
        });
        
        Gate::define('admin-or-staff', function ($user) {
            return $user->isAdmin() || $user->isStaff();
        });
    }
}