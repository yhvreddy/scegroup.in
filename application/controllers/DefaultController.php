<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DefaultController extends CI_Controller 
{

    

    public function previous_page()
	{
		$refer = $this->agent->referrer();
		return $refer;
	}

    public function print_r($data)
    {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
    }

    public function generate_mails($username,$domain,$length='')
    {
		if($length == ''){
			$length  = 1;
		}
		// array of possible top-level domains
		$tlds = array("edu","info","com","in","co.in","net","org");

		// string of possible characters
		$char = "0123456789abcdefghijklmnopqrstuvwxyz";
		// main loop - this gives 1000 addresses
		for ($j = 0; $j < $length; $j++) {

			// choose random lengths for the username ($ulen) and the domain ($dlen)
			$ulen = $username;
			$dlen = $domain;

			// reset the address
			$a = "";

			// get $ulen random entries from the list of possible characters
			// these make up the username (to the left of the @)
			/*for ($i = 1; $i <= $ulen; $i++) {
                $a .= substr($char, mt_rand(0, strlen($char)), 1);
            }*/
			$a .= $ulen;

			// wouldn't work so well without this
			$a .= "@";

			// now get $dlen entries from the list of possible characters
			// this is the domain name (to the right of the @, excluding the tld)
			/*for ($i = 1; $i <= $dlen; $i++) {
                $a .= substr($char, mt_rand(0, strlen($char)), 1);
            }*/

			$a .= $dlen;

			// need a dot to separate the domain from the tld
			$a .= ".";

			// finally, pick a random top-level domain and stick it on the end
			$a .= $tlds[mt_rand(0, (sizeof($tlds) - 1))];

			// done - echo the address inside a link
			return $a;
		}

	}
      
    //creating Directory
	public function createdir($fileorfolderpath)
	{
		if(!is_dir($fileorfolderpath)){
            if(mkdir($fileorfolderpath, 0777, true)){
                return TRUE;
            }else{
                  return FALSE;
            }
		}else{
              return TRUE;
		}
	}

    //Single file uploading
	public function uploadfiles($uploadpath=NULL,$uploadfile=NULL,$formats=NULL,$renaming=NULL,$width=NULL,$height=NULL)
	{

        $upload_config = array(
            'upload_path'   =>  $uploadpath,
            'allowed_types' =>  $formats,
            'encrypt_name'  =>  $renaming,
        );
        $this->load->library('upload', $upload_config);
        $this->upload->initialize($upload_config);
        
        if(!$this->upload->do_upload($uploadfile)) {
            $report = $this->upload->display_errors();
            $uploaddata = array('status'=>0,'upload'=>'failed','uploaddata'=>$report);
            return $uploaddata;
        }else{
            if($width != '' && $height != ''){
                $upload_config['image_library'] = 'gd2';
                $upload_config['source_image'] = $uploadpath.$fileData["file_name"];
                $upload_config['create_thumb'] = FALSE;
                $upload_config['maintain_ratio'] = FALSE;
                $upload_config['quality'] = '500%';
                $upload_config['width'] = $width;
                $upload_config['height'] = $height;
                $this->load->library('image_lib', $upload_config);
                $this->image_lib->resize();
            }
            $fileData = $this->upload->data();
            $uploaddata = array('status'=>1,'upload'=>'success','uploaddata'=>$fileData);
            return $uploaddata;
        }
   	}

	//multipul files uplaoding
	public function multiuploadfiles($uploadpath=NULL,$uploadfile=NULL,$formats=NULL,$renaming=NULL,$width=NULL,$height=NULL)
	{
		//$this->print_r($uploadpath);
		// If file upload form submitted
		$uploadfiles = '';
		$filesCount = count(array_filter($_FILES[$uploadfile]['name']));
		if($filesCount > 0){
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['file']['name']     = $_FILES[$uploadfile]['name'][$i];
				$_FILES['file']['type']     = $_FILES[$uploadfile]['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES[$uploadfile]['tmp_name'][$i];
				$_FILES['file']['error']    = $_FILES[$uploadfile]['error'][$i];
				$_FILES['file']['size']     = $_FILES[$uploadfile]['size'][$i];

				// File upload configuration
				$upload_config = array(
					'upload_path'   =>  $uploadpath,
					'allowed_types' =>  $formats,
					'encrypt_name'  =>  $renaming,
				);

				// Load and initialize upload library
				$this->load->library('upload',$upload_config);
				$this->upload->initialize($upload_config);

				// Upload file to server
				if($this->upload->do_upload('file')){
					$fileData = $this->upload->data();
					if($width != '' && $height != ''){
						$upload_config['image_library'] = 'gd2';
						$upload_config['source_image'] = $uploadpath.$fileData["file_name"];
						$upload_config['create_thumb'] = FALSE;
						$upload_config['maintain_ratio'] = FALSE;
						$upload_config['quality'] = '500%';
						$upload_config['width'] = $width;
						$upload_config['height'] = $height;
						$this->load->library('image_lib', $upload_config);
						$this->image_lib->resize();
					}
					$uploadfiles.= $uploadpath.$fileData['file_name'].',';
					$status = 1;
					$report = array();
					$upload = 'Success';
				}else{
					echo "====";
					$uploadfiles = '';
					$report = $this->upload->display_errors();
					$status = 0;
					$upload = 'Failed';
				}
			}

			$uploaddata = array('status'=>$status,'upload'=>$upload,'report'=>$report,'uploaddata'=>rtrim($uploadfiles,','));
			return $uploaddata;
		}else{
			$uploaddata = array('status'=>0,'upload'=>'Failed','uploaddata'=>'Uploading Files Empty');
			return $uploaddata;
		}
	}
}
