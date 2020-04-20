<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function index() {
		header("HTTP/1.1 401: Not Authorized");
	}

	public function getfilelist() {
		$date = $this->input->get('date');

		$destdir = "c:/gravacoes/".$date;
		if (file_exists($destdir)) {
			chdir($destdir);
			$filesindir = array_map('basename', glob('*.{mp3,MP3}', GLOB_BRACE));
			sort($filesindir);
			header('Content-Type: application/json');
			print json_encode($filesindir);
		} else {
			header("HTTP/1.1 404 Not Found");
		}
	}

	public function getfile() {
		$date = $this->input->get('date');
		$file = $this->input->get('file');
		$destdir = "c:/gravacoes/".$date;

		if (file_exists($destdir)) {
			chdir($destdir);
			if (file_exists($file)) {
				header('Content-type: audio/mpeg');
				header('Content-Disposition: attachment; filename="'.$file.'"');
				readfile($file);
			} else {
				header("HTTP/1.1 404 Not Found");
			}
		} else {
			header("HTTP/1.1 404 Not Found");
		}
	}

	public function getfileinfo() {
		$filename = $this->input->get('filename');

		$this->load->model('api_model');
		$fileinfo = $this->api_model->getfileinfo($filename);

		header('Content-Type: application/json');
		print json_encode($fileinfo);
	}

	public function getnoanswer() {
		$date = $this->input->get('date');

		$this->load->model('api_model');
		$fileinfo = $this->api_model->getnoanswer($date);
		header('Content-Type: application/json');
		print json_encode($fileinfo);
	}
}
