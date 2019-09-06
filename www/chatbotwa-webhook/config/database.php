
<?php

class database {
	// deklarasi parameter koneksi database
	private $dbHost     = "mysql";//"35.225.105.181";//"34.67.111.165"; //"bnisln2019.mysql.database.azure.com"; //"png-mysql";
	private $dbUser     = "root";
	private $dbPassword = "nurahmat";//"bnisln2019";
	private $dbName     = "chatbotwa";
	
	public function connect() {
		// koneksi ke server MySQL
		$mysqli = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);	

		// cek koneksi tersambung atau tidak
		if ($mysqli->connect_error){
			echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")";
		}  
		
		// nilai kembalian bila koneksi berhasil
		return $mysqli;
	}
}
?>
