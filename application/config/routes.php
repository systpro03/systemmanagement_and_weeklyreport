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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']                             = 'Auth/Login_ctrl/index';
$route['login_data']                        = 'Auth/Login_ctrl/login_data';
$route['logout']                            = 'Auth/Login_ctrl/logout_data'; 

$route['session_expire']                    = 'Auth/Login_ctrl/session_expire';

$route['member_view']                       = 'Menu/Member/member_view';


$route['dashboard']                         = 'Dashboard/index';
$route['get_birthdays']                     = 'Dashboard/get_birthdays';
$route['profile']                           = 'Dashboard/profile';
$route['update_password']                   = 'Dashboard/update_password';

// admin setup
$route['add_user_view']                     = 'Admin/add_user_view';
$route['user_list']                         = 'Admin/user_list';
$route['search']                            = 'Admin/search';
$route['emp_data']                          = 'Admin/emp_data';
$route['add_user']                          = 'Admin/add_user';
$route['update_user_content']               = 'Admin/update_user_content';
$route['update_user']                       = 'Admin/update_user';
$route['reset_password']                    = 'Admin/reset_password';
$route['delete_user']                       = 'Admin/delete_user';

$route['company_phone_view']                = 'Admin/company_phone_view';
$route['list_company_phone']                = 'Admin/list_company_phone';
$route['list_company_phone_dashboard']      = 'Dashboard/list_company_phone_dashboard';
$route['add_company_phone']                 = 'Admin/add_company_phone';
$route['update_company_phone']              = 'Admin/update_company_phone';
$route['delete_company_phone']              = 'Admin/delete_company_phone';

$route['team_list']                         = 'Admin/team_list';
$route['add_team']                          = 'Admin/add_team';
$route['update_team']                       = 'Admin/update_team';
$route['delete_team']                       = 'Admin/delete_team';

$route['get_team']                          = 'Admin/get_team';
$route['get_team5']                          = 'Admin/get_team5';
$route['get_t']                             = 'Admin/get_t';
$route['kpi_view']                          = 'Admin/kpi_view';
$route['kpi_list']                          = 'Admin/kpi_list';
$route['create_kpi']                        = 'Admin/create_kpi';
$route['edit_kpi']                          = 'Admin/edit_kpi';
$route['update_kpi']                        = 'Admin/update_kpi';
$route['delete_kpi']                        = 'Admin/delete_kpi';

$route['module_view']                       = 'Admin/module_view';
$route['admin_module_view']                 = 'Admin/admin_module_view';
$route['admin_module_list']                 = 'Admin/admin_module_list';
$route['module_list']                       = 'Admin/module_list';
$route['add_module']                        = 'Admin/add_module';
$route['edit_module']                       = 'Admin/edit_module';
$route['update_module']                     = 'Admin/update_module';
$route['delete_module']                     = 'Admin/delete_module';
$route['deleteModuleset']                   = 'Admin/deleteModuleset';
$route['view_submodule']                    = 'Admin/view_submodule';
$route['submodule_list']                    = 'Admin/submodule_list';
$route['add_submodule_content']             = 'Admin/add_submodule_content';
$route['insert_submodule']                  = 'Admin/insert_submodule';
$route['edit_submodule_content']            = 'Admin/edit_submodule_content';
$route['update_submodule']                  = 'Admin/update_submodule';
$route['delete_submodule']                  = 'Admin/delete_submodule';
$route['approve_new_module']                = 'Admin/approve_new_module';
$route['recall_new_module']                 = 'Admin/recall_new_module';
$route['setup_module_by_type']              = 'Admin/setup_module';
$route['request']                           = 'Admin/request';
$route['typeofsystem_data']                 = 'Admin/typeofsystem_data';
$route['approved']                          = 'Admin/approved';
$route['backtopending']                     = 'Admin/backtopending';
$route['fetch_notifications']               = 'Admin/fetch_notifications';
$route['fetch_messages']                    = 'Admin/fetch_messages';
$route['get_notification_count']            = 'Admin/get_notification_count';
$route['get_module_count']                  = 'Admin/get_module_count';
$route['get_messages_count']                = 'Admin/get_messages_count';
$route['update_admin_enable']               = 'Admin/update_admin_enable';
$route['update_admin_disable']              = 'Admin/update_admin_disable';


$route['get_workload_count']                = 'Admin/get_workload_count';
$route['get_weekly_count']                  = 'Admin/get_weekly_count';

$route['view_module_msfl']                  = 'Admin/view_module_msfl';
$route['module_masterfile']                 = 'Admin/module_masterfile';
$route['add_module_msfl']                   = 'Admin/add_module_msfl';
$route['edit_module_msfl']                  = 'Admin/edit_module_msfl';
$route['update_module_msfl']                = 'Admin/update_module_msfl';
$route['view_dept_implemented_modules']     = 'Admin/view_dept_implemented_modules';

$route['setup_rules_regulation_view']       = 'Admin/setup_rules_regulation_view';
$route['upload_file_rules_regulations']     = 'Admin/upload_file_rules_regulations';
$route['delete_file/(:num)']                = 'Admin/delete_file/$1';

$route['confidential']                               = 'Confidential/confidential';
$route['get_confidential_folders']                   = 'Confidential/get_confidential_folders';
$route['view_folder_modal_confidential']             = 'Confidential/view_folder_modal_confidential';
$route['open_confidential_image/(:any)/(:any)']      = 'Confidential/open_confidential_image/$1/$2';
$route['open_confidential_pdf/(:any)/(:any)']        = 'Confidential/open_confidential_pdf/$1/$2';
$route['open_confidential_csv/(:any)/(:any)']        = 'Confidential/open_confidential_csv/$1/$2';
$route['open_confidential_txt/(:any)/(:any)']        = 'Confidential/open_confidential_txt/$1/$2';
$route['open_confidential_docx/(:any)/(:any)']       = 'Confidential/open_confidential_docx/$1/$2';
$route['open_confidential_xlsx/(:any)/(:any)']       = 'Confidential/open_confidential_xlsx/$1/$2';
$route['open_confidential_audio/(:any)/(:any)']      = 'Confidential/open_confidential_audio/$1/$2';
// Menu
$route['structure']                         = 'Menu/Structure/index';
$route['kpi']                               = 'Menu/KPI/index';
$route['it_responsibilities']               = 'Menu/It_Respo/index';


//Rules and Regulations
$route['rules_view']                        = 'Menu/RulesRegulation/index';

//Logs
$route['logs']                              = 'Logs_ctrl/index';
$route['logs_list']                         = 'Logs_ctrl/logs_list';


//It Responsibilities
$route['setup_workload']                    = 'Menu/It_Respo/setup_workload';
$route['setup_module']                      = 'Menu/It_Respo/setup_module';
$route['workload_list']                     = 'Menu/It_Respo/workload_list';
$route['submit_workload']                   = 'Menu/It_Respo/submit_workload';
$route['submit_updated_workload']           = 'Menu/It_Respo/submit_updated_workload';
$route['edit_workload_content']             = 'Menu/It_Respo/edit_workload_content';
$route['update_workload_status']            = 'Menu/It_Respo/update_workload_status';
$route['delete_workload']                   = 'Menu/It_Respo/delete_workload';

//IT TASK
$route['it_task_view']                      = 'Menu/It_Task/index';
$route['it_task_list']                      = 'Menu/It_Task/it_task_list';
$route['submit_task']                       = 'Menu/It_Task/submit_task';
$route['edit_task_content']                 = 'Menu/It_Task/edit_task_content';
$route['update_task_content']               = 'Menu/It_Task/update_task_content';
$route['update_task_status']                = 'Menu/It_Task/update_task_status';
$route['delete_task']                       = 'Menu/It_Task/delete_task';

//Weekly report
$route['weekly_view']                       = 'Menu/Weekly/index';
$route['weekly_list']                       = 'Menu/Weekly/weekly_list';
$route['submit_weeklyreport']               = 'Menu/Weekly/submit_weeklyreport';
$route['edit_weekly_report_content']        = 'Menu/Weekly/edit_weekly_report_content';
$route['update_weeklyreport']               = 'Menu/Weekly/update_weeklyreport';
$route['update_weekly_status']              = 'Menu/Weekly/update_weekly_status';
$route['delete_weekly']                     = 'Menu/Weekly/delete_weekly';

// Setup Location
$route['setup_location_view']               = 'Menu/Location/index';
$route['setup_location_list']               = 'Menu/Location/setup_location_list';
$route['edit_setup_location_content']       = 'Menu/Location/edit_setup_location_content';
$route['update_location']                   = 'Menu/Location/update_location';
$route['delete_setup_location']             = 'Menu/Location/delete_setup_location';
$route['setup_location']                    = 'Menu/Location/setup_location';
$route['submit_location']                   = 'Menu/Location/submit_location';

$route['module_list_implemented']           = 'Menu/Location/module_list_implemented';


//Gantt
$route['gantt_view']                        = 'Menu/Gantt/index';
$route['gantt_list']                        = 'Menu/Gantt/gantt_list';
$route['submit_gantt']                      = 'Menu/Gantt/submit_gantt';
$route['edit_gantt_content']                = 'Menu/Gantt/edit_gantt_content';
$route['update_gantt']                      = 'Menu/Gantt/update_gantt';
$route['delete_gantt']                      = 'Menu/Gantt/delete_gantt';
$route['gantt/generate_pdf']                = 'Menu/Gantt/export';



//Deployment
$route['deployment_view']                   = 'Menu/Deployment/index';
$route['for_implementation_list']           = 'Menu/Deployment/for_implementation_list';
$route['remaining_files_list']              = 'Menu/Deployment/remaining_files_list';
$route['submit_to_directory']               = 'Menu/Deployment/submit_to_directory';


// Meeting Schedule
$route['meeting_schedule']                  = 'Menu/Meeting/index';
$route['get_meeting']                       = 'Menu/Meeting/get_meeting';
$route['add_meeting']                       = 'Menu/Meeting/add_meeting';
$route['update_meeting']                    = 'Menu/Meeting/update_meeting';
$route['delete_meeting']                    = 'Menu/Meeting/delete_meeting';
$route['get_upcoming_meetings']             = 'Menu/Meeting/get_upcoming_meetings';
// 

// Existing System
$route['existing_sys']                      = 'Menu/Existing_System/index';
$route['new_sys']                           = 'Menu/Newly_System/index';

//Current System
$route['current_system']                    = 'Menu/Current_Sys/index';
$route['get_folders']                       = 'Menu/Current_Sys/get_folders';
$route['view_folder_modal']                 = 'Menu/Current_Sys/view_folder_modal';
$route['setup_module_current']              = 'Menu/Current_Sys/setup_module_current';
$route['upload_file']                       = 'Menu/Current_Sys/upload_file';
$route['delete_file']                       = 'Menu/Current_Sys/delete_file';
$route['get_filter_options']                = 'Menu/Current_Sys/get_filter_options';
$route['business_unit_current']             = 'Menu/Current_Sys/business_unit_current';
$route['department_current']                = 'Menu/Current_Sys/department_current';

$route['get_isr_request']                   = 'Menu/Current_Sys/get_isr_request';

$route['open_image/(:any)/(:any)']          = 'Menu/Current_Sys/open_image/$1/$2';
$route['open_pdf/(:any)/(:any)']            = 'Menu/Current_Sys/open_pdf/$1/$2';
$route['open_csv/(:any)/(:any)']            = 'Menu/Current_Sys/open_csv/$1/$2';
$route['open_txt/(:any)/(:any)']            = 'Menu/Current_Sys/open_txt/$1/$2';
$route['open_docx/(:any)/(:any)']           = 'Menu/Current_Sys/open_docx/$1/$2';
$route['open_xlsx/(:any)/(:any)']           = 'Menu/Current_Sys/open_xlsx/$1/$2';
$route['open_audio/(:any)/(:any)']          = 'Menu/Current_Sys/open_audio/$1/$2';
$route['open_video/(:any)/(:any)']          = 'Menu/Current_Sys/open_video/$1/$2';


//New System
$route['new_system']                        = 'Menu/New_Sys/index';
$route['get_new_folders']                   = 'Menu/New_Sys/get_new_folders';
$route['view_new_folder_modal']             = 'Menu/New_Sys/view_new_folder_modal';
$route['setup_module_new']                  = 'Menu/New_Sys/setup_module_new';
$route['add_new_module']                    = 'Menu/New_Sys/add_new_module';
$route['upload_new_files']                  = 'Menu/New_Sys/upload_new_files';
$route['delete_file_new']                   = 'Menu/New_Sys/delete_file_new';
$route['check_directory_status']            = 'Menu/New_Sys/check_directory_status';
$route['get_files_for_upload']              = 'Menu/New_Sys/get_files_for_upload';
$route['business_unit']                     = 'Menu/New_Sys/business_unit';
$route['department']                        = 'Menu/New_Sys/department';
$route['get_filter_options_new']            = 'Menu/New_Sys/get_filter_options_new';

$route['open_new_image/(:any)/(:any)']      = 'Menu/New_Sys/open_new_image/$1/$2';
$route['open_new_pdf/(:any)/(:any)']        = 'Menu/New_Sys/open_new_pdf/$1/$2';
$route['open_new_csv/(:any)/(:any)']        = 'Menu/New_Sys/open_new_csv/$1/$2';
$route['open_new_txt/(:any)/(:any)']        = 'Menu/New_Sys/open_new_txt/$1/$2';
$route['open_new_docx/(:any)/(:any)']       = 'Menu/New_Sys/open_new_docx/$1/$2';
$route['open_new_xlsx/(:any)/(:any)']       = 'Menu/New_Sys/open_new_xlsx/$1/$2';
$route['open_new_audio/(:any)/(:any)']      = 'Menu/New_Sys/open_new_audio/$1/$2';


// FAQ section
$route['faq_view']                          = 'Menu/FAQ/index';
$route['team_events']                       = 'TeamEvents/index';
$route['get_images_directory']              = 'TeamEvents/get_images_directory';
$route['create_folder']                     = 'TeamEvents/create_folder';

$route['sysdev_upload_file']                = 'TeamEvents/sysdev_upload_file';
$route['get_directories']                   = 'TeamEvents/get_directories';
$route['sysdev_delete_files']               = 'TeamEvents/sysdev_delete_files';


$route['my_workloads']                      = 'MyWorkloads/index';
$route['fetch_workloads']                   = 'MyWorkloads/fetch_workloads';
$route['fetch_tasks']                       = 'MyWorkloads/fetch_tasks';

$route['training_view']                     = 'Menu/Training/training_view';
$route['get_training']                      = 'Menu/Training/get_training';
$route['add_training']                      = 'Menu/Training/add_training';
$route['update_training']                   = 'Menu/Training/update_training';
$route['delete_training']                   = 'Menu/Training/delete_training';
$route['get_upcoming_trainings']            = 'Menu/Training/get_upcoming_trainings';




$route['chat']                              = 'Chat/index';
$route['get_users']                         = 'Chat/get_users';
$route['aboutus']                           = 'About/index';

$route['get_messages']                      = 'Chat/get_messages';
$route['send_message']                      = 'Chat/send_message';
$route['get_new_messages']                  = 'Chat/get_new_messages';



$route['server_address']                    = 'ServerAddress/index';
$route['server_list']                       = 'ServerAddress/server_list';
$route['submit_server']                     = 'ServerAddress/submit_server';
$route['edit_server']                       = 'ServerAddress/edit_server_data';
$route['update_server']                     = 'ServerAddress/update_server';
$route['delete_server']                     = 'ServerAddress/delete_server';



$route['index']                             = 'Search/index';


$route['team_view']                         = 'Team/index';
$route['team_member']                       = 'Team/team_member';


