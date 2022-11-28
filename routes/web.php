<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\AdminSaleComponent;
use App\Http\Livewire\User\UserOrderComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\Admin\AdminSliderComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminAddSliderComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\User\UserOrderDetailComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminEditSliderComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminOrderDetailComponent;
use App\Http\Livewire\User\UserUpdateProfileComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminDeleteUpdateCategoryComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class);
Route::get('/cart', CartComponent::class)->name('products.cart');
Route::get('/wishlist', WishlistComponent::class)->name('products.wishlist');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/thankyou', ThankyouComponent::class)->name('thankyou');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/category/{slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');

// for user
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // user dashboard section
    Route::get("/user/dashboard", UserDashboardComponent::class)->name('user.dashboard');

    // user order section
    Route::get("/user/orders", UserOrderComponent::class)->name('user.orders');
    Route::get("/user/orders/{orderr}", UserOrderDetailComponent::class)->name('user.order.detail');
    // end user order

    // user profile section
    Route::get("/user/profile", UserProfileComponent::class)->name('profile.show');
    Route::get("/user/profile/{profile:user_id}", UserUpdateProfileComponent::class)->name('user.update.profile');
    // end profile
});

// for admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authAdmin'
])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    // category section
    Route::get('/admin/category', AdminCategoryComponent::class)->name('admin.category');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.add.category');
    Route::get('/admin/category/update/{category:slug}', AdminDeleteUpdateCategoryComponent::class)->name('admin.update.category');
    // end category section
    // product section
    Route::get('/admin/product', AdminProductComponent::class)->name('admin.product');
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.add.product');
    Route::get('/admin/product/update/{product:slug}', AdminEditProductComponent::class)->name('admin.update.product');
    // end product section
    // Sliders section
    Route::get('/admin/Sliders', AdminSliderComponent::class)->name('admin.sliders');
    Route::get('/admin/Sliders/add', AdminAddSliderComponent::class)->name('admin.add.slider');
    Route::get('/admin/Sliders/update/{slider}', AdminEditSliderComponent::class)->name('admin.update.slider');
    // end Sliders section
    // home-category section
    Route::get('/admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.home.categories');
    // Route::get('/admin/home-categories/add', AdminAddSliderComponent::class)->name('admin.add.slider');
    // Route::get('/admin/home-categories/update/{slider}', AdminEditSliderComponent::class)->name('admin.update.slider');
    // end Sliders section
    // admin sale section
    Route::get('/admin/sale', AdminSaleComponent::class)->name('admin.sale');
    // end sale section
    // Coupons section
    Route::get('/admin/coupons', AdminCouponsComponent::class)->name('admin.coupons');
    Route::get('/admin/coupons/add', AdminAddCouponComponent::class)->name('admin.add.coupon');
    Route::get('/admin/coupons/update/{coupon}', AdminEditCouponComponent::class)->name('admin.update.coupon');
    // end Coupons section
    // admin order section
    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/order/{orderr}', AdminOrderDetailComponent::class)->name('admin.order.detail');
    // end admin order section
});
