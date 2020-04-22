<?php
// require(plugin_dir_path(__FILE__) . "php-excel-reader/excel_reader2.php");
// require(plugin_dir_path(__FILE__) . "SpreadsheetReader.php");
require_once("vendor/autoload.php"); 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sheet2JSON{
    public function __construct(){
        $this->init_APIs();
    }

    /**
     * Initialize APIs
     * @return Void
     */
    public function init_APIs(){
        add_action('rest_api_init', array($this, 'register_route'));
    }

    /**
     * Register API route
     * @api /wp-json/spreadsheet/
     * @return Void
     */
    public function register_route(){
        $args = array(
            'methods' => 'GET',
            'callback' => array($this, 'api_get_spreadsheet'),
        );

        register_rest_route(
            'sheet2json',
            '/(?P<value>.+)/',
            $args
        );
    }

    /**
     * API callback:: get spreadsheet JSON object
     * @return JSON spreadsheet object
     */
    public function api_get_spreadsheet($args){
        $sheetname = $args['value'];
        $file = plugin_dir_path(__DIR__) . 'configure.xlsx';

        // return $file;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setLoadSheetsOnly($sheetname);
        $spreadsheet = $reader->load($file);
        $spreadsheet_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        $object = $this->convert($spreadsheet_data);
        return $object;
    }

    /**
     * Convert spreadsheet array to object data
     * @return Object data
     */
    public function convert($data){
        
        // get the first row as header
        $header = $data[1];

        // return all values as array
        $header = array_values($header);
        
        // remove all null values
        $header = array_filter($header);

        // remove the header data from main data
        unset($data[1]);

        $new_data = [];
        
        foreach($data as $obj){
            $item = [];
            $total_cols = sizeof($header);
            $null_counter = 0;

            foreach($header as $key=>$value){
                $item[$value] = array_values($obj)[$key];

                // increment null_counter if it's null
                if(!$item[$value]) $null_counter++;
            }

            // ignore items that has all nulls (a whole row of empty cells)
            if($null_counter < $total_cols){
                array_push($new_data, $item);
            }
        }
        $new_data = array_filter($new_data);

        return $new_data;
    }
    
}

