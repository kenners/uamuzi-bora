<?php
class ExportsController extends AppController {
  var $name = 'Exports';
  var $uses = array();
  
  function dump(){
    
     $dir="/" ;
     if($handle = opendir($dir)){
    $name='schema'.date('c').'.sql';
    var_dump($name);
    passthru('pg_dump -cboOx -f \''.$dir.'/'.$name.'.sql\' -U www-data uamuzibora',$returnval);//dump database
      
      //Find last dump
      $latest=date(0);
      while(false !== ($file=readdir($handle)))//loop through all the files in the folder
	{
	  
	  $date=substr($file,6,-3);//get the timestamp from the filename
	  if($date>$latest)//find the latest timestamp
	    {
	      $latest=$date;
	    }
	}
      $oldfile='schema'.$latest.'.sql';
      $diff_file_name='diff'.date('c').'.sql';
      //create the diff-file
      passthru('diff '.$oldfile.' '.$name.' > '.$diff_file_name);
      //zip the files
      passthru('bzip '.$name ,$returnval);
      passthru('bzip '.$diff_file_name,$returnval);
      // Encrypt files

      passthru('gpg --sign --encrypt '.$name,$returnval);
      passthru('gpg --sign --encrypt '.$diff_file_name,$returnval);
      if(!is_file($name))
	{
	  $this->Session->setFlash("Can't find the schema file");
	}
      if(!is_file($diff_file_name))
	{
	  $this->Session->setFlash("Can't find the diff file");
	}
      
      if(!empty($this->data))
	{
	  $filename=Set::extract($this->data,'Export/file_name');
	  $file=$dir.$filename;
	  // To download the file
	  header("Content-type: $type");
	  header("Content-Disposition: attachment;filename=$filename");
	  header("Content-Transfer-Encoding: binary");
	  header('Pragma: no-cache');
	  header('Expires: 0');
	  // Send the file contents.
	  set_time_limit(0);
	  readfile($file);
	}
   }
   }
}
      
	  
	  