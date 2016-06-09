<?php
class Dashboard_helper
{
    // Center Count
//    public static function get_all_applied_institute($status=null, $level=null,$type=null)
//    {
//
//        $CI = & get_instance();
//        $user=User_helper::get_user();
//        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
//        {
//            $CI->db->where('institute.divid='.$user->division);
//        }
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
//        {
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//        }
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
//        {
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//            $CI->db->where('institute.upozillaid='.$user->upazila);
//        }
//        else
//        {
//            //$CI->db->where('','');
//        }
//
//        if($level=="PRIMARY")
//        {
//            $CI->db->where('institute.is_primary', 1);
//        }
//        elseif($level=="SECONDARY")
//        {
//            $CI->db->where('institute.is_secondary', 1);
//        }
//        elseif($level=="INTERMEDIATE")
//        {
//            $CI->db->where('institute.is_higher', 1);
//        }
//        else
//        {
//
//        }
//
//        if($type=="GENERAL")
//        {
//            $CI->db->where('institute.education_type_ids', 1);
//        }
//        elseif($type=="MADRASHA")
//        {
//            $CI->db->where('institute.education_type_ids', 2);
//        }
//        else
//        {
//
//        }
//
//        if($status==$CI->config->item('STATUS_ACTIVE'))
//        {
//            $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
//        }
//        elseif($status==$CI->config->item('STATUS_INACTIVE'))
//        {
//            $CI->db->where('institute.status', $CI->config->item('STATUS_INACTIVE'));
//        }
//        else
//        {
//
//        }
//
//        $CI->db->from($CI->config->item('table_institute').' institute');
//        $total=$CI->db->count_all_results();
//        //echo $CI->db->last_query();
//        return $total;
//    }
//
//    public static function get_number_of_user()
//    {
//
//        $CI = & get_instance();
//        //$user=User_helper::get_user();
//        $CI->db->from($CI->config->item('table_users').' core_01_users');
//        $CI->db->where('core_01_users.user_group_id', $CI->config->item('USER_GROUP_INSTITUTE'));
//        $total=$CI->db->count_all_results();
//        return $total;
//    }
//
//    public static function get_number_of_mmc_user($type=null)
//    {
//        $CI = & get_instance();
//        //$user=User_helper::get_user();
//        //$CI->db->select('id numrows');
//        $CI->db->from($CI->config->item('table_class_details').' institute_class_details');
//        if($type=="YESTERDAY")
//        {
//            $yesterday = date('Y-m-d',strtotime("-1 day"));
//            $CI->db->where('institute_class_details.class_date', $yesterday);
//        }
//        $CI->db->group_by('institute_class_details.institude_id');
//        $query = $CI->db->get();
//        return $query->num_rows();
//    }
//
//    public static function get_approved_institute_list()
//    {
//        $CI = & get_instance();
//        $user=User_helper::get_user();
//        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
//        {
//            $CI->db->select('divisions.divname element_name');
//            $CI->db->select('institute_class_details.institude_id, COUNT(institute_class_details.institude_id) element_value');
//            $CI->db->group_by('institute.divid');
//
//        }
//        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
//        {
//            $CI->db->select('divisions.divname element_name, COUNT(divisions.divname) element_value');
//            $CI->db->group_by('institute.divid');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
//        {
//            $CI->db->select('divisions.divname element_name, COUNT(divisions.divname) element_value');
//            $CI->db->group_by('institute.divid');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
//        {
//            $CI->db->select('divisions.divname element_name, COUNT(divisions.divname) element_value');
//            $CI->db->group_by('institute.divid');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
//        {
//            $CI->db->select('zillas.zillaname element_name, COUNT(zillas.zillaname) element_value');
//            $CI->db->group_by('institute.divid, institute.zillaid');
//            $CI->db->where('institute.divid='.$user->division);
//        }
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
//        {
//            $CI->db->select('upa_zilas.upazilaname element_name, COUNT(upa_zilas.upazilaname) element_value');
//            $CI->db->group_by('institute.divid, institute.zillaid, institute.upozillaid');
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//        }
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
//        {
//            $CI->db->select('upa_zilas.upazilaname element_name, COUNT(upa_zilas.upazilaname) element_value');
//            $CI->db->group_by('institute.divid, institute.zillaid, institute.upozillaid');
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//            $CI->db->where('institute.upozillaid ='.$user->upazila);
//        }
//        else
//        {
//            //$CI->db->where('','');
//        }
//        $month_ini = new DateTime("first day of last month");
//        $month_end = new DateTime("last day of last month");
//
//
//
//        $CI->db->from($CI->config->item('table_institute').' institute');
//        $CI->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = institute.divid', 'INNER');
//        $CI->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = institute.divid AND zillas.zillaid = institute.zillaid', 'INNER');
//        $CI->db->join($CI->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = institute.zillaid AND upa_zilas.upazilaid = institute.upozillaid', 'INNER');
//        $CI->db->join($CI->config->item('table_class_details').' institute_class_details','institute_class_details.institude_id = institute.id', 'INNER');
//        $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
//
//        $CI->db->where('institute_class_details.class_date >=', $month_ini->format('Y-m-d'));
//        $CI->db->where('institute_class_details.class_date <=', $month_end->format('Y-m-d'));
//
//
//        //$CI->db->where('institute.applied_date between '.$month_end->format('Y-m-d').' AND '.$month_ini->format('Y-m-d').'');
//
//        $result = $CI->db->get()->result_array();
//        //echo $CI->db->last_query();
//        return $result;
//    }
//
//    public static function get_institute_type_list()
//    {
//        $CI = & get_instance();
//        $user=User_helper::get_user();
//        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL').") general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA').") madrasha
//            ", false);
//        }
//        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL').") general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA').") madrasha
//            ", false);
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL').") general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA').") madrasha
//            ", false);
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL').") general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA').") madrasha
//            ", false);
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL')." AND ig.divid=institute.divid) general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA')." AND ig.divid=institute.divid) madrasha
//            ", false);
//            $CI->db->where('institute.divid='.$user->division);
//        }
//
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL')." AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid) general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA')." AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid) madrasha
//            ", false);
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//        }
//
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
//        {
//            $CI->db->select
//            ("
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_GENERAL')." AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid AND ig.upozillaid=institute.upozillaid) general,
//            (SELECT COUNT(ig.id) FROM ".$CI->config->item('table_institute')." ig WHERE ig.`status`=".$CI->config->item('STATUS_ACTIVE')." AND ig.education_type_ids=".$CI->config->item('INSTITUTE_MADRASHA')." AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid AND ig.upozillaid=institute.upozillaid) madrasha
//            ", false);
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//            $CI->db->where('institute.upozillaid ='.$user->upazila);
//        }
//
//        else
//        {
//            //$CI->db->where('','');
//        }
//
//        $month_ini = new DateTime("first day of last month");
//        $month_end = new DateTime("last day of last month");
//
//        $CI->db->from($CI->config->item('table_institute').' institute');
//        $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
//      //  $CI->db->where('institute.applied_date >=', $month_ini->format('Y-m-d'));
//      //  $CI->db->where('institute.applied_date <=', $month_end->format('Y-m-d'));
//        $CI->db->group_by('institute.status');
//
//        $result = $CI->db->get()->result_array();
//
//        //echo $CI->db->last_query();
//
//        return $result;
//    }
//
//    public static function bn2enNumber ($number){
//        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
//        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
//        $en_number = str_replace($replace_array, $search_array, $number);
//
//        return $en_number;
//    }
//
//
//
//    public static function get_all_mmc_institute($status=null, $level=null,$type=null)
//    {
//
//        $CI = & get_instance();
//        $user=User_helper::get_user();
//        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
//        {
//            //$CI->db->where('','');
//        }
//        else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
//        {
//            $CI->db->where('institute.divid='.$user->division);
//        }
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
//        {
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//        }
//        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
//        {
//            $CI->db->where('institute.divid='.$user->division);
//            $CI->db->where('institute.zillaid='.$user->zilla);
//            $CI->db->where('institute.upozillaid='.$user->upazila);
//        }
//        else
//        {
//            //$CI->db->where('','');
//        }
//
//        if($level=="PRIMARY")
//        {
//            $CI->db->where('institute.is_primary', 1);
//        }
//        elseif($level=="SECONDARY")
//        {
//            $CI->db->where('institute.is_secondary', 1);
//        }
//        elseif($level=="INTERMEDIATE")
//        {
//            $CI->db->where('institute.is_higher', 1);
//        }
//        else
//        {
//
//        }
//
//        if($type=="GENERAL")
//        {
//            $CI->db->where('institute.education_type_ids', 1);
//        }
//        elseif($type=="MADRASHA")
//        {
//            $CI->db->where('institute.education_type_ids', 2);
//        }
//        else
//        {
//
//        }
//
//        if($status==$CI->config->item('STATUS_ACTIVE'))
//        {
//            $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
//        }
//        elseif($status==$CI->config->item('STATUS_INACTIVE'))
//        {
//            $CI->db->where('institute.status', $CI->config->item('STATUS_INACTIVE'));
//        }
//        else
//        {
//
//        }
//
//
//        $CI->db->select('mmcsummary.*, institute.*');
//        $CI->db->from($CI->config->item('table_class_summary').' mmcsummary');
//        $CI->db->join($CI->config->item('table_institute').' institute', 'mmcsummary.institude_id=institute.id', 'left');
//     //   $CI->db->where('communication.sender_id',$user->id);
//        $CI->db->group_by('mmcsummary.institude_id');
//        $total=$CI->db->count_all_results();
//        //echo $CI->db->last_query();
//        return $total;
//    }
}