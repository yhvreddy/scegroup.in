<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'WebsiteController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Site Links
$route['aboutus']                       =   'WebsiteController/aboutusPage';
$route['services']                      =   'WebsiteController/servicesPage';
$route['projects']                      =   'WebsiteController/projectsPage';
$route['contactus']                     =   'WebsiteController/contactusPage';

//Admin Panel Links
$route['admin']                         =   'admin/AdminController/index';
$route['admin/loginaccess']             =   'admin/AdminController/loginAccess';
$route['admin/dashboard']               =   'admin/AdminController/welcomePage';
$route['admin/logoutaccess']            =   'admin/AdminController/logoutAccess';

$route['admin/sitedetails']             =   'admin/SitedetailsController/siteDetails';
$route['admin/savesitedetails']         =   'admin/SitedetailsController/saveSiteDetails';
$route['admin/saveditsitedetails']      =   'admin/SitedetailsController/savEditsiteDetails';

$route['admin/banners']                 =   'admin/BannerController/index';
$route['admin/banners/uplaod']          =   'admin/BannerController/uplaodBanners';
$route['admin/banners/:num/delete']     =   'admin/BannerController/deleteBanners';
$route['admin/banners/:num/edit']       =   'admin/BannerController/editBanners';
$route['admin/banners/saveditdetails']  =   'admin/BannerController/saveEditdetails';