<?php
/**
 * Clase utilidad para manejar el cron
 * @author Miguel Callon
 */
class CrontabManager {
	private $path;
	private $handle;
	private $cronFile;
	
	function __construct() {
		$pathLength	 = strrpos(__FILE__, "/");
		$this->path 	 = '/etc/';		
		$this->handle	 = 'crontab';
		$this->cronFile = "/etc/".$this->handle;	
	}
	
	public function writeToFile($path=NULL, $handle=NULL)
	{
		echo "escribir al fichero";
		if ( ! $this->crontabFileExists())
		{
			echo "lo crea";		
			$this->handle = (is_null($handle)) ? $this->handle : $handle;
			$this->path   = (is_null($path))   ? $this->path   : $path;			
			$this->cronFile = "{$this->path}{$this->handle}";
			
			$initCron = "crontab -l > {$this->cronFile} && [ -f {$this->cronFile} ] || > {$this->cronFile}";
			
			$this->exec($initCron);
		}
	
		//echo $this;
		echo "escribir";
		return $this;	
	}
	
	public function removeFile()
	{		
		if ($this->crontabFileExists()) $this->exec("rm {$this->cronFile}");		
		return $this;
	}
	
	public function appendCronjob($cron_jobs=NULL)
	{
		if (is_null($cron_jobs)) $this->errorMessage("Nothing to append!  Please specify a cron job or an array of cron jobs.");
		
		$append_cronfile = "echo '";			
		$append_cronfile .= (is_array($cron_jobs)) ? implode("\n", $cron_jobs) : $cron_jobs;
		$append_cronfile .= "'  >> {$this->cronFile}";
		//$install_cron = "crontab {$this->cronFile}";
		
		echo "$append_cronfile";
		echo "$install_cron";

		$this->writeToFile()->exec($append_cronfile)->removeFile();
		
		return $this;		
	}
	
	public function removeCronjob($cronJobs=NULL)
	{	
		if (is_null($cronJobs)) $this->errorMessage("Nothing to remove!  Please specify a cron job or an array of cron jobs.");
		
		$this->writeToFile();
	
		$cronArray = file($this->cronFile, FILE_IGNORE_NEW_LINES);
		
		if (empty($cronArray))
		{
			$this->removeFile()->errorMessage("Nothing to remove!  The cronTab is already empty.");			
		}
		
		$originalCount = count($cronArray);
		
		if (is_array($cronJobs))
		{
			foreach ($cronJobs as $cronRegex) $cronArray = preg_grep($cronRegex, $cronArray, PREG_GREP_INVERT);
		}
		else
		{
			$cronArray = preg_grep($cronJobs, $cronArray, PREG_GREP_INVERT);
		}
		
		return ($originalCount === count($cronArray)) ? $this->removeFile() : $this->removeCrontab()->appendCronjob($cronArray);
	}

	public function removeCrontab()
	{
		$this->removeFile()->exec("crontab -r");		
		return $this;
	}

	private function crontabFileExists()
	{
		echo "fichero de crontab existe? ".file_exists($this->cronFile);
		return file_exists($this->cronFile);
	}
	
	private function errorMessage($error)
	{
		die("<pre style='color:#EE2711'>ERROR: {$error}</pre>");
	}
	
	public function exec()  
	{  
	    $argument_count = func_num_args();  
	  
	    try  
	    {  
	        if ( ! $argument_count) throw new Exception("There is nothing to execute, no arguments specified.");  
	        $arguments = func_get_args();  
	        $command_string = ($argument_count > 1) ? implode(" && ", $arguments) : $arguments[0];  
	       
		   	$command_string = 'echo "iu" | sudo -u root -S '.$command_string;
		   	echo "instalar: $command_string";
		    $stream = exec($command_string);  
	        if ( ! $stream) throw new Exception("Unable to execute the specified commands: <br>{$command_string}");  
	    }  
	    catch (Exception $e)  
	    {
	        $this->errorMessage($e->getMessage());  
	    } 
	    return $this;  
	} 
}
?>