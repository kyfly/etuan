<?php
	require_once 'sdk.class.php';

	class oss
	{
		private $oss;
		public function __construct(){
			$this->oss = new ALIOSS;
		}
		public  function create_bucket($bucket,$acl = 'public-read'){
			
			$response = $this->oss->create_bucket($bucket,$acl);

			return $response;
		}
		public  function list_bucket(){
			
			$response = $this->oss->list_bucket();
			
			return $response;
		}
		public  function get_bucket_acl($bucket,$options=[ALIOSS::OSS_CONTENT_TYPE => 'text/xml',]){
			
			$response = $this->oss->get_bucket_acl($bucket,$options);
			
			return $response;
		}
		public  function set_bucket_acl($bucket,$acl = 'public-read'){
			
			$response = $this->oss->set_bucket_acl($bucket,$acl);
			
			return $response;
		}
		public  function delete_bucket($bucket){
			
			$response = $this->oss->delete_bucket($bucket);
			
			return $response;
		}
		public  function list_object($bucket){
			
			$response = $this->oss->list_object($bucket);
			
			return $response;
		}
		public  function get_object($bucket,$object,$options){
			
			$response = $this->oss->get_object($bucket,$object,$options);
			
			return $response;
		}
		public  function create_object_dir($bucket,$object){
			
			$response = $this->oss->create_object_dir($bucket,$object);
			
			return $response;
		}
		//content , length
		public  function upload_file_by_content($bucket,$object,$options){
			
			$response = $this->oss->upload_file_by_content($bucket,$object,$options);
			
			return $response;
		}
		public  function upload_file_by_file($bucket,$object,$file){
			
			$response = $this->oss->upload_file_by_file($bucket,$object,$file);
			
			return $response;
		}
		public  function is_object_exist($bucket,$object){
			
			$response = $this->oss->is_object_exist($bucket,$object);
			
			return $response;
		}
		public  function delete_object($bucket,$object){
			
			$response = $this->oss->delete_object($bucket,$object);
			
			return $response;
		}
		public  function get_sign_url($bucket,$object){
			
			$response = $this->oss->get_sign_url($bucket,$object);
			
			return $response;
		}
	}