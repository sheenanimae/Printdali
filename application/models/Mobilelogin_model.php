<?php
class Mobilelogin_model extends CI_Model
{
    
    public function emailCheck($email){
        $this->db->where('user_email', $email);
        return $this->db->get('User')->num_rows();
    }
    public function usernameCheck($username){
        $this->db->where('user_username', $username);
        return $this->db->get('User')->num_rows();
    }
    public function insertaData($data)
    {
        $this->db->insert('User', $data);
        return $this->db->insert_id();
    }
    
    public function insertaDatatransaction($data)
    {
        $this->db->insert('costumertable', $data);
        return $this->db->insert_id();
    }
    public function loginData($data){
        $this->db->where('user_level', $data['user_level']);
        $this->db->where('user_username', $data['user_username']);
        $this->db->where('user_password', $data['user_password']);
        $query = $this->db->get('User')->num_rows();

        $this->db->where('user_level', $data['user_level']);
        $this->db->where('user_username', $data['user_username']);
        $this->db->where('user_password', $data['user_password']);
        $userInfo = $this->db->get('User')->row_array();
        $RetunData = array(
            'userInfo' => $userInfo,
            'query'  => $query,
        );
        return $RetunData;
    }
    
    function Vendorstore()
    {
        $this->db->Select("vendor_location.*,User.user_email");
        $this->db->join('User', 'User.user_id = vendor_location.vendorID', 'left');
        $query = $this->db->get('vendor_location');
        return $query->result();
    }
    function UserInfo($userid)
    {
        $this->db->where('user_id', $userid);
        $query = $this->db->get('User');
        return $query->result();
    }
    function userdoneTransaction($userid)//history
    {
        $this->db->Select("costumertable.*,User.user_email,User.store_name");
        $this->db->where('costumertable.user_id', $userid);
        $this->db->where('costumertable.status', "cancel");
        $this->db->or_where('costumertable.status', 'success');
        $this->db->or_where('costumertable.status', '11');
        $this->db->join('User', 'User.user_id = costumertable.VendorID', 'left');
        $query = $this->db->get('costumertable');
        return $query->result();
    }
    function userTransaction($userid)
    {
        $this->db->Select("costumertable.*,User.user_email,User.store_name,User.user_contactnumber");
        $this->db->where('costumertable.user_id', $userid);
        $this->db->where('costumertable.status !=','cancel');
        $this->db->where('costumertable.status !=','11');
        $this->db->join('User', 'User.user_id = costumertable.VendorID', 'left');
        $query = $this->db->get('costumertable');
        return $query->result();
    }
    function VendorServices($vendorID)
    {   
        $this->db->Select("vendorservice.*,User.user_email");
        $this->db->join('User', 'User.user_id = vendorservice.vendorID', 'left');
        $this->db->where('vendorservice.vendorID', $vendorID);
        $query = $this->db->get('vendorservice');
        return $query->result();
    }
    function Rateus($Data)
    {   
        $updatestatus = array(
            'status' => "11",
            'rate'=> $Data['rate']
        );
        $this->db->where('costumer_id', $Data['costumer_id']);
        if( $query = $this->db->update('costumertable', $updatestatus)){
            return true;
        }
        else{
            return false;
        }
    }
    function getvendorcostumer($vendorID)
    {
        $this->db->where('vendorID',$vendorID);
        return $this->db->get('costumertable')->num_rows();
    }
    function getvendorcostumernotcount($vendorID)
    {
        $this->db->where('vendorID',$vendorID);
        return $this->db->get('costumertable')->result();
    }
    function skipR($costumer_id)
    {   
        $updatestatus = array(
            'status' => "11",
            'rate' => '0'
        );
        $this->db->where('costumer_id', $costumer_id);
        if( $query = $this->db->update('costumertable', $updatestatus)){
            return true;
        }
        else{
            return false;
        }
    }
    function cancelT($costumer_id)
    {   
        $updatestatus = array(
            'status' => "cancel",
        );
        $this->db->where('costumer_id', $costumer_id);
        if( $query = $this->db->update('costumertable', $updatestatus)){
            return true;
        }
        else{
            return false;
        }
    }
    public function updatepayment($data){
        $updatestatus = array(
            'paymentSS' => strval( $data['paymentSS'] ) ,
            'costumer_status'=>'1'
            ,
        );
        $this->db->where('costumer_id', $data['costumer_id']);
        if( $query = $this->db->update('costumertable', $updatestatus)){
            return true;
        }
        else{
            return false;
        }
    }
}