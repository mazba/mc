<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 2/24/2016
 * Time: 4:26 PM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$user = User_helper::get_user();
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <form id="graphclass" action="<?php echo $CI->get_encoded_url('institute/institute/index/update'); ?>" method="post">
            <div class="row show-grid ">
                <div class="col-xs-3">

                </div>
                <div class="col-sm-5 col-xs-8">
                    <input type="text" required="" placeholder="<?php echo $CI->lang->line('SEARCH_INPUT_NAME'); ?>" name="q" class="form-control report_date" value="<?php if($this->input->post('q')) { echo $this->input->post('q'); }?>" />
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="submit" class="btn btn-primary" value="<?php echo $CI->lang->line('SEARCH'); ?>">
                </div>
            </div>


        </form>
        <?php
        if($this->input->post('q')) {
            ?>
            <table class="table table-striped" style="width: 90%">
                <tr>
                    <th>#</th>
                    <th><?php echo $CI->lang->line('SCHOOL_NAME'); ?></th>
                    <th style="text-align: center"><?php echo $CI->lang->line('SCHOOL_EMAIL'); ?></th>
                    <th style="text-align: center"><?php echo $CI->lang->line('EIIN_NUMBER'); ?></th>
                    <th style="text-align: center"><?php echo $CI->lang->line('SCHOOL_MOBILE'); ?></th>
                    <th style="text-align: center">&nbsp;</th>
                </tr>
                <?php
                if ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1')) {
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user->division);
                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2')) {
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user->division);

                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) {
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user->division);

                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1')) {
                    $user_district = $user->zilla;
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user_division);
                    $CI->db->where('institute.zillaid', $user->zilla);

                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2')) {
                    $user_district = $user->zilla;
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user_division);
                    $CI->db->where('institute.zillaid', $user->zilla);

                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3')) {
                    $user_district = $user->zilla;
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user_division);
                    $CI->db->where('institute.zillaid', $user->zilla);

                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_4')) {
                    $user_district = $user->zilla;
                    $user_division = $user->division;
                    $CI->db->where('institute.divid', $user_division);
                    $CI->db->where('institute.zillaid', $user->zilla);

                } elseif ($user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_1')) {
                    $user_division = $user->division;
                    $user_district = $user->zilla;
                    $user_upazilla = $user->upazila;


                    $CI->db->where('institute.divid', $user_division);
                    $CI->db->where('institute.zillaid', $user_district);
                    $CI->db->where('institute.upozillaid', $user_upazilla);

                } else {

                }
                $CI->db->like('name', trim($this->input->post('q')));
                $CI->db->or_like('email', trim($this->input->post('q')));
                $CI->db->or_like('mobile', trim($this->input->post('q')));
                $CI->db->or_like('code', trim($this->input->post('q')));
                $CI->db->select('institute.*');
                $CI->db->from($CI->config->item('table_institute') . ' institute');
                $CI->db->where('institute.status=', 2);
                $CI->db->order_by("institute.id", "desc");
                $results = $CI->db->get()->result_array();
             //   echo $CI->db->last_query();
                $ii = 1;
                foreach ($results as &$result) {
                    //     echo $result['id'].'<br />';

                        if ($result['status']==2) {
                            ?>

                            <tr>
                                <td><?php echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $result['code']; ?></td>
                                <td><?php echo $result['mobile']; ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo $CI->get_encoded_url('institute/institute/index/updateinfo/' . $result['id']); ?>"><?php echo $CI->lang->line('EDIT'); ?></a>
                                </td>
                            </tr>
                            <?php
                        }
                    $ii++;
                }
                ?>
            </table>
            <?php
        }
        ?>
    </div>


</div>
