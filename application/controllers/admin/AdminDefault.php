<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDefault extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		$CI->load->library('session');
        frontendcheck();
	}
   
	public function SavevideosChunk(){
		@set_time_limit(5 * 60);
		$targetDir =   FCPATH . 'assets/images/video';
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
        	@mkdir($targetDir);
        }
        // Get a file name
        if (isset($_REQUEST["name"])) {
        	$fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
        	$fileName = $_FILES["file"]["name"];
        } else {
        	$fileName = uniqid("file_");
        }

    	$ext = pathinfo($fileName);
    	$catImages = str_replace(' ', '_', $ext['filename']);
    	$category_image =$fileName;	

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $category_image;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        // Remove old temp files    
        if ($cleanupTargetDir) {
        	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
        	}
        	while (($file = readdir($dir)) !== false) {
        		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
                // If temp file is current file proceed to the next
        		if ($tmpfilePath == "{$filePath}.part") {
        			continue;
        		}
                // Remove temp file if it is older than the max age and is not the current file
        		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
        			@unlink($tmpfilePath);
        		}
        	}
        	closedir($dir);
        }   
        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
        	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }
        if (!empty($_FILES)) {
        	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        	}
            // Read binary input stream and append it to temp file
        	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        	}
        } else {    
        	if (!$in = @fopen("php://input", "rb")) {
        		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        	}
        }
        while ($buff = fread($in, 4096)) {
        	fwrite($out, $buff);
        }
        @fclose($out);
        @fclose($in);
        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
        	rename("{$filePath}.part", $filePath);
        }
        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }
}
