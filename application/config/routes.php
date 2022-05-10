<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'Authentication/login';
$route['register'] = 'Authentication/register';

$route['set_forgot_password'] = 'Authentication/set_forgot_password';
$route['get_fp_question'] = 'Authentication/get_fp_question';

//To check mail Existes
$route['check_mail_exists'] = 'Authentication/check_mail_exists';
//To get the forgot password question
$route['get_fp_question'] = 'Authentication/get_fp_question';

$route['validate_answer'] = 'Authentication/validate_answer';
$route['reset_password'] = 'Authentication/reset_password';
$route['get_organization'] = 'Authentication/get_organization';
$route['get_department'] = 'Authentication/get_department';
$route['get_role'] = 'Authentication/get_role';

$route['register_user'] = 'Authentication/register_user';

$route['add_details'] = 'EmployeeDetails/add_details';

$route['show_verifications'] = 'AdminController/show_verifications';
$route['show_employees'] = 'AdminController/show_employees';

$route['accept_principle_request'] = 'AdminController/accept_principle_request';
$route['decline_principle_request'] = 'AdminController/decline_principle_request';
$route['delete_employee'] = 'AdminController/delete_employee';
