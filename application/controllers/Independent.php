<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Independent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model("Independent_model");
    }
    public function get_student_excel_file()
    {
        //load the excel library
        $this->load->library('Excel');
        //read file from
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); //0.33
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40); //12
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20); //15.29
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50); //11.71
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30); //5.14


        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("PHPExcel Test Document")
            ->setSubject("PHPExcel Test Document")
            ->setDescription("Test document for PHPExcel, generated using PHP classes.")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");


        $td = Date('Y-m-d');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Institute Name: ')
            ->setCellValue('B1', 'test')
            ->setCellValue('C1', 'id ');
        $CI =& get_instance();
        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.status', 2);
        $CI->db->limit(100);

        $CI->db->order_by("institute.id", "desc");

        $results = $CI->db->get()->result_array();

        $i=2;
        foreach ($results as $result) {

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $result['name'])
                ->setCellValue('B'.$i, $result['email'])
                ->setCellValue('C'.$i, $result['code']);
            $i++;

        }




        $fileName = 'student_excel_upload.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$fileName");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        die();
    }
}
