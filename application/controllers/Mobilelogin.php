<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobilelogin extends CI_Controller {

    function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
        $this->load->model('Mobilelogin_model');
        $data = array();
		
	}
    public function login(){
        $dataArray = array(
            'user_username' => $this->input->post('username'),
            'user_password' => $this->input->post('password'),
            'user_level' => "2"
        );
        $result = $this->Mobilelogin_model->loginData($dataArray);
            if ($result['query'] > 0) {
                echo (json_encode($result['userInfo']));
            }else{
                echo "500";
            }

    }
    public function signup(){
        $dataArray = array(
            'user_fname' => $this->input->post('fname'),
            'user_lname' => $this->input->post('lname'),
            'user_email' => $this->input->post('email'),
            'user_username' => $this->input->post('username'),
            'user_password' => $this->input->post('password'),
            'user_contactnumber' => $this->input->post('contactnumber'),
            'user_level' => "2"

        );
        $result_email = $this->Mobilelogin_model->emailCheck($this->input->post('email'));
        $result_username = $this->Mobilelogin_model->usernameCheck($this->input->post('username'));
        if($result_email > 0){
             echo "E500";
        }
        else if($result_username > 0){
                echo "U500";
        }else{
            $result_id = $this->Mobilelogin_model->insertaData($dataArray);
            if ($result_id > 0) {
                echo "200";
            }else{
                echo "500";
            }
        }
    }
    
    public function getstorerate(){
        $data =array();
        $countallvendortansacctiion = $this->Mobilelogin_model->getvendorcostumer($this->input->post('vendorID'));
        $data=  $this->Mobilelogin_model->getvendorcostumernotcount($this->input->post('vendorID'));
        $totalnumber =0;
        // for($i=;$i >$countallvendortansacctiion;$i++){


        // }
        foreach($data as $key =>$value){
            $totalnumber=  floatval($value->rate);
            $totalnumber +  $totalnumber;
        }
        echo $totalnumber;
    }
    public function getuserInfo(){
        $dataRes = $this->Mobilelogin_model->UserInfo($this->input->post('user_id'));
        echo (json_encode($dataRes));
        // echo $dataRes ;
    }
    public function getallvendor(){
        $dataRes = $this->Mobilelogin_model->Vendorstore();
        echo (json_encode($dataRes));
        // echo $dataRes ;
    }
    public function rateUs(){
        $dataArray = array(
            'rate' => $this->input->post('rate'),
            'costumer_id' => $this->input->post('costumer_id'),

        );
        $dataRes = $this->Mobilelogin_model->Rateus($dataArray );
        if($dataRes){
            echo "success";
        }else{
            echo "500";
        }
        // echo $dataRes ;
    }
    public function skiprate(){
        $dataRes = $this->Mobilelogin_model->skipR($this->input->post('costumer_id'));
        if($dataRes){
            echo "success";
        }else{
            echo "500";
        }
        // echo $dataRes ;
    }
    public function cancelTrasaction(){
        $dataRes = $this->Mobilelogin_model->cancelT($this->input->post('costumer_id'));
        if($dataRes){
            echo "success";
        }else{
            echo "500";
        }
        // echo $dataRes ;
    }
    public function getVendorServices(){
        $dataRes = $this->Mobilelogin_model->VendorServices($this->input->post('vendorID'));
        echo (json_encode($dataRes));
        // echo $dataRes ;
    }
    public function getuserTransaction(){
        $dataRes = $this->Mobilelogin_model->userTransaction($this->input->post('user_id'));
        echo (json_encode($dataRes));
    }
    public function getdonetransaction(){
        $dataRes = $this->Mobilelogin_model->userdoneTransaction($this->input->post('user_id'));
        echo (json_encode($dataRes));
    }
    public function uploadpaymentSS(){

        date_default_timezone_set('Asia/Manila');
        $directory = "./assets/VendorApplicationData/".substr($this->input->post('user_email'),1,-1)."/".date("Y-m-d");
        $insidedirectory = $directory."/".substr($this->input->post('costumer_id'),1,-1);
        $forpayment = $insidedirectory."/paymentSS/";

        $fileext = substr(substr($this->input->post('fileName'),1,-1),-3);
        $finalpaymentname= "payment.$fileext";
        $dataArray = array(
            'costumer_id' => substr($this->input->post('costumer_id'),1,-1),
            'user_id' => substr($this->input->post('user_id'),1,-1),
            'user_email' => substr($this->input->post('email'),1,-1),
            'paymentSS' => $forpayment.$finalpaymentname,

        );
        $result_id = $this->Mobilelogin_model->updatepayment($dataArray);
        if($result_id){
            $base64_string = substr($this->input->post('imagepayment'),1,-1);
            $outputfile = $forpayment.$finalpaymentname ;
            
            $filehandler = fopen($outputfile, 'wb' ); 
            
            fwrite($filehandler, base64_decode($base64_string));
            fclose($filehandler); 
            echo  "OK";
        } else{
            echo "error";
        }
    }



    public function uploadData(){
        $dataFile = json_decode($this->input->post('attachment'));
        $img = ['jpg', 'jpeg', 'png', 'bmp'];
        $doc = ['zip', 'rar', 'pdf', 'doc', 'docx', 'xls','xlsx','ppt','pptx'];
        $whitelistExt = array_merge($img, $doc);
        $arraylength = count($dataFile);
        date_default_timezone_set('Asia/Manila');
        $directory = "./assets/VendorApplicationData/".substr($this->input->post('user_email'),1,-1)."/".date("Y-m-d");
        
        $dataArray = array(
            'user_id' => substr($this->input->post('user_id'),1,-1),
            'VendorID' => substr($this->input->post('vendorID'),1,-1),
            'service_id' => substr($this->input->post('service_id'),1,-1),
            'payment_method' => substr($this->input->post('payment_method'),1,-1),
            'pickupDateandTime' => substr($this->input->post('pickupDateandTime'),1,-1),

            'colortype' => substr($this->input->post('colortype'),1,-1),
            'numbercopy' => substr($this->input->post('numbercopy'),1,-1),
            'transactionNote' => substr($this->input->post('transactionNote'),1,-1),
            'File_name' => substr($directory,2)

        );
        $result_id = $this->Mobilelogin_model->insertaDatatransaction($dataArray);
        
        $insidedirectory = $directory."/".$result_id;
        $forFile = $insidedirectory."/files/";
        $forpayment = $insidedirectory."/paymentSS";
        
        if(!file_exists($directory)){
            if(mkdir($directory, 0777, true)){
                if(mkdir($insidedirectory, 0777, true)){
                    if(mkdir($forFile, 0777, true)){
                        if(mkdir($forpayment, 0777, true)){
                            $rounddata = 1;
                        foreach ($dataFile as $key => $value)
                        {
                            $fn = $value->fileName;
                            $ext = pathinfo($fn, PATHINFO_EXTENSION);
                            $f = base64_decode($value->encoded);
                            file_put_contents($forFile.$fn, $f);
                            if($arraylength==$rounddata){
                                echo "OK";
                            }
                            $rounddata ++;
    
                        }
                        }
                    }
                }
            }
        }else{
            if(mkdir($insidedirectory, 0777, true)){
                if(mkdir($forFile, 0777, true)){
                    if(mkdir($forpayment, 0777, true)){
                        $rounddata = 1;
                    foreach ($dataFile as $key => $value)
                    {
                        $fn = $value->fileName;
                        $ext = pathinfo($fn, PATHINFO_EXTENSION);
                        $f = base64_decode($value->encoded);
                        file_put_contents($forFile.$fn, $f);
                        if($arraylength==$rounddata){
                            echo "OK";
                        }
                        $rounddata ++;

                    }
                    }
                }
            }
        }
        
    }
    


}