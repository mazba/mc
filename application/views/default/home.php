<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
{
//    $time=20;
//    $this->output->cache($time);
 //   $CI->output->enable_profiler(TRUE);

    $CI->load_view('dashboards/super_admin');
}
else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
{
    $CI->load_view('dashboards/super_admin');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
{
    $CI->load_view('dashboards/super_admin');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
{
    $CI->load_view('dashboards/super_admin');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
{
    $CI->load_view('dashboards/super_admin');
    //$CI->load_view('dashboards/division');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
{
    $CI->load_view('dashboards/super_admin');
    //$CI->load_view('dashboards/zilla');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
{
    $CI->load_view('dashboards/super_admin');
    //$CI->load_view('dashboards/upazilla');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_INSTITUTE'))
{
    $CI->load_view('dashboards/institute');
}
else{
    echo '<br><br><br><br><br>';
}

echo '<br><br><br><br><br>';
?>
