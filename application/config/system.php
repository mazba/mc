<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//public pages
$config['PUBLIC_CONTROLLERS']=array('home', 'entrepreneur_registration','user_registration', 'common', 'eservice_list', 'help_desk_contact','media_corner','public_notice');
/////// Pagination Config
$config['page_size']=100;
///// report language folder
$config['GET_LANGUAGE']="bangla";

//upload directories
$config['dcms_upload']['entrepreneur']='images/entrepreneur';
$config['dcms_upload']['excel']='uploads/excel';
$config['dcms_upload']['notice']='images/notice';

// USER GROUP ADED BY JIBON BIKASH ROY <jibon.bikash@gmail.com>

$config['SUPER_ADMIN_GROUP_ID'] = 1; 

$config['A_TO_I_GROUP_ID'] = 2;  // A2i Group

$config['USER_GROUP_MINISTRY_1'] = 3;  // Ministry 1 Group
$config['USER_GROUP_MINISTRY_2'] = 4;  // Ministry 2 Group
$config['USER_GROUP_MINISTRY_3'] = 5;  // Ministry 3 Group
$config['USER_GROUP_MINISTRY_4'] = 6;  // Ministry 4 Group

$config['USER_GROUP_DONNER_1'] = 7;  // Donner 1 Group
$config['USER_GROUP_DONNER_2'] = 8;  // Donner 2 Group
$config['USER_GROUP_DONNER_3'] = 9;  // Donner 3 Group


$config['USER_GROUP_DIVISION_1'] = 10;  // Division 1 Group
$config['USER_GROUP_DIVISION_2'] = 11;  // Division 2 Group
$config['USER_GROUP_DIVISION_3'] = 12;  // Division 3 Group

$config['USER_GROUP_DISTRICT_1'] = 13;  // District 1 Group
$config['USER_GROUP_DISTRICT_2'] = 14;  // District 2 Group
$config['USER_GROUP_DISTRICT_3'] = 15;  // District 3 Group
$config['USER_GROUP_DISTRICT_4'] = 16;  // District 4 Group

$config['USER_GROUP_UPOZILA_1'] = 17;  // Upazila 1 Group
$config['USER_GROUP_UPOZILA_2'] = 18;  // Upazila 2 Group
$config['USER_GROUP_UPOZILA_3'] = 19;  // Upazila 3 Group

$config['USER_GROUP_INSTITUTE'] = 20;  // Institute Group

// END USER GROUP

$config['STATUS_INACTIVE']=1; // SERVICE PROPOSED
$config['STATUS_ACTIVE']=2; // SERVICE, USER APPROVED
$config['STATUS_REJECT']=3;   // USER DENY
$config['STATUS_SUSPEND']=4;
$config['STATUS_TEMPORARY_SUSPEND']=5;
$config['STATUS_DELETE']=99;

$config['GENDER_MALE']=1;
$config['GENDER_FEMALE']=0;

$config['DATE_DISPLAY_FORMAT'] = 'Y-m-d';

$config['system_sidebar01'] = 'position_left_01';
$config['system_sidebar02'] = 'position_top_01';

$config['system_TYPE'] = 'TYPE';

// Division
$config['division'][10] = 'বরিশাল';
$config['division'][20] = 'চট্টগ্রাম';
$config['division'][30] = 'ঢাকা';
$config['division'][40] = 'খুলনা';
$config['division'][50] = 'রাজশাহী';
$config['division'][55] = 'রংপুর';
$config['division'][60] = 'সিলেট';

// Month
$config['month']['01'] = 'জানুয়ারি';
$config['month']['02'] = 'ফেব্রুয়ারি';
$config['month']['03'] = 'মার্চ';
$config['month']['04'] = 'এপ্রিল';
$config['month']['05'] = 'মে';
$config['month']['06'] = 'জুন';
$config['month']['07'] = 'জুলাই';
$config['month']['08'] = 'আগস্ট';
$config['month']['09'] = 'সেপ্টেম্বর';
$config['month']['10'] = 'অক্টোবর';
$config['month']['11'] = 'নভেম্বর';
$config['month']['12'] = 'ডিসেম্বর';

//report menu id
$config['report_component_id']=3;

// INSTITUTE TYPE
$config['INSTITUTE_GENERAL']=1;
$config['INSTITUTE_MADRASHA']=2;
$config['media_type'][1]='Notice';



