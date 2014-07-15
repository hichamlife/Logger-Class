<?php
/**
 * Logger Class
 *
 * @author  HichamHadraoui <fb.com/hadraouiii - hichamhadraoui.hh@gmail.com>
 * @version version 1.0
 * @license GPL2
 */

class Logger {
	
	public function __constrcut($mode='dev') {
		if($mode == 'dev') error_reporting(E_ALL);
		else error_reporting(0);
	}
	/* 
	 * the logger file .txt
	 */
	protected $file = "Logger.txt";
	
	/* 
	 * write in the file of logger txt .. with a line break of each error
	 * @param string $msg
	 */
	public function writeToFile($msg) {
		if(!file_put_contents($this->file,file_get_contents($this->file).$msg."\n\n")) {
			die("There is error in handling errors system");
		}
	}

	/* 
	 * displaying the logger file with a nice way for human read
	 * @return string text
	 */
	
	public function displayfile() {
		if(function_exists("show_source")) {
			$source = show_source($this->file);
			if(preg_match("/1/",$source)) 
				echo preg_replace("/1/","",$source);
		}
	}

	/*
	 * make the file of logger empty by restarting him
	 * @return void
	 */
	
	public function restartFile() {
		$restart = file_put_contents($this->file,"");
	}

	/*
	 * remove lines by puting the number
	 * Use : put the number of lines to remove in the parametre 
	 * @param int $lines
	 * @return void
	 */

	public function removeLines($lines) {
		$lines = file($this->file);
		$first_line = $lines[0];
		$lines = array_slice($lines, $lines + 2);
		$lines = array_merge(array($first_line, "\n"), $lines);

		// Write to file
		$file = fopen($this->file, 'w');
		fwrite($file, implode('', $lines));
		fclose($file);
	}

}
