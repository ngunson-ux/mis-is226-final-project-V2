<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route (optional but recommended)
//$routes->get('/', 'Home::index');

/*
|--------------------------------------------------------------------------
| MAIN PAGES
|--------------------------------------------------------------------------
*/
$routes->get('manage-brand', 'ManageBrand::getIndex');
$routes->get('manage-menu', 'ManageMenu::getIndex');
$routes->get('edit-menu', 'ManageMenu::getIndex');
$routes->get('add-menu', 'ManageMenu::getCreate');
$routes->get('add-bom', 'AddBom::getIndex');
$routes->get('brand-selection', 'Brand::getSelection');
$routes->post('add-menu/store', 'ManageMenu::postStore');
$routes->get('inventory-days-report', 'InventoryDaysReport::getIndex');
$routes->get('cloud-kitchen-home', 'CloudKitchenHome::getIndex');
$routes->get('delivery-partners', 'CloudKitchenHome::deliveryPartners');
$routes->get('reports-home', 'CloudKitchenHome::reportsHome');
$routes->get('add-bom/(:num)', 'AddBom::getIndex/$1');
$routes->get('view-bom/(:num)', 'ManageMenu::getBomDetails/$1');

/*
|--------------------------------------------------------------------------
| YOUR FEATURE (ORDERS + CUSTOMERS)
|--------------------------------------------------------------------------
*/
$routes->get('orders', 'Orders::index');
$routes->get('customers', 'Customers::index');
$routes->get('transactions', 'Transactions::index');

/*
|--------------------------------------------------------------------------
| CUSTOMER DEMOGRAPHICS REPORT (Non-API Routes)
|--------------------------------------------------------------------------
*/
$routes->get('report-customer-demographics', 'ReportCustomerDemographics::index');
$routes->get('report-customer-demographics/export-csv', 'ReportCustomerDemographics::exportCsv');

/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
*/
$routes->group('api', function($routes) {

    // BRAND
    $routes->get('brand', 'Api\Brand::getIndex');
    $routes->get('brand/(:num)', 'Api\Brand::getIndex/$1');
    $routes->post('brand', 'Api\Brand::create');
    $routes->put('brand/(:num)', 'Api\Brand::update/$1');
    $routes->delete('brand/(:num)', 'Api\Brand::delete/$1');

    // INGREDIENTS
    $routes->get('brand/(:num)/ingredients', 'Api\Ingredients::getIndex/$1');
    $routes->get('brand/(:num)/ingredients/(:num)', 'Api\Ingredients::getIndex/$1/$2');
    $routes->post('brand/(:num)/ingredients', 'Api\Ingredients::postIndex/$1');
    $routes->put('brand/(:num)/ingredients/(:num)', 'Api\Ingredients::putIndex/$1/$2');
    $routes->delete('brand/(:num)/ingredients/(:num)', 'Api\Ingredients::deleteIndex/$1/$2');

    // BILL OF MATERIALS
    $routes->get('brand/(:num)/ingredients/categories', 'Api\Ingredients::getCategories/$1');
    $routes->get('brand/(:num)/menu-item/(:num)/ingredients', 'Api\Ingredients::getMenuItemIngredients/$1/$2');
    $routes->post('brand/(:num)/menu-item/(:num)/ingredients', 'Api\Ingredients::postMenuItemIngredients/$1/$2');

    $routes->get('delivery-expense', 'Api\DeliveryExpense::getIndex');
    $routes->get('delivery-expense/(:num)', 'Api\DeliveryExpense::getIndex/$1');
    $routes->post('delivery-expense', 'Api\DeliveryExpense::create');
    $routes->put('delivery-expense/(:num)', 'Api\DeliveryExpense::update/$1');
    $routes->delete('delivery-expense/(:num)', 'Api\DeliveryExpense::delete/$1');

    $routes->get('rider-payment', 'Api\RiderPayment::getIndex');
    $routes->get('rider-payment/(:num)', 'Api\RiderPayment::getIndex/$1');
    $routes->post('rider-payment', 'Api\RiderPayment::create');
    $routes->put('rider-payment/(:num)', 'Api\RiderPayment::update/$1');
    $routes->delete('rider-payment/(:num)', 'Api\RiderPayment::delete/$1');

    $routes->get('report/best-seller/popular', 'Api\BestSellerReport::getPopular');
    $routes->get('report/best-seller/revenue', 'Api\BestSellerReport::getRevenue');

    // DELIVERY PARTNERS
    $routes->get('delivery-partner', 'Api\DeliveryPartner::index');
    $routes->get('delivery-partner/(:num)', 'Api\DeliveryPartner::index/$1');
    $routes->post('delivery-partner', 'Api\DeliveryPartner::create');
    $routes->put('delivery-partner/(:num)', 'Api\DeliveryPartner::update/$1');
    $routes->delete('delivery-partner/(:num)', 'Api\DeliveryPartner::delete/$1');

    $routes->get('report/brand/(:num)/sales-performance/', 'Api\SalesPerformanceReport::getIndex/$1');

    // CUSTOMER DEMOGRAPHICS API
    $routes->get('customer-demographics-report', 'Api\CustomerDemographics::getReport');
    $routes->get('customer-demographics-report/by-date-range', 'Api\CustomerDemographics::getByDateRange');
    $routes->get('report-customer-demographics/export-age-distribution', 'ReportCustomerDemographics::exportAgeDistribution');
    $routes->get('report-customer-demographics/export-gender-distribution', 'ReportCustomerDemographics::exportGenderDistribution');

});

$routes->get('manage-brand', 'ManageBrand::getIndex');
$routes->get('manage-delivery-expense', 'ManageDeliveryExpense::getIndex');
$routes->get('manage-rider-payment', 'ManageRiderPayment::getIndex');
$routes->get('delivery-management', 'DeliveryManagement::getIndex');
$routes->get('report-best-seller', 'ReportBestSeller::getIndex');
$routes->get('report-sales-performance', 'ReportSalesPerformance::getIndex');
$routes->get('report-customer-demographics', 'ReportCustomerDemographics::index');
