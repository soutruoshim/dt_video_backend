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
| my-controller/my-method	-> my_controller/my_method
*/

$route['api/login'] = 'api/user/login';
$route['api/loginwithotp'] = 'api/user/loginwithotp';
$route['api/registration'] = 'api/user/registration';
$route['api/profile'] = 'api/user/profile';
$route['api/update_profile'] = 'api/user/update_profile';
$route['api/categorylist'] = 'api/home/categorylist';
$route['api/artistlist'] = 'api/home/artistlist';
$route['api/videolist'] = 'api/home/videolist';
$route['api/video_list'] = 'api/home/video_list';
$route['api/latestvideos'] = 'api/home/latestvideos';
$route['api/mostviewvideos'] = 'api/home/mostviewvideos';
$route['api/featurevideos'] = 'api/home/featurevideos';
$route['api/video_by_category'] = 'api/home/video_by_category';
$route['api/video_by_artist'] = 'api/home/video_by_artist';
$route['api/video_by_id'] = 'api/home/video_by_id';
$route['api/related_item'] = 'api/home/related_item';
$route['api/add_view'] = 'api/home/add_view';

$route['api/add_favorite'] = 'api/home/add_favorite';
$route['api/checkfavorite'] = 'api/home/checkfavorite';
$route['api/favorite_list'] = 'api/home/favorite_list';
$route['api/general_setting'] = 'api/home/general_setting';
$route['api/artist_profile'] = 'api/home/artist_profile';
$route['api/forgotpassword'] = 'api/user/forgotpassword';
$route['api/videosearch'] = 'api/home/videosearch';

$route['api/add_transaction'] = 'api/home/add_transaction';
$route['api/get_package_transaction'] = 'api/home/get_package_transaction';

$route['api/get_packages'] = 'api/home/get_packages';


// New API 
$route['api/get_album'] = 'api/home/getAlbum';
$route['api/get_album_detail'] = 'api/home/getAlbumDetail';

$route['api/like_dislike'] = 'api/rating/likeDislike';
$route['api/add_comment'] = 'api/rating/add_comment';
$route['api/view_comment'] = 'api/rating/view_comment';
$route['api/add_album'] = 'api/rating/addAlbum';
$route['api/add_ratings'] = 'api/rating/add_ratings';
$route['api/get_notification'] = 'api/rating/get_notification';
$route['api/read_notification'] = 'api/rating/read_notification';

$route['api/follow'] = 'api/rating/follow';
$route['api/following_list'] = 'api/rating/following_list';
$route['api/follow_list'] = 'api/rating/follow_list';

$route['page/(:any)'] = 'page/index';
$route['admin'] = 'admin/login';


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;