<?php
class Login_model extends CI_Model
{
    
    public function login($username, $password)
    {
        $query = $this->db->get_where('User', array('user_username' => $username, 'user_password' => $password));
        return $query->row_array();
    }
    public function emailCheck($email){
        $this->db->where('user_email', $email);
        return $this->db->get('User')->num_rows();
    }
    function insertaData($data)
    {
        $this->db->insert('User', $data);
        return $this->db->insert_id();
    }
    public function getallpendingvendor(){   
        $this->db->where('status','0');
        $this->db->where('user_level','0');
        $this->db->order_by('user_id','asc');
        $query = $this->db->get('User');
        return $query->result();
    }
    public function getallpendingvendorApproved(){   
        $this->db->where('status','1');
        $this->db->where('user_level','0');
        $this->db->order_by('user_id','asc');
        $query = $this->db->get('User');
        return $query->result();
    }
    public function getallpendingvendorDisapproved(){   
        $this->db->where('status','10');
        $this->db->where('user_level','0');
        $this->db->order_by('user_id','asc');
        $query = $this->db->get('User');
        return $query->result();
    }
    function countallpending()
    {
        $this->db->where('status','0');
        $this->db->where('user_level','0');
        return $this->db->get('User')->num_rows();
    }
    function countallpendingListing($vendorID)
    {
        $this->db->where('VendorID', $vendorID);
        $this->db->where('status','0');
        return $this->db->get('costumertable')->num_rows();
    }
    function VendorNote($id)
    {
        $this->db->where('vendorID',$id);
        $query = $this->db->get('note');
        return $query->row_array();
    }
    function VendorDetail($id)
    {
        $this->db->where('user_id',$id);
        $query = $this->db->get('User');
        return $query->row_array();
    }
    function getStorename($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('User');
        $storeName = $query->row();
        return $storeName->store_name;
    }
    function insertlocation($data)
    {
        $updatestatus = array(
            'status' => '1'
        );
        $this->db->where('user_id', $data['vendorID']);
        $query = $this->db->update('User', $updatestatus);//update status to 1
        if($query){
            $this->db->where('vendorID', $data['vendorID']);
            $delNote = $this->db->delete('vendor_location');// delete your location
            if($delNote){
                $this->db->where('vendorID', $data['vendorID']);
            $delNote2 = $this->db->delete('note');//delete note because we approved this id 
                if($delNote2){
                $this->db->insert('vendor_location', $data);// insert location
                return $this->db->insert_id();
                }
            }
           
        }
        
    }
    function getallLocation()
    {
        $this->db->select('User.user_email,User.storenameImg,vendor_location.*');
        $this->db->join('User', 'User.user_id = vendor_location.vendorID', 'left');
        $query = $this->db->get('vendor_location');
        return $query->result();
        
    }
    function getLocationbyid($vendorID)
    {
        $this->db->select('locationLat, locationLong');
        $query = $this->db->get('vendor_location');
        return $query->result();
        
    }
    function getallvendorservicesbyid($vendorID)
    {
        $this->db->where('vendorID', $vendorID);
        $query = $this->db->get('vendorservice');
        return $query->result();
        
    }
    
    function insertnote($data)
    {
        $updatestatus = array(
            'status' => '10'
        );
        $this->db->where('user_id', $data['vendorID']);
        $query = $this->db->update('User', $updatestatus);//update status to 10 
        if($query){
            $this->db->where('vendorID', $data['vendorID']);
            $delNote = $this->db->delete('note');// delete your notes
            if($delNote){
                $this->db->where('vendorID', $data['vendorID']);
            $delNote2 = $this->db->delete('vendor_location'); //delete location because we disappreved this id 
            if($delNote){
                $this->db->insert('note', $data);// insert note
                return $this->db->insert_id();
            }
            }
        }
        
    }
    //add service
    function insertsevice($data)
    {
        $this->db->insert('vendorservice', $data);
        return $this->db->insert_id();
    }
    //delete service
    function removesevice($service_id)
    {
        $this->db->where('service_id', $service_id);
        if($this->db->delete('vendorservice')){
            return "deleted";
        }
        else{
            return "error";
        }
    }
    //get service info by service id
    function serviceInfoByServiceID($service_id)
    {
        $this->db->where('service_id', $service_id);
        $query = $this->db->get('vendorservice');
        return $query->row_array();
    }
    //get all vendor users
    public function getallvendoruser(){ 
        $this->db->where('user_level','0');
        $this->db->order_by('user_id','asc');
        $query = $this->db->get('User');
        return $query->result();
    }
    //get all users
    public function getallUser(){ 
        $this->db->where('user_level','2');
        $this->db->order_by('user_id','asc');
        $query = $this->db->get('User');
        return $query->result();
    }
    //update service
    function insertUpdatedsevice($data)
    {
        $this->db->where('service_id', $data['service_id']);
        $query = $this->db->update('vendorservice', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function getalllistingCostumerbyVendor_id($vendorID)
    {
        $this->db->select('costumertable.*,vendorservice.service_name,User.user_fname,User.user_lname');
        $this->db->join('vendorservice', 'vendorservice.service_id = costumertable.service_id', 'left');
        $this->db->join('User', 'User.user_id = costumertable.user_id', 'left');
        
        $this->db->where('costumertable.status', "listing");
        $this->db->where('costumertable.VendorID', $vendorID);
        $this->db->order_by('costumertable.costumer_id', 'ASC');
        $query = $this->db->get('costumertable');
        return $query->result();
        
    }
    //Get all pending Costumer
    function getallpendingCostumerbyVendor_id($vendorID)
    {
        $this->db->select('costumertable.*,vendorservice.service_name,User.user_fname,User.user_lname,User.user_email');
        $this->db->join('vendorservice', 'vendorservice.service_id = costumertable.service_id', 'left');
        $this->db->join('User', 'User.user_id = costumertable.user_id', 'left');
        
        $this->db->where('costumertable.status', "pending");
        $this->db->where('costumertable.VendorID', $vendorID);
        $this->db->order_by('costumertable.costumer_id', 'ASC');
        $query = $this->db->get('costumertable');
        return $query->result();
        
    }
    //Get all Ready to Pickup Costumer
    function getallreadytopickCostumerbyVendor_id($vendorID)
    {
        $this->db->select('costumertable.*,vendorservice.service_name,User.user_fname,User.user_lname');
        $this->db->join('vendorservice', 'vendorservice.service_id = costumertable.service_id', 'left');
        $this->db->join('User', 'User.user_id = costumertable.user_id', 'left');
        
        $this->db->where('costumertable.status', "ready");
        $this->db->where('costumertable.VendorID', $vendorID);
        $this->db->order_by('costumertable.costumer_id', 'ASC');
        $query = $this->db->get('costumertable');
        return $query->result();
        
    }
    //Update Costumer Status
    function UpdateCostumer($dataArray)
    {
        $this->db->where('costumer_id', $dataArray['costumer_id']);
        $query = $this->db->update('costumertable', $dataArray);
        if($query){
            return true;
        }else{
            return false;
        }
    }
    //Get History
    function getallHistorybyVendor_id($vendorID)
    {
        $status_array = array('success','reject','11','cancel');

        $this->db->select('costumertable.*,vendorservice.service_name,User.user_fname,User.user_lname');
        $this->db->join('vendorservice', 'vendorservice.service_id = costumertable.service_id', 'left');
        $this->db->join('User', 'User.user_id = costumertable.user_id', 'left');
        $this->db->where_in('costumertable.status',$status_array);
        // $this->db->where('costumertable.status', 'reject')->or_where('costumertable.status', 'success')->or_where('costumertable.status', '11')->or_where('costumertable.status', 'cancel');
        
        $this->db->where('costumertable.VendorID', $vendorID);
        $this->db->order_by('costumertable.costumer_id', 'ASC');
        $query = $this->db->get('costumertable');
        return $query->result();
        
    }

}