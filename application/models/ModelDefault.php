<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModelDefault extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }

    public function print_r($data)
    {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
    }

    //insert new data to table
    public function insert_data($tablename,$insertdata){
        $this->db->insert($tablename,$insertdata);
        //$result = $this->db->last_query();
        $return = $this->db->insert_id();
        return $return;
    }
    
    //rows count
    public function row_count($tablename,$conduction=NULL){
        $this->db->select('*');
        $this->db->from($tablename);
        if($conduction != ''){
            $this->db->where($conduction);
        }
        $returndata = $this->db->get();
        //$result = $this->db->last_query();
        $result = $returndata->num_rows();
        return $result;
    }

    //select data all with conduction and with out conductions
    public function select_data($tablename,$conduction=NULL,$orderby=NULL,$limit=NULL){
        $this->db->select('*');
        $this->db->from($tablename);
        if($conduction != ''){ $this->db->where($conduction); }
        if($orderby != ''){ $this->db->order_by($orderby); }
        if($limit != ''){ $this->db->limit($limit); }
        //$result = $this->db->last_query();
        $returndata = $this->db->get();
        return $returndata->result();
    }

    //Maual query
    public function query($query){
        $dataquery = $this->db->query($query);
        $result = $dataquery->result();
        //$result = $this->db->last_query();
        return $result;
    }

    //update data
    public function update_data($tablename,$updatedata,$conduction){
        $this->db->where($conduction);
        $this->db->update($tablename,$updatedata);
        //$result = $this->db->last_query();
        $return = $this->db->affected_rows();
        return $return;
    }
    
    //delete data peramently
    public function delete_data($tablename,$conduction){
        $this->db->where($conduction);
        $this->db->delete($tablename);
        //$result = $this->db->last_query();
        $return = $this->db->affected_rows();
        return $return;
    }

    //clean string without any special chars
    public function cleanstring($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    //password hash
    public function secured_hash($input){
        $output = password_hash($input,PASSWORD_DEFAULT);
        return $output;
    }

    //check hashpassword
    public function verifyhashpassword($plantext,$hash){
        if (password_verify($plantext, $hash)) {
            return 1;
        } else {
            return 0;
        }
    }

    // Genereate scrial Keys
    public function genserialkey(){
        $template = 'xx99-xx99-xx99-xxxx';
        $k = strlen($template);
        $sernum = "";
        for($i = 0; $i < $k; $i++){
            switch($template[$i]){
                case 'x': $sernum .= chr(rand(65,90)); break;
                case '9': $sernum .= rand(0,9); break;
                case '-': $sernum .= '-'; break;    
            }
        }
        return $sernum;
    }

    //geting first litter from each word
    public function initials($str) {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            @$ret .= strtoupper($word[0]);
        return $ret;
    }

    //ramdom number gen--
    public function generateRandom($min, $max) {
        if (function_exists('random_int')):
            return random_int($min, $max); // more secure
        elseif (function_exists('mt_rand')):
            return mt_rand($min, $max); // faster
        endif;
        return rand($min, $max); // old
    }

    //ramdom char---
    public function random_string($length) {
        $key = '';
        $keys = array_merge(range('A', 'Z'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

    //genrate letters A-Z
    public function generatletters($totallength=NULL){
        $len = -1;
        $length = '';
        for ($char = 'A'; $char <= 'Z'; $char++) {
            $len++;
            if ($len == $totallength) {
                break;
            }
            $length .= $char.',';
        }

        return json_encode(trim($length,','));
    }

    //sms function
    public function smssendingfunction($apikey,$mobilenumber,$senderschoolid,$sendmessage){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender= echo $senderschoolid&route=4&mobiles= echo $mobilenumber&authkey= echo $apikey&encrypt=&country=0&message= echo $sendmessage&flash=&unicode=&schtime=&afterminutes=&response=json&campaign=",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }

        curl_close($curl);
    }

    //geneate serialkey
    public function sernum(){
        $template = 'xx99-xx99-xx99-xxxx';
        $k = strlen($template);
        $sernum = "";
        for($i = 0; $i < $k; $i++){
            switch($template[$i]){
                case 'x': $sernum .= chr(rand(65,90)); break;
                case '9': $sernum .= rand(0,9); break;
                case '-': $sernum .= '-'; break;    
            }
        }
        return $sernum;
    }

    //Time or date ago
    public function daysago($date = NULL) {
        $timestamp = strtotime($date);

        $strTime = array("second", "min", "hour", "day", "month", "year");
        $length = array("60","60","24","30","12","10");

        $currentTime = time();
        if($currentTime >= $timestamp) {
            $diff = time()- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
        }
    }
    
    //Two Dates differences
    public function datediff($startingdate = NULL,$endingdate = NULL){
        $date1 = date_create($startingdate);
        $date2 = date_create($endingdate);
        //difference between two dates
        $diff = date_diff($date1,$date2);

        $text       = 'The difference is ';
        $year       =  $diff->y;
        $month      =  $diff->m;
        $days       =  $diff->d;
        $hours      =  $diff->h;
        $minutes    =  $diff->i;
        $secound    =  $diff->s;

        $daysdiff   =  $diff->format("%a");

        return $data = array('text'=>$text,'year'=>$year,'month'=>$month,'days'=>$days,'hours'=>$hours,'min'=>$minutes,'sec'=>$secound,'diff'=>$daysdiff);

        //count days
        //echo 'Days Count - '.$diff->format("%a");
    }
    
    //Days time remaining
    public function remaining($datetime){
        //Convert to date
        $datestr=$datetime;//Your date
        $date=strtotime($datestr);//Converted to a PHP date (a second count)

        //Calculate difference
        $diff=$date-time();//time returns current time in seconds
        $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
        $hours=round(($diff-$days*60*60*24)/(60*60));

        //Report
        //echo "$days days $hours hours remain<br />";
        return $data = array('days'=>$days,'hours'=>$hours);
    }

    //mail attachments
	public function attached_files($attachment,$extension,$name){
    	?>
		<li class="fa-file">
			<div class="document-file">
				<a href="<?=base_url($attachment)?>" target="_blank">
					<?php if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif'){ ?>
						<span data-toggle="tooltip" title="<?=strtolower($name)?>"><img src="<?=base_url($attachment)?>" class="img-responsive" style="width: 100%"></span>
					<?php }else if($extension == 'pdf'){ ?>
						<i class="fas fa-file-pdf" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php }else if($extension == 'doc' || $extension == 'docx' || $extension == 'docm'){ ?>
						<i class="fas fa-file-word" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php }else if($extension == 'ppt' || $extension == 'ppsx' || $extension == 'pptx' || $extension == 'pptm'){ ?>
						<i class="fas fa-file-powerpoint" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php }else if($extension == 'csv' || $extension == 'xlsx' || $extension == 'xlsm'){ ?>
						<i class="far fa-file-excel" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php }else if($extension == 'zip' || $extension == 'rar' || $extension == '7z' || $extension == 'TAR'){ ?>
						<i class="fas fa-file-archive" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php }else if($extension == 'txt'){ ?>
						<i class="far fa-file-alt" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php }else{ ?>
						<i class="far fa-copy" data-toggle="tooltip" title="<?=strtolower($name)?>"></i>
					<?php } ?>
				</a>
			</div>
			<div class="document-name"><a href="javascript:;"><?=strtolower($name)?></a></div>
		</li>
		<?php
	}

}
