<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of makeArrayJsChart
 *
 * @author krystian
 */
class makeArrayJsChart {
    //put your code here
    
    private $tempData=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    private $tempDataString='[';
    
    public function __construct($temp) {
        
        $this->tempData[4];
        
        //tworzymy tablice z temperatura..
        foreach ($temp as $value) {
            foreach ($value as $key => $value) {
                //$key;
                if($value==NULL || $value==''|| $value==' '){
                    $value=1;
                }
                if($key=='05'){
                   $this->tempData[0]=$value; 
                }
                if($key=='06'){
                   $this->tempData[1]=$value; 
                }
                if($key=='07'){
                    $this->tempData[2]=$value; 
                }
                if($key=='08'){
                    $this->tempData[3]=$value; 
                }
                if($key=='09'){
                    $this->tempData[4]=$value; 
                }
                if($key=='10'){
                    $this->tempData[5]=$value; 
                }
                if($key=='11'){
                    $this->tempData[6]=$value; 
                }
                if($key=='13'){
                    $this->tempData[7]=$value;
                } 
                if($key==14){
                    $this->tempData[8]=$value; 
                } 
                if($key==15){
                    $this->tempData[9]=$value; 
                } 
                if($key==16){
                    $this->tempData[10]=$value; 
                }
                if($key==17){
                    $this->tempData[11]=$value; 
                }
                if($key=='18'){
                    $this->tempData[12]=$value;
                }
                if($key=='19'){
                    $this->tempData[13]=$value; 
                }
                if($key=='20'){
                    $this->tempData[14]=$value; 
                }
                if($key=='21'){
                    $this->tempData[15]=$value; 
                }
                if($key=='22'){
                    $this->tempData[16]=$value; 
                }
                if($key=='23'){
                    $this->tempData[17]=$value; 
                }
                if($key=='00'){
                    $this->tempData[18]=$value;
                }
            }
        }
        
        foreach ($this->tempData as $value) {
            $this->tempDataString.= $value.', ';
        }
        $this->tempDataString .= ']';
        //return $this->temp;
    }
    
    function get(){
        return $this->tempDataString;
    }
}
