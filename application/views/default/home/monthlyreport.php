<?php
/**
 * Created by PhpStorm.
 * User: HP-14
 * Date: 11/15/2015
 * Time: 8:07 PM
 */
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();

?>
<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">
 <h1>  মাসিক প্রতিবেদন</h1>


    <div id="register_print_adm" class="content_form">
        <div class="form_top_title">

            <h3 class="top_title_2nd"></h3>
        </div>



        <table id="table_mmc_primary" style="border-collapse:collapse;" border="0" cellpadding="2px" cellspacing="2px" width="100%">
            <caption style="text-align: left">শিক্ষার স্তরঃ প্রথমিক</caption>
            <tbody><tr><th style="width: 100px">বিভাগ</th>
                <th style="width: 100px">মোট স্কুল </th>
                <th style="width: 100px">এমএমসি ব্যবহার করেছেন </th>
            </tr>
            <tr>
                <td> বরিশাল</td>
                <td> <?php
                    $array = array('divid' => 10, 'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?>

                </td>
                <td>
                    <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 10 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?>
                </td>
            </tr>
            <tr>
                <td> চট্টগ্রাম</td>
                <td> <?php
                    $array = array('divid' => 20, 'is_primary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 20 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> ঢাকা</td>
                <td> <?php
                    $array = array('divid' => 30, 'is_primary' => 1, 'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 30 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> খুলনা</td>
                <td> <?php
                    $array = array('divid' => 40, 'is_primary' => 1, 'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 40 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> রাজশাহী</td>
                <td> <?php
                    $array = array('divid' => 50, 'is_primary' => 1, 'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 50 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> রংপুর</td>
                <td> <?php
                    $array = array('divid' => 60, 'is_primary' => 1, 'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 60 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> সিলেট</td>
                <td><?php
                    $array = array('divid' => 70, 'is_primary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_primary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 70 AND
institute.status = 2 AND
institute.is_primary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            </tbody>
        </table>

        <table id="table_mmc_secondary" style="border-collapse:collapse;" border="0" cellpadding="2px" cellspacing="2px" width="100%">
            <caption style="text-align: left"> শিক্ষার স্তরঃ মাধ্যমিক</caption>
            <tbody><tr><th style="width: 100px">বিভাগ</th>
                <th style="width: 100px">মোট স্কুল </th>
                <th style="width: 100px">এমএমসি ব্যবহার করেছেন </th>
            </tr>
            <tr>
                <td> বরিশাল</td>
                <td> <?php
                    $array = array('divid' => 10, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 10 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> চট্টগ্রাম</td>
                <td> <?php
                    $array = array('divid' => 20, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 20 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> ঢাকা</td>
                <td> <?php
                    $array = array('divid' => 30, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 30 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> খুলনা</td>
                <td> <?php
                    $array = array('divid' => 40, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 40 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> রাজশাহী</td>
                <td> <?php
                    $array = array('divid' => 50, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 50 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> রংপুর</td>
                <td> <?php
                    $array = array('divid' => 60, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 60 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> সিলেট</td>
                <td> <?php
                    $array = array('divid' => 70, 'is_secondary' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_secondary,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 70 AND
institute.status = 2 AND
institute.is_secondary = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            </tbody>
        </table>

        <table id="table_mmc_higher" style="border-collapse:collapse;" border="0" cellpadding="2px" cellspacing="2px" width="100%">
            <caption style="text-align: left"> শিক্ষার স্তরঃ উচ্চমধ্যমিক</caption>
            <tbody><tr><th style="width: 100px">বিভাগ</th>
                <th style="width: 100px">মোট স্কুল </th>
                <th style="width: 100px">এমএমসি ব্যবহার করেছেন </th>
            </tr>
            <tr>
                <td> বরিশাল</td>
                <td> <?php
                    $array = array('divid' => 10, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 10 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> চট্টগ্রাম</td>
                <td> <?php
                    $array = array('divid' => 20, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 20 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> ঢাকা</td>
                <td> <?php
                    $array = array('divid' => 30, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 30 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> খুলনা</td>
                <td> <?php
                    $array = array('divid' => 40, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 40 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> রাজশাহী</td>
                <td> <?php
                    $array = array('divid' => 50, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 50 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> রংপুর</td>
                <td> <?php
                    $array = array('divid' => 60, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 60 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            <tr>
                <td> সিলেট</td>
                <td> <?php
                    $array = array('divid' => 70, 'is_higher' => 1,  'status' => 2);
                    $this->db->where($array);
                    $this->db->from($CI->config->item('table_institute'));
                    $query = $this->db->get();
                    echo $rowcount = $query->num_rows();

                    ?></td>
                <td> <?php
                    $query = $this->db->query('SELECT institute.id,
institute.divid,
institute.is_higher,
institute.status,
institute.education_type_ids
FROM
institute
INNER JOIN institute_class_details ON institute_class_details.institude_id = institute.id
WHERE
institute.divid = 70 AND
institute.status = 2 AND
institute.is_higher = 1
GROUP BY institute_class_details.institude_id');
                    echo $query->num_rows();
                    ?></td>
            </tr>
            </tbody>
        </table>
<br />
        <style>
            table#table_mmc_primary, table#table_mmc_higher,  table#table_mmc_secondary {
                margin-bottom: 20px; margin-top: 20px;
                border: 1px solid #a2a2a2;
            }
            .content_form
            {
                /*min-height: 842px;  // 596 */
                width: 792px;
                margin-left: auto;
                margin-right: auto;

                font-family: NIKOSHBAN;
            }
            .form_top_title
            {
                font-size: 24px;
            }
            {
                margin-top: -18px;
            }

            @media print {
                .content_form {
                    border: 0px dotted;
                }
            }

            p.p_indent
            {
                text-indent: 30px;
            }

            h3
            {
                text-align: center;
            }

            h3.top_title_2nd
            {
                margin-top: -18px;
            }

            .clear_div
            {
                clear: both;
                width: 100%;
                height: 20px;
            }
            br
            {
                line-height:5px;
            }
        </style>

    </div>



</div>
