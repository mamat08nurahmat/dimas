<?php
class order_notif{

    public function kirim_pemesan(){

        require_once 'order_grab.php';
        require_once 'chat_api.php';
        $order_grab = new order_grab();
        
        $belum_notif = $order_grab->belum_notif_order();
        $chat_api = new chat_api();
        
        if(isset($belum_notif)){
        //---------------
        foreach($belum_notif as $data):
            // echo $data["no_pemesan"].'<br>';
        
            $text = 
            // "Anda Terdaftar dalam kelompok ".strtoupper($kelompok)." \n".
            "--------------------------------------------------------\n".
            "Order Grab Detail\n".
            "--------------------------------------------------------\n".
            // $looping1.
            "Nama    : ".$data["Name_Employee"]."\n".
            "Tujunan : ".$data["Trip_Description"]."\n". 
            "\n".
            "Pick Up : ".$data["Pick_Up"]."\n". 
            "( ".$data["Pickup_Date"]." )\n".
            "\n".
            "Drop Off: ".$data["Drop_Off"]."\n". 
            "( ".$data["Dropoff_Date"]." )\n". 
            "\n". 
            "Total   : Rp. ".number_format(str_replace(".00","",$data["Total"]))."\n".
            // "--------------------------------------------------------"."\n";
            "--------------------------------------------------------\n".                                       
            "Butuh bantuan? --> ketik help \n".                                                
            "Ditanya aja Mas.. \n".                                                
            "--------------------------------------------------------"
            ;
            
            // $chat_api->sendMessage('6287711086938',$text); //testing
            $chat_api->sendMessage($data["no_pemesan"],$text);
            $order_grab->update_notif($data["Trip_Code"]);
        echo $data["no_pemesan"]." ( ".$data["Name_Employee"]." ) --> is send notif"."<br>";
        endforeach;
        //---------------
        
        return 'isset';
        
        // print_r('isset');
        }else{
            // print_r('no set');
            return 'no isset';
            
        }
        

        

    }


}

?>