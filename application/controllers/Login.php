<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
        $this->load->model('Login_model');
        $data = array();
		
	}

	public function index()
	{
		if (isset($_SESSION['User_session'])){
            if ($this->session->userdata('User_session')['user_level']==1) {
                $this->Shop();
            }elseif ($this->session->userdata('User_session')['user_level']==0) {
                $this->CostumerIncoming();
            }

        }else{
            $this->session->unset_userdata('User_session');
            $this->load->view('login_view');
        }
	}
    public function Header(){
        $data['numberofpendinglisting'] = $this->Login_model->countallpendingListing($this->session->userdata('User_session')['user_id']);
		$data['numberofpending'] = $this->Login_model->countallpending();
        $this->load->view('includes/header',$data);
    }
    public function Footer(){
        $this->load->view('includes/footer');
    }
    // start Vendor pages
    public function CostumerIncoming(){
        $data['alllistingCostumer'] = $this->Login_model->getalllistingCostumerbyVendor_id($this->session->userdata('User_session')['user_id']);
        $this->Header();
        $this->load->view('vendor/vendor_CostumerIncoming_view',$data);
        $this->Footer();
    }
    public function CostumerPending(){
        $data['allpendingCostumer'] = $this->Login_model->getallpendingCostumerbyVendor_id($this->session->userdata('User_session')['user_id']);
        $this->Header();
        $this->load->view('vendor/vendor_CostumerPending_view',$data);
        $this->Footer();
    }
    public function CostumerReadytoPick(){
        $data['allreadyCostumer'] = $this->Login_model->getallreadytopickCostumerbyVendor_id($this->session->userdata('User_session')['user_id']);
        $this->Header();
        $this->load->view('vendor/vendor_CostumerReadytoPick_view',$data);
        $this->Footer();
    }
    public function CostumerService(){
        $this->Header();
        $this->load->view('vendor/vendor_CostumerService_view');
        $this->Footer();
    }
    public function ServiceList(){
        $data['allservice'] = $this->Login_model->getallvendorservicesbyid($this->session->userdata('User_session')['user_id']);
        $this->Header();
        $this->load->view('vendor/vendor_ServiceList_view',$data);
        $this->Footer();
    }
    public function VendorHistory(){
        $data['allVendorHistory'] = $this->Login_model->getallHistorybyVendor_id($this->session->userdata('User_session')['user_id']);
        $this->Header();
        $this->load->view('vendor/vendor_VendorHistory_view',$data);
        $this->Footer();
    }
    // end Vendor pages
    // start admin pages
    public function Shop(){
        $data['allvendor'] = $this->Login_model->getallpendingvendor();
        $this->Header();
        $this->load->view('admin/admin_PrintingShop_view',$data);
        $this->Footer();
        
    }
    public function User(){
        $data['allvendor'] = $this->Login_model->getallpendingvendor();
        $this->Header();
        $this->load->view('admin/admin_RespondentUser_view',$data);
        $this->Footer();
    }
    public function VendorComplain(){
        $data['allvendor'] = $this->Login_model->getallpendingvendor();
        $this->Header();
        $this->load->view('admin/admin_VendorComplain_view',$data);
        $this->Footer();
    }
    public function UserComplain(){
        $data['allvendor'] = $this->Login_model->getallpendingvendor();
        $this->Header();
        $this->load->view('admin/admin_UserComplain_view',$data);
        $this->Footer();
    }
    public function ApplicationPending(){
		$data['allvendor'] = $this->Login_model->getallpendingvendor();
        $this->Header();
        $this->load->view('admin/admin_PendingApplication_view',$data);
        $this->Footer();
    }
    public function ApplicationApproved(){
        $data['allvendorApproved'] = $this->Login_model->getallpendingvendorApproved();
        $this->Header();
        $this->load->view('admin/admin_ApprovedApplication_view',$data);
        $this->Footer();
    }
    public function ApplicationDisapproved(){
        $data['allvendorDisapproved'] = $this->Login_model->getallpendingvendorDisapproved();
        $this->Header();
        $this->load->view('admin/admin_DisapprovedApplication_view',$data);
        $this->Footer();
    }
    public function AccountVendor(){
        $data['allvendor'] = $this->Login_model->getallvendoruser();
        $this->Header();
        $this->load->view('admin/admin_AccountVendor_view',$data);
        $this->Footer();
    }
    public function AccountUser(){
        $data['allvendor'] = $this->Login_model->getallUser();
        $this->Header();
        $this->load->view('admin/admin_AccountUser_view',$data);
        $this->Footer();
    }
    // End admin pages
    // Start Login Function
    public function logindata(){
        
        $username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = $this->Login_model->login($username, $password);
		// var_dump($data);
        
        $this->session->unset_userdata('User_session');
        if($data > 0){
			$this->session->set_userdata('User_session', $data);//Set data Session
			if($data['status'] == '1') {
				if($data['user_level'] == '1') {
                    echo "1";
                }else{
                    echo "0";
                }
        	}else{
                echo "404";
			}
		}else{
			echo "error";
        }
    }
    // End Login Function
    // Start Logout Function
    public function logout(){
        $this->session->unset_userdata('User_session');
            $this->load->view('login_view');
    }
    // End Logout Function
    // Start Signup Function
    public function signup(){
        $this->load->view('signup_view');
    }
    // End Signup Function
    // start check Email if exist
    public function checkemail(){
       $result = $this->Login_model->emailCheck($this->input->post('email'));
       if($result > 0){
            echo "500";
       }
       else{
           echo "200";
       }
    }
    // end check Email if exist
    // upload file and insert data
    public function UploadInsert(){
        $sotrenameImg = array();
        $formNameArray = array('Business_Permit','Valid_ID','Store_Img');
        $formNameInput = array('bpermit','validID','storeImg');
        if(mkdir('./assets/VendorApplicationData/' . $this->input->post('email'), 0777, TRUE)){
            for($x = 0; $x <= 2; $x++){

                $config['upload_path']= "./assets/VendorApplicationData/". $this->input->post('email');
                $config['allowed_types']='jpeg|jpg|png';
                $config['file_name'] = $formNameArray[$x];

                
                
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload($formNameInput[$x])){
                    $data = $this->upload->data();
        
                    //Resize and Compress Image
                    // $config['image_library']='gd2';
                    // $config['source_image']='./assets/VendorApplicationData/'.$this->input->post('email').'/'.$data['file_name'];
                    // $config['create_thumb']= FALSE;
                    // // $config['quality']= '60%';
                    // // $config['width'] = '700';
                    // $config['maintain_ratio'] = TRUE;
                    // $config['file_ext_tolower'] = TRUE;
                    // $config['new_image']= './assets/VendorApplicationData/'.$this->input->post('email').'/'.$data['file_name'];
                    // $this->load->library('image_lib', $config);
                    // $this->image_lib->resize();
                    
                }else{
                echo $this->upload->display_errors();
                }
                array_push($sotrenameImg, $data['file_name']);
                if($x == 2){
                    $dataArray = array(
                        'user_fname' => $this->input->post('fname'),
                        'user_mname' => $this->input->post('mname'),
                        'user_lname' => $this->input->post('lname'),
                        'user_zipcode' => $this->input->post('zipcode'),
                        'user_storeaddress' => $this->input->post('storeAddress'),
                        'store_name' => $this->input->post('store_name'),
                        'user_email' => $this->input->post('email'),
                        'user_username' => $this->input->post('username'),
                        'user_password' => $this->input->post('password'),
                        'user_contactnumber' => $this->input->post('contactNumber'),
                        'permitName' => $sotrenameImg[0],
                        'validIdName' => $sotrenameImg[1],
                        'storenameImg' =>$sotrenameImg[2],
                    );
                    $result_id = $this->Login_model->insertaData($dataArray);
                    if ($result_id > 0) {
                        echo "200";
                    }else{
                        echo "500";
                    }
                }
            }
            
        }
        
    }
    //Get vendor Notes by ID
    public function getVendorNotes(){
        $dataRes = $this->Login_model->VendorNote($this->input->post('id'));
        echo (json_encode($dataRes));
    }
  
    //Get vendor store location
    public function GetallVendorelocation(){
        $dataRes = $this->Login_model->getallLocation();
        echo (json_encode($dataRes));
    }
    //Get vendor store location by ID
    public function GetVendorelocationByvedndorID(){
        $dataRes = $this->Login_model->getLocationbyid($this->input->post('vendorID'));
        echo (json_encode($dataRes));
    }
    //Get vendor detail by ID
    public function getVendorDetail(){
        $dataRes = $this->Login_model->VendorDetail($this->input->post('id'));
        echo (json_encode($dataRes));
    }
    //approved Updated status to 1 and Insert Location
    public function locationData(){
        $storeName = $this->Login_model->getStorename($this->input->post('id'));
        $dataArray = array(
            'locationLong' => $this->input->post('LongH'),
            'locationLat' => $this->input->post('LatH'),
            'vendorID' => $this->input->post('id'),
            'store_name' => $storeName
           
        );
        $result_id = $this->Login_model->insertlocation($dataArray);
                    if ($result_id > 0) {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }
    // Disapproved update satus to 10 with Notes
    public function disapprovedWithNote(){
        $dataArray = array(
            'note_message' => $this->input->post('messageN'),
            'vendorID' => $this->input->post('id'),
           
        );
        $result_id = $this->Login_model->insertnote($dataArray);
                    if ($result_id > 0) {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }
    // add service
    public function addVendorService(){
        $dataArray = array(
            'vendorID'     => $this->session->userdata('User_session')['user_id'],
            'service_name' => $this->input->post('service_name'),
            'service_des' => $this->input->post('service_des'),
           
        );
        $result_id = $this->Login_model->insertsevice($dataArray);
                    if ($result_id > 0) {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }
    // remove service
    public function RemovevendorService(){
        $result_id = $this->Login_model->removesevice($this->input->post('service_id'),);
                    if ($result_id == "deleted") {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }
    //Get service Detail by service ID
    public function GetServiceInfo(){
        $dataRes = $this->Login_model->serviceInfoByServiceID($this->input->post('service_id'));
        echo (json_encode($dataRes));
    }
    // updated service
    public function insertupdateService(){
        $dataArray = array(
            'service_id'     => $this->input->post('service_id'),
            'service_name' => $this->input->post('service_name'),
            'service_des' => $this->input->post('service_des'),
           
        );
        $result_id = $this->Login_model->insertUpdatedsevice($dataArray);
                    if ($result_id) {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }
    //Update Costumer Status
    public function UpdateCostumerStatus(){
        $dataArray = array(
            'costumer_id'     => $this->input->post('costumer_id'),
            'status' => $this->input->post('status')
           
        );
        $result_id = $this->Login_model->UpdateCostumer($dataArray);
                    if ($result_id) {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }

    //Update Price
    public function Updateprice(){
        $dataArray = array(
            'costumer_id'     => $this->input->post('costumer_id'),
            'total_price' => $this->input->post('total_price')
           
        );
        $result_id = $this->Login_model->UpdateCostumer($dataArray);
                    if ($result_id) {
                        echo "200";
                    }else{
                        echo "500";
                    }
    }
    //Download File
    public function downloadcostumerFile(){
        $this->load->helper('download');
        $VendorID = $this->input->post('VendorID');
        $File_name = $this->input->post('File_name');
        $user_id = $this->input->post('user_id');
        $path = base_url('/assets/costumer_Files/'.$VendorID.'/'.$user_id.'/'.$File_name);
        force_download('tedd.csv',$path);
    }
    
}