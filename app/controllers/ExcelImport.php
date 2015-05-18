<?php
class ExcelImport extends \Maatwebsite\Excel\Files\ExcelFile {
    /**
     * Get file
     * @return string
     */
    public $test;
    public function getFile()
    {
        $file = Input::file('excel');
        $name = $file->getClientOriginalName();
//        $extension = $file->getClientOriginalExtension();
        $file = $file->move('Shin',$name);
        $path = 'Shin\\' . $name;
        $this->test = $path;
        return  $path;
    }

}
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/12/2015
 * Time: 2:07 AM
 */ 