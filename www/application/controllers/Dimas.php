<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Dimas Controller
*| --------------------------------------------------------------------------
*| For default controller
*|
*/
class Dimas extends Front
{
    
    var $APIurl = 'https://api.chat-api.com/instance53243/';
    var $token = '6o15kym7hd1sqk49';

	public function __construct()
	{
		parent::__construct();
        // $this->load->model('model_Dimas');
	}

    public function sendRequest($method,$data){
        $url = $this->APIurl.$method.'?token='.$this->token;
        if(is_array($data)){ $data = json_encode($data);}
        $options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $data]]);
        $response = file_get_contents($url,false,$options);
        // file_put_contents('requests.log',$response.PHP_EOL,FILE_APPEND);
    
    }

    public function sendMessage($phone, $text){
                              
        $data = array('phone'=>$phone,'body'=>$text);
        $this->sendRequest('message',$data);
    }

    public function sendFile($phone, $file_url,$file_name,$caption){
                              
        $data = array('phone'=>$phone,'body'=>$file_url,'filename'=>$file_name,'caption'=>$caption);
        $this->sendRequest('sendFile',$data);
    }

    public function webhook(){
        // public function webhook($webhookUrl){
        $webhookUrl = "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/webhook_dimas.php';                              
// print_r($webhookUrl);die();        
        $data = array('webhookUrl'=>$webhookUrl);
        $this->sendRequest('webhook',$data);
        print_r('webhook_dimas running on --->> '.$webhookUrl);        
    }

//===========================================================================================================
public function tes_kirim_file() 
{

$phone='6287711086938';
$file_url = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/mugiwara.png';
// print_r($file_url);die();
$file_name='mugiwara.png';
$caption='mugiwara';

$this->sendFile($phone, $file_url,$file_name,$caption);
echo"file terkirim ke ".$phone;
}

public function mugiwara($phone) 
{

// $phone='6287711086938';
$file_url = "http://" . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'].'/mugiwara.png';
// print_r($file_url);die();
$file_name='mugiwara.png';
$caption='mugiwara';

$this->sendFile($phone, $file_url,$file_name,$caption);
echo"file terkirim ke ".$phone;
}


public function tes_kirim_pesan() 
{

$phone='6287711086938';

$content = 
"--------------------------------------------------------\n".                                       
"Butuh bantuan? --> ketik help \n".                                                
"Ditanya aja Mas.. \n".                                                
"--------------------------------------------------------"
;
$this->sendMessage($phone,$content);
echo"pesan terkirim ke ".$phone;
}

//============================
public function notif_grab(){

    // require_once 'order_grab.php';
    // require_once 'chat_api.php';
    // $order_grab = new order_grab();

    $sql = "
    SELECT *
    FROM 
    vw_report_sudah_terpakai 
    where is_notif=0
    ";

    $belum_notif = $this->db->query($sql);
    
    // print_r($belum_notif[0]->no_pemesan);die();
    // print_r($belum_notif->num_rows());die();

    // foreach($belum_notif->result_array() as $row){
    //     echo $row['Name_Employee'];
    // }
    // die();
    if($belum_notif->num_rows()){
        //---------------
        foreach($belum_notif->result_array() as $data):

            // echo $data['Name_Employee'].'</br>';            
            // echo $data['no_pemesan'].'</br>';            
            $text = 
            // "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
            "--------------------------------------------------------\n".
            "Order Grab Detail\n".
            "--------------------------------------------------------\n".
            // $looping1.
            "Nama    : ".$data["Name_Employee"]."\n".
            "Tujuan : ".$data["Trip_Description"]."\n". 
            "\n".
            "Kode Voucher : ".$data["Trip_Code"]."\n". 
            "\n".
            "Pick Up : ".$data["Pick_Up"]."\n". 
            "( ".$data["Pickup_Date"]." )\n".
            "\n".
            "Drop Off: ".$data["Drop_Off"]."\n". 
            "( ".$data["Dropoff_Date"]." )\n". 
            "\n". 
            "Total 💳   : Rp. ".number_format(str_replace(".00","",$data["fare"]))."\n".
            // "--------------------------------------------------------"."\n";
            "--------------------------------------------------------\n".                                       
            "Butuh bantuan? --> ketik help \n".                                                
            "Ditanya aja Mas.. \n".                                                
            "--------------------------------------------------------"
            ;
            
            // $chat_api->sendMessage('6287711086938',$text); //testing
            $this->sendMessage($data["no_pemesan"],$text);
            $this->sendMessage($data["no_pemimpin"],$text);
            // $order_grab->update_notif($data["Trip_Code"]);
            
            // UPDATE STATUS ;
            $sql2 = "
            UPDATE
            form_order_grab o
            left join form_kode_grab  k ON o.id_kode_grab=k.id
            SET o.is_approved=1 
            WHERE k.kode_grab='".$data['Trip_Code']."'
            "; 
            $this->db->query($sql2);

            echo $data["no_pemesan"]." ( ".$data["Name_Employee"]." ) --> is send notif"."<br>";
            //---------------
            /*
*/ 
endforeach;
        
        // print_r('isset');
    }else{

        $sql2 = "
        SELECT count(*) as jumlah_data ,update_at from grab_report group by update_at order by update_at desc
        "; 
        
        $grab_report = $this->db->query($sql2);            
        print_r('GRAB_REPORT'.'</br>');
        print_r('==================================='.'</br>');
        print_r('UPDATE_AT ---> JUMLAH_DATA'.'</br>');
        foreach($grab_report->result_array() as $row){
        echo $row['update_at']. "-->>".$row['jumlah_data']. '</br>';
    }
        
    }    

    /*
    */    
    
}
//============================
    public function index() 
    {
// $kode = $this->db->query("SELECT * FROM form_kode_grab")->result();        
// print_r($kode);
$kontak_pemimpin='6287711086938';

$text = 
"--------------------------------------------------------\n".                                       
"Butuh bantuan? --> ketik help \n".                                                
"Ditanya aja Mas.. \n".                                                
"--------------------------------------------------------"
;
$this->sendMessage($kontak_pemimpin,$text);

echo"xxxxxxxxxxxxxxxxx";
    }




}


/* End of file Dimas.php */
/* Location: ./application/controllers/Dimas.php */