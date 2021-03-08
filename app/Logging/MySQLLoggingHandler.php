<?php
namespace App\Logging;
// use Illuminate\Log\Logger;
use DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
class MySQLLoggingHandler extends AbstractProcessingHandler{

    public function __construct($level = Logger::DEBUG, $bubble = true) {
        $this->table = 'logs';
        parent::__construct($level, $bubble);
    }
    protected function write(array $record):void
    {
       //dd($record); 
       
       $data = array(
           'message'       => $record['message'],
           'level'         => $record['level_name'],
           'time' => $record['datetime']->format('Y-m-d H:i:s'),

           
       );
       
       DB::connection()->table($this->table)->insert($data);     
    }
}