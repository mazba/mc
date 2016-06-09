<?php

class Dashboard_helper
{
    public function __construct()
    {
        $CI = &get_instance();
        $CI->db->cache_on();
    }

    // Center Count
    public static function get_all_applied_institute($status = null, $level = null, $type = null)
    {

        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('institute.divid=' . $user->division);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->where('institute.divid=' . $user->division);
            $CI->db->where('institute.zillaid=' . $user->zilla);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('institute.divid=' . $user->division);
            $CI->db->where('institute.zillaid=' . $user->zilla);
            $CI->db->where('institute.upozillaid=' . $user->upazila);
        } else {
            //$CI->db->where('','');
        }

        if ($level == "PRIMARY") {
            $CI->db->where('institute.is_primary', 1);
        } elseif ($level == "SECONDARY") {
            $CI->db->where('institute.is_secondary', 1);
        } elseif ($level == "INTERMEDIATE") {
            $CI->db->where('institute.is_higher', 1);
        } else {

        }

        if ($type == "GENERAL") {
            $CI->db->where('institute.education_type_ids', 1);
        } elseif ($type == "MADRASHA") {
            $CI->db->where('institute.education_type_ids', 2);
        } else {

        }

        if ($status == $CI->config->item('STATUS_ACTIVE')) {
            $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
        } elseif ($status == $CI->config->item('STATUS_INACTIVE')) {
            $CI->db->where('institute.status', $CI->config->item('STATUS_INACTIVE'));
        } else {

        }

        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $total = $CI->db->count_all_results();
        //echo $CI->db->last_query();
        return $total;
    }

    public static function get_number_of_user()
    {

        $CI = &get_instance();
        //$user=User_helper::get_user();
        $CI->db->from($CI->config->item('table_users') . ' core_01_users');
        $CI->db->where('core_01_users.user_group_id', $CI->config->item('USER_GROUP_INSTITUTE'));
        $total = $CI->db->count_all_results();
        return $total;
    }

    public static function get_number_of_mmc_user($type = null)
    {
        $CI = &get_instance();
        //$user=User_helper::get_user();
        //$CI->db->select('id numrows');
        $CI->db->from($CI->config->item('table_class_details') . ' institute_class_details');
        if ($type == "YESTERDAY") {
            $yesterday = date('Y-m-d', strtotime("-1 day"));
            $CI->db->where('institute_class_details.class_date', $yesterday);
        }
        $CI->db->group_by('institute_class_details.institude_id');
        $query = $CI->db->get();
        return $query->num_rows();
    }

    public static function get_approved_institute_list()
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->select('institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $CI->db->select('institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $CI->db->select('institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $CI->db->select('institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->select('institute_class_summary.zillaid element_name,COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
            $CI->db->where('institute_class_summary.divid=' . $user->division);

        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->select('institute_class_summary.upazillaid element_name,COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->select('institute_class_summary.upazillaid element_name,COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid=' . $user->upazila);
        } else {
            //$CI->db->where('','');
        }

        $year_month = date('Y-m', time());
        $from_date = $year_month . "-01";
        $to_date = $year_month . "-31";
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result_array;
    }

    /*
	public static function get_approved_institute_listzilla($from_date, $to_date)
    {
        $CI = & get_instance();

        $user=User_helper::get_user();


            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
            $CI->db->order_by("element_value", "DESC");
            $CI->db->limit(10);

        $CI->db->from($CI->config->item('table_class_summary').' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();
        $result_array=array();
        foreach($result as $row)
        {
            if(!empty($row['element_name']))
            {
                $result_array[$row['element_name']]['element_name']=$row['element_name'];
                if(isset($result_array[$row['element_name']]['element_value']))
                {
                    $result_array[$row['element_name']]['element_value']++;
                }
                else
                {
                    $result_array[$row['element_name']]['element_value']=1;
                }
            }

        }
        return $result_array;
    }
*/

    public static function get_approved_institute_listzilla($from_date, $to_date)
    {
        $CI = &get_instance();

        $user = User_helper::get_user();

        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->select('institute_class_summary.upazillaid element_name, institute_class_summary.divid, institute_class_summary.zillaid, COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->select('institute_class_summary.institude_id element_name, institute_class_summary.upazillaid, COUNT(institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid=' . $user->upazila);
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
        } else {
            //$CI->db->where('','');
        }

        //   $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
        // $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        $CI->db->order_by("element_value", "DESC");
        $CI->db->limit(10);

        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result_array;
    }

    public static function get_div_zilla_upazilla($element_id)
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $element = Query_helper::get_info($CI->config->item('table_divisions'), array('divname name'), array('divid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $element = Query_helper::get_info($CI->config->item('table_divisions'), array('divname name'), array('divid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $element = Query_helper::get_info($CI->config->item('table_divisions'), array('divname name'), array('divid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $element = Query_helper::get_info($CI->config->item('table_divisions'), array('divname name'), array('divid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $element = Query_helper::get_info($CI->config->item('table_zillas'), array('zillaname name'), array('divid = ' . $user->division, 'zillaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $element = Query_helper::get_info($CI->config->item('table_upazilas'), array('upazilaname name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $element = Query_helper::get_info($CI->config->item('table_upazilas'), array('upazilaname name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else {
            $name = '';
        }
        return $name ? $name : '';
    }


    public static function get_div_zilla_zillagraphn($element_id)
    {
        $CI = &get_instance();

        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $element = Query_helper::get_info($CI->config->item('table_zillas'), array('zillaname name'), array('zillaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $element = Query_helper::get_info($CI->config->item('table_zillas'), array('zillaname name'), array('zillaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $element = Query_helper::get_info($CI->config->item('table_zillas'), array('zillaname name'), array('zillaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $element = Query_helper::get_info($CI->config->item('table_zillas'), array('zillaname name'), array('zillaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $element = Query_helper::get_info($CI->config->item('table_zillas'), array('zillaname name'), array('zillaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {


            $element = Query_helper::get_info($CI->config->item('table_upazilas'), array('upazilaname name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $element = Query_helper::get_info($CI->config->item('table_institute'), array('name name'), array('id = ' . $element_id));
            if (isset($element[0]['name'])) {
                $name = $element[0]['name'];
            } else {
                $name = '';
            };
        } else {
            $name = '';
        }

        /*       $element = Query_helper::get_info($CI->config->item('table_zillas'),array('zillaname name'), array('zillaid = '.$element_id));
            if(isset($element[0]['name'])){$name=  $element[0]['name'];}else{$name=  '';};
*/
        return $name ? $name : '';
    }

    public static function get_registered_school($level, $element_id)
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }

        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $user->division, 'zillaid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $user->division, 'zillaid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('divid = ' . $user->division, 'zillaid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            if ($level == 5) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id, 'is_primary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 6) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id, 'is_secondary = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            } else if ($level == 7) {
                $element = Query_helper::get_info($CI->config->item('table_institute'), array('count(id) name'), array('zillaid = ' . $user->zilla, 'upazilaid = ' . $element_id, 'is_higher = 1'));
                if (isset($element[0]['name'])) {
                    $name = $element[0]['name'];
                } else {
                    $name = '';
                };
            }
        } else {
            $name = '';
        }

        return $name;
    }


    public static function get_institute_type_list()
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . ") general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . ") madrasha
            ", false);
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . ") general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . ") madrasha
            ", false);
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . ") general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . ") madrasha
            ", false);
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . ") general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . ") madrasha
            ", false);
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . " AND ig.divid=institute.divid) general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . " AND ig.divid=institute.divid) madrasha
            ", false);
            $CI->db->where('institute.divid=' . $user->division);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . " AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid) general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . " AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid) madrasha
            ", false);
            $CI->db->where('institute.divid=' . $user->division);
            $CI->db->where('institute.zillaid=' . $user->zilla);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->select
            ("
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_GENERAL') . " AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid AND ig.upozillaid=institute.upozillaid) general,
            (SELECT COUNT(ig.id) FROM " . $CI->config->item('table_institute') . " ig WHERE ig.`status`=" . $CI->config->item('STATUS_ACTIVE') . " AND ig.education_type_ids=" . $CI->config->item('INSTITUTE_MADRASHA') . " AND ig.divid=institute.divid AND ig.zillaid=institute.zillaid AND ig.upozillaid=institute.upozillaid) madrasha
            ", false);
            $CI->db->where('institute.divid=' . $user->division);
            $CI->db->where('institute.zillaid=' . $user->zilla);
            $CI->db->where('institute.upozillaid =' . $user->upazila);
        } else {
            //$CI->db->where('','');
        }

        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
        $CI->db->group_by('institute.status');
        $result = $CI->db->get()->result_array();
        //echo $CI->db->last_query();
        return $result;
    }

    public static function bn2enNumber($number)
    {
        $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $en_number = str_replace($replace_array, $search_array, $number);

        return $en_number;
    }

    public static function bn2enNumbermonth($number)
    {
        $currentDate = date("d M Y");

        $search_array = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
        );
        $replace_array = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $convertedDATE = str_replace($replace_array, $search_array, $number);

        return $convertedDATE;
    }

    public static function get_all_mmc_institute($status = null, $level = null, $type = null)
    {

        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('institute.divid=' . $user->division);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->where('institute.divid=' . $user->division);
            $CI->db->where('institute.zillaid=' . $user->zilla);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('institute.divid=' . $user->division);
            $CI->db->where('institute.zillaid=' . $user->zilla);
            $CI->db->where('institute.upozillaid=' . $user->upazila);
        } else {
            //$CI->db->where('','');
        }

        if ($level == "PRIMARY") {
            $CI->db->where('institute.is_primary', 1);
        } elseif ($level == "SECONDARY") {
            $CI->db->where('institute.is_secondary', 1);
        } elseif ($level == "INTERMEDIATE") {
            $CI->db->where('institute.is_higher', 1);
        } else {

        }

        if ($type == "GENERAL") {
            $CI->db->where('institute.education_type_ids', 1);
        } elseif ($type == "MADRASHA") {
            $CI->db->where('institute.education_type_ids', 2);
        } else {

        }

        if ($status == $CI->config->item('STATUS_ACTIVE')) {
            $CI->db->where('institute.status', $CI->config->item('STATUS_ACTIVE'));
        } elseif ($status == $CI->config->item('STATUS_INACTIVE')) {
            $CI->db->where('institute.status', $CI->config->item('STATUS_INACTIVE'));
        } else {

        }

        //   $CI->db->from($CI->config->item('table_institute').' institute');
        //    $total=$CI->db->count_all_results();

        $CI->db->select('mmcsummary.*, institute.*');
        $CI->db->from($CI->config->item('table_class_summary') . ' mmcsummary');
        $CI->db->join($CI->config->item('table_institute') . ' institute', 'mmcsummary.institude_id=institute.id', 'left');
        //   $CI->db->where('communication.sender_id',$user->id);
        $CI->db->group_by('mmcsummary.institude_id');
        $total = $CI->db->count_all_results();
        //echo $CI->db->last_query();
        return $total;
    }

    public static function get_mmc_use_general_level_wise($type, $level, $from_date, $to_date)
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->select('COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $CI->db->select('COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $CI->db->select('COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $CI->db->select('COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->select(' COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->where('institute_class_summary.divid=' . $user->division);

        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->select(' COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->select(' COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid=' . $user->upazila);
        } else {
            //$CI->db->where('','');
        }

        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");

        if ($level == "PRIMARY") {
            $CI->db->where('institute_class_summary.education_level_id', 5);
        } elseif ($level == "SECONDARY") {
            $CI->db->where('institute_class_summary.education_level_id', 6);
        } elseif ($level == "INTERMEDIATE") {
            $CI->db->where('institute_class_summary.education_level_id', 7);
        } else {

        }
        if ($type == "GENERAL") {
            $CI->db->where('institute_class_summary.education_type_id', 1);
        } elseif ($type == "MADRASHA") {
            $CI->db->where('institute_class_summary.education_type_id', 2);
        } else {

        }
        $result = $CI->db->get()->num_rows();
        //echo $CI->db->last_query();
        return $result;
    }

    public static function get_institute_information($id)
    {

        $CI =& get_instance();

        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.user_id', $id);
        $result = $CI->db->get()->row_array();
        return $result;

    }


    public static function get_last_MMC_submission($id)
    {

        $CI =& get_instance();

        $CI->db->select('class_summary.institude_id, class_summary.date');
        $CI->db->from($CI->config->item('table_class_summary') . ' class_summary');
        $CI->db->where('class_summary.institude_id', $id);
        $CI->db->order_by("id", "desc");
        $CI->db->limit(1);
        $result = $CI->db->get()->row_array();
        return $result;

    }


    public static function get_last_MMC_COUNT($id)
    {

        $CI =& get_instance();
        $CI->db->select('class_summary.institude_id, class_summary.id, class_summary.no_of_subjects');
        $CI->db->from($CI->config->item('table_class_summary') . ' class_summary');
        $CI->db->where('class_summary.institude_id', $id);
        $query = $CI->db->get();
        return $rowcount = $query->num_rows();


    }

//  Added by jibon for home page graph

    public static function get_approved_institute_list_home()
    {
        $CI = &get_instance();

        $CI->db->select('institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
        $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid');
        $year_month = date('Y-m', time());
        $from_date = $year_month . "-01";
        $to_date = $year_month . "-31";
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '2015-12-01' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result_array;
    }

    public static function get_div_zilla_upazilla_home($element_id)
    {
        $CI = &get_instance();

        $element = Query_helper::get_info($CI->config->item('table_divisions'), array('divname name'), array('divid = ' . $element_id));
        if (isset($element[0]['name'])) {
            $name = $element[0]['name'];
        } else {
            $name = '';
        };
        return $name ? $name : '';
    }

    // end


    public static function get_approved_institute_listzillalow($from_date, $to_date)
    {
        $CI = &get_instance();

        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //$CI->db->where('','');
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->select('institute_class_summary.upazillaid element_name, institute_class_summary.divid, institute_class_summary.zillaid, COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->select('institute_class_summary.institude_id element_name, institute_class_summary.upazillaid, COUNT(institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            //      $CI->db->where('institute_class_summary.upazillaid='.$user->upazila);
            $CI->db->group_by('institute_class_summary.institude_id');
        } else {
            //$CI->db->where('','');
        }

        /*     $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
   */
        $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        $CI->db->order_by("element_value", "ASC");
        $CI->db->limit(10);


//        $month_ini = new DateTime("first day of last month");
//        $month_end = new DateTime("last day of last month");
//        $from_date=$month_ini->format('Y-m-d');
//        $to_date=$month_end->format('Y-m-d');
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result_array;
    }


    public static function get_approved_institute_listzillaheigh()
    {
        $CI = &get_instance();

        $user = User_helper::get_user();


        $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
        $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        $CI->db->order_by("element_value", "DESC");
        $CI->db->limit(10);


        $month_ini = new DateTime("first day of last month");
        $month_end = new DateTime("last day of last month");
        $from_date = $month_ini->format('Y-m-d');
        $to_date = $month_end->format('Y-m-d');
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result_array;
    }


    public static function get_approved_institute_listsubject()
    {
        $CI = &get_instance();

        $user = User_helper::get_user();

        /*
SELECT
DISTINCT(classes.`name`),
count(classes.id)
FROM
institute_class_summary
INNER JOIN institute ON institute.id = institute_class_summary.institude_id AND institute.divid = institute_class_summary.divid AND institute.zillaid = institute_class_summary.zillaid AND institute.upozillaid = institute_class_summary.upazillaid
INNER JOIN classes ON institute_class_summary.class_ids = classes.id
WHERE
institute.`status` = 2

*/
        $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.zillaid) element_value');
        $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
        $CI->db->order_by("element_value", "DESC");
        $CI->db->limit(10);


        $month_ini = new DateTime("first day of last month");
        $month_end = new DateTime("last day of last month");
        $from_date = $month_ini->format('Y-m-d');
        $to_date = $month_end->format('Y-m-d');
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result_array;
    }

    public static function get_classname_count($element_id, $monthstrt = '', $monthend = '')
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //$CI->db->where('','');
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('institute_class_summary.divid=' . $user->division);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('institute_class_summary.divid=' . $user->division);
            $CI->db->where('institute_class_summary.zillaid=' . $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid=' . $user->upazila);
        } else {
            //$CI->db->where('','');
        }

        if ($monthstrt == '' && $monthend == '') {
            $month_ini = new DateTime("first day of last month");
            $month_end = new DateTime("last day of last month");
            $month_ini = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');

        } else {
            $month_ini = $monthstrt;
            $to_date = $monthend;
        }
        /*		$month_ini = new DateTime("first day of last month");
        $month_end = new DateTime("last day of last month");
        $month_ini=$month_ini->format('Y-m-d');
        $to_date=$month_end->format('Y-m-d');
	*/
        $CI->db->where('institute_class_summary.class_ids', $element_id);
        $CI->db->where("institute_class_summary.date between '$month_ini' AND '$to_date'");
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        return $cnt = $CI->db->count_all_results();
    }

    public static function get_class_count($element_id)
    {

        $CI = &get_instance();

        $CI->db->where('classes.id', $element_id);
        $CI->db->where('institute.status', 2);
        $CI->db->from('institute');
        return $CI->db->count_all_results();


        // return $count;
    }

    public static function get_district_count_next($element_id)
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\'  AND status=2');
        }
        if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\'  AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\'  AND status=2 ');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\'  AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {

            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $user->zilla . '\' AND upozillaid=\'' . $element_id . '\' AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND upozillaid=\'' . $user->upazila . '\'AND status=2');
        } else {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND upozillaid=\'' . $user->upazila . '\' AND status=2');
        }
        //     echo $CI->db->last_query();
        return $query->num_rows();
    }

    public static function get_district_count($element_id)
    {

        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->where('zillaid', $element_id);
        } elseif ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $CI->db->where('zillaid', $element_id);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $CI->db->where('zillaid', $element_id);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $CI->db->where('zillaid', $element_id);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('zillaid', $element_id);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->where('zillaid', $user->zilla);
            $CI->db->where('upozillaid', $element_id);

           // $CI->db->where('upozillaid', $element_id);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('id', $element_id);
        } else {
            $name = '';
        }

        $CI->db->where('status', 2);
        $CI->db->from('institute');
       // echo $CI->db->last_query();
        return $CI->db->count_all_results();


    }


    public static function get_district_count_school_college($element_id)
    {

        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');
        }
        if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND (is_secondary=1 OR is_higher=1) AND status=2 ');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {


            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');

        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {

            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $user->zilla . '\' AND upozillaid=\'' . $element_id . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND upozillaid=\'' . $user->upazila . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');
        } else {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND upozillaid=\'' . $user->upazila . '\' AND (is_secondary=1 OR is_higher=1) AND status=2');
        }

     //   echo $CI->db->last_query();
       // exit;
        return $query->num_rows();

    }


    public static function get_district_count_school($element_id)
    {

        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND is_primary=1 AND status=2');
        }
        if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND is_primary=1 AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND is_primary=1 AND status=2 ');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE zillaid=\'' . $element_id . '\' AND is_primary=1 AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND is_primary=1 AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {

            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $user->zilla . '\' AND upozillaid=\'' . $element_id . '\' AND is_primary=1 AND status=2');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND upozillaid=\'' . $user->upazila . '\' AND is_primary=1 AND status=2');
        } else {
            $query = $CI->db->query('SELECT * FROM `institute` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $element_id . '\' AND upozillaid=\'' . $user->upazila . '\' AND is_primary=1 AND status=2');
        }
        //  echo $CI->db->last_query();
        return $query->num_rows();

    }

    /*
	public static function get_district_count($element_id){

        $CI = & get_instance();

        $CI->db->where('zillaid',$element_id);
        $CI->db->where('status',2);
        $CI->db->from('institute');
        return $CI->db->count_all_results();


       // return $count;
    }
	*/

    public static function get_district_mmc_counttwo($zillaid, $from_date, $to_date,$zilla_id=0)
    {
        $CI = &get_instance();
        $user = User_helper::get_user();

//            $CI->db->select('institute_class_summary.upazillaid, institute_class_summary.zillaid');
//            $CI->db->where('institute_class_summary.zillaid',$user->zilla);
//            $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
//            $CI->db->from($CI->config->item('table_class_summary').' institute_class_summary');
//        //    $results = $CI->db->get()->result_array();
//            echo $CI->db->last_query();
        //    return $CI->db->count_all_results();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID'))
        {
            $query = $CI->db->query('SELECT * FROM `institute_class_summary` WHERE zillaid=\'' . $zillaid . '\' AND `date` BETWEEN \'' . $from_date . '\' AND \'' . $to_date . '\'  GROUP BY institude_id');
        }
        elseif ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $query = $CI->db->query('SELECT * FROM `institute_class_summary` WHERE zillaid=\'' . $zillaid . '\' AND `date` BETWEEN \'' . $from_date . '\' AND \'' . $to_date . '\' GROUP BY institude_id');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $query = $CI->db->query('SELECT * FROM `institute_class_summary` WHERE zillaid=\'' . $zillaid . '\' AND `date` BETWEEN \'' . $from_date . '\' AND \'' . $to_date . '\'  GROUP BY institude_id');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {

            $query = $CI->db->query('SELECT * FROM `institute_class_summary` WHERE zillaid=\'' . $zillaid . '\' AND `date` BETWEEN \'' . $from_date . '\' AND \'' . $to_date . '\'  GROUP BY institude_id');

        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $query = $CI->db->query('SELECT * FROM `institute_class_summary` WHERE divid=\'' . $user->division . '\' AND zillaid=\'' . $zillaid . '\' AND `date` BETWEEN \'' . $from_date . '\' AND \'' . $to_date . '\'  GROUP BY institude_id');


        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {

            $query = $CI->db->query('SELECT * FROM `institute_class_summary` WHERE zillaid=\'' . $user->zilla . '\' AND  upazillaid=\'' . $zillaid . '\' AND `date` BETWEEN \'' . $from_date . '\' AND \'' . $to_date . '\'  GROUP BY institude_id');


        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {

        } else {

        }
        //  echo $CI->db->last_query();
        return $query->num_rows();
//

    }


    public static function get_approved_institute_report($edu_level, $from_date, $to_date, $order_type)
    {
        $CI =& get_instance();

        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //    $CI->db->where('nstitute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
        } elseif ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //      $CI->db->where('nstitute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid IS NOT NULL');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //      $CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //    $CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            //$CI->db->where('zillaid',$element_id);
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->select('institute_class_summary.upazillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            // $CI->db->where('id',$element_id);
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid', $user->upazila);
            $CI->db->select('institute_class_summary.upazillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
        } else {
            $name = '';
        }

        if ($edu_level == "PRIMARY") {
            $CI->db->where('institute_class_summary.education_level_id', 5);
        } elseif ($edu_level == "SECONDARY") {
            $CI->db->where('institute_class_summary.education_level_id', 6);
        } elseif ($edu_level == "INTERMEDIATE") {
            $CI->db->where('institute_class_summary.education_level_id', 7);
        } else {

        }


        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute_class_summary.institude_id=institute.id', 'left');
        $CI->db->join($CI->config->item('table_zillas') . ' zillas', 'institute_class_summary.zillaid=zillas.zillaid', 'INNER');
        //$CI->db->join($CI->config->item('table_upazilas').' upazilas', 'institute_class_summary.upazillaid=upazilas.upazilaid AND institute_class_summary.zillaid=upazilas.zillaid', 'left');
        $CI->db->group_by('institute_class_summary.institude_id');
        $CI->db->order_by("element_value", "" . $order_type . "");
        $CI->db->limit(10);
        $result = $CI->db->get()->result_array();
        echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result;
    }

    public static function get_approved_institute_reportnext($edu_level, $from_date, $to_date, $order_type)
    {
        $CI =& get_instance();

        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value, zillas.zillaname');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {

            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value, zillas.zillaname');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->select('institute_class_summary.upazillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.upazillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid', $user->upazila);
            $CI->db->select('institute_class_summary.upazillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.upazillaid !=""');
            $CI->db->group_by('institute_class_summary.institude_id');

        } else {
            $name = '';
        }

        if ($edu_level == "PRIMARY") {
            $CI->db->where('institute_class_summary.education_level_id', 5);
        } elseif ($edu_level == "SECONDARY") {
            $CI->db->where('institute_class_summary.education_level_id', 6);
        } elseif ($edu_level == "INTERMEDIATE") {
            $CI->db->where('institute_class_summary.education_level_id', 7);
        } else {

        }


        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute_class_summary.institude_id=institute.id', 'left');
        $CI->db->join($CI->config->item('table_zillas') . ' zillas', 'institute_class_summary.zillaid=zillas.zillaid', 'INNER');
        $CI->db->join($CI->config->item('table_upazilas') . ' upazilas', 'institute_class_summary.upazillaid=upazilas.upazilaid', 'left');

        $CI->db->order_by("element_value", "" . $order_type . "");
        $CI->db->limit(10);
        $result = $CI->db->get()->result_array();
        //    echo $CI->db->last_query();
        $result_array = array();
        foreach ($result as $row) {
            if (!empty($row['element_name'])) {
                $result_array[$row['element_name']]['element_name'] = $row['element_name'];
                if (isset($result_array[$row['element_name']]['element_value'])) {
                    $result_array[$row['element_name']]['element_value']++;
                } else {
                    $result_array[$row['element_name']]['element_value'] = 1;
                }
            }

        }
        return $result;
    }

    public static function get_approved_institute_report_school_college($edu_level, $from_date, $to_date, $order_type)
    {
        $CI =& get_instance();

        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            //    $CI->db->where('nstitute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');

        } elseif ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            //      $CI->db->where('nstitute_class_summary.zillaid',$zillaid);
            //    $CI->db->distinct();
            $CI->db->select('COUNT(DISTINCT institute_class_summary.institude_id) element_value, institute_class_summary.zillaid element_name');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            //      $CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            //    $CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {

            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->select('institute_class_summary.zillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.zillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            //$CI->db->where('zillaid',$element_id);


            $CI->db->select('institute_class_summary.upazillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->group_by('institute_class_summary.upazillaid');
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->where('institute_class_summary.upazillaid', $user->upazila);
            $CI->db->select('institute_class_summary.upazillaid element_name, COUNT(DISTINCT institute_class_summary.institude_id) element_value');
            $CI->db->where('institute_class_summary.institude_id !=""');
            $CI->db->where('institute_class_summary.zillaid !=""');
            $CI->db->where('institute_class_summary.upazillaid !=""');
            $CI->db->group_by('institute_class_summary.institude_id');
        } else {
            $name = '';
        }

        if ($edu_level == "PRIMARY") {
            $CI->db->where('institute_class_summary.education_level_id', 5);
        } elseif ($edu_level == "SECONDARY") {
            $CI->db->where('institute_class_summary.education_level_id', 6);
        } elseif ($edu_level == "INTERMEDIATE") {
            $level_edu = array('6', '7');
            $CI->db->where_in('institute_class_summary.education_level_id', $level_edu);

        } else {

        }


        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute_class_summary.institude_id=institute.id', 'left');
        $CI->db->join($CI->config->item('table_zillas') . ' zillas', 'institute_class_summary.zillaid=zillas.zillaid', 'left');
        $CI->db->join($CI->config->item('table_upazilas') . ' upazilas', 'institute_class_summary.upazillaid=upazilas.upazilaid', 'left');

        $CI->db->order_by("element_value", "" . $order_type . "");
        $CI->db->limit(10);
        $result = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();

        return $result;
    }

// mmc count for date range
    public static function get_district_mmc_count_list($zillaid, $from_date, $to_date)
    {

        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->where('zillaid', $zillaid);
        } else if ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $CI->db->where('zillaid', $zillaid);
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4')) {
            $CI->db->where('zillaid', $zillaid);
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_3')) {
            $CI->db->where('zillaid', $zillaid);
        } else if ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $CI->db->where('zillaid', $zillaid);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            //$CI->db->where('zillaid',$element_id);
            $CI->db->where('upazillaid', $zillaid);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $CI->db->where('id', $element_id);
        } else {
            $name = '';
        }

        $CI->db->select('institute_class_summary.zillaid, institute_class_summary.upazillaid, institute_class_summary.date, institute_class_summary.institude_id');
        // $CI->db->where('institute_class_summary.zillaid',$zillaid);
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        // $CI->db->from($CI->config->item('table_class_summary'));
        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->group_by('institute_class_summary.institude_id');
        return $CI->db->count_all_results();

    }

    public static function mmc_institute_institute_name($zillaid, $from_date, $to_date)
    {
        $CI = &get_instance();
        $user = User_helper::get_user();
        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID')) {
            $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid,institute_class_summary.divid, SUM(institute_class_summary.no_of_subjects) Totalclass, institute_class_summary.upazillaid,   institute.name institutename, zillas.zillaname zillanames, upazilas.upazilaname upazilaname ');
            //	$CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->limit(20);

        } elseif ($user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID')) {
            $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid, institute_class_summary.divid, SUM(institute_class_summary.no_of_subjects) Totalclass, institute_class_summary.upazillaid, institute.name institutename, zillas.zillaname zillanames, upazilas.upazilaname upazilaname ');
            $CI->db->where('institute_class_summary.zillaid', $zillaid);
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->limit(20);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')) {
            $divisions = $user->division;
            $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid,institute_class_summary.divid, SUM(institute_class_summary.no_of_subjects) Totalclass, institute_class_summary.upazillaid,   institute.name institutename, zillas.zillaname zillanames, upazilas.upazilaname upazilaname ');
            //	$CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->where('institute_class_summary.divid', $divisions);
            //	$CI->db->group_by('institute_class_summary.divid');
            $CI->db->limit(5);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {
            $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid,institute_class_summary.divid, SUM(institute_class_summary.no_of_subjects) Totalclass, institute_class_summary.upazillaid,   institute.name institutename, zillas.zillaname zillanames, upazilas.upazilaname upazilaname ');
            //	$CI->db->where('institute_class_summary.zillaid',$zillaid);
            $CI->db->group_by('institute_class_summary.institude_id');
            $divisions = $user->division;
            $zillaidd = $user->zilla;
            $CI->db->where('institute_class_summary.zillaid', $zillaidd);
            $CI->db->where('institute_class_summary.divid', $divisions);
            //	$CI->db->group_by('institute_class_summary.zillaid');
            $CI->db->limit(5);
        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')) {
            $divisions = $user->division;
            $zillaidd = $user->zilla;
            $upazilaa = $user->upazila;
            $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid,institute_class_summary.divid, SUM(institute_class_summary.no_of_subjects) Totalclass, institute_class_summary.upazillaid,   institute.name institutename, zillas.zillaname zillanames, upazilas.upazilaname upazilaname ');
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->where('institute_class_summary.zillaid', $zillaidd);
            $CI->db->where('institute_class_summary.divid', $divisions);
            $CI->db->where('institute_class_summary.upazillaid', $upazilaa);
            $CI->db->limit(5);

        } else {

        }
        $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid,institute_class_summary.divid, institute_class_summary.upazillaid, institute_class_summary.no_of_subjects,  institute.name institutename, zillas.zillaname zillanames, upazilas.upazilaname upazilaname ');

        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");


        $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
        $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute_class_summary.institude_id=institute.id', 'left');
        $CI->db->join($CI->config->item('table_zillas') . ' zillas', 'institute_class_summary.zillaid=zillas.zillaid AND institute_class_summary.divid=zillas.divid', 'inner');
        $CI->db->join($CI->config->item('table_upazilas') . ' upazilas', 'institute_class_summary.upazillaid=upazilas.upazilaid AND institute_class_summary.zillaid=upazilas.zillaid', 'inner');
        //
        $CI->db->order_by("Totalclass DESC");

        $results = $CI->db->get()->result_array();
        //   echo $CI->db->last_query();

        return $results;
    }

    public static function get_institute_data($id)
    {

        $CI =& get_instance();

        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.id', $id);
        $result = $CI->db->get()->row_array();
        return $result;

    }
}