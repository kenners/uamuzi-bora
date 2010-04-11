<?php
class ReportsController extends AppController {
        
	var $name = 'Reports';
	// Stuff to make javascript work
    var $helpers = array('Html','Javascript','Ajax', 'Crumb');
    var $uses = array('Patient');// No model for this controller
	// Setting the limit for paginator
    var $paginate = array('limit' => 25);
    var $reports = array('VF-report','MoH-report');
 
    function download(){
	$path='../vendors/reports/';
        if(!empty($this->data)) {
	    //debug($this->data);
	    chdir($path);
	    $filename=$this->reports[$this->data['Patient']['Report']];
	    
	    //$out=system('pwd');
	    shell_exec('cd '.$path);
	    
	    
	    $start=$this->data['start']['year'].'-'.$this->data['start']['month'].'-'.$this->data['start']['day'];
	    $end=$this->data['Patient']['end']['year'].'-'.$this->data['Patient']['end']['month'].'-'.$this->data['Patient']['end']['day'];
	    #debug('python '.$filename.'.py '.$start.' '.$end);
	    shell_exec('python '.$filename.'.py '.$start.' '.$end);
	    //your file to upload
	    $fullPath ='output/'.$filename.$this->data['start']['day'].$this->data['start']['month'].$this->data['start']['year'].'-'.$this->data['Patient']['end']['day'].$this->data['Patient']['end']['month'].$this->data['Patient']['end']['year'].'.pdf';


	    $content = fopen ($fullPath,'r'); 



	  if ($fd = fopen ($fullPath, "r")) {
	      $fsize = filesize($fullPath);
	      $path_parts = pathinfo($fullPath);
	      $ext = strtolower($path_parts["extension"]);
	      switch ($ext) {
	      case "pdf":
		
		header("Content-type: application/pdf"); // add here more headers for diff. extensions
		header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
		 // use 'attachment' to force a download
		break;
		default;
		header("Content-type: application/octet-stream");
		header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
	      }
	      header("Content-length: $fsize");
	      header("Cache-control: private"); //use this to open files directly
	      while(!feof($fd)) {
		$buffer = fread($fd, 2048);
		echo $buffer;
	      }
	  }
	  fclose ($fd);
	  header('Location: '.$this->webroot);
	  exit;
	  
	  

     
	}
	else{
	    //find and set earliest transfer in date.
	    $date=$this->Patient->MedicalInformation->find('first',array('fields'=>array('hiv_positive_clinic_start_date'),'order'=>array('hiv_positive_clinic_start_date ASC')));
	    $date=explode('-',$date['MedicalInformation']['hiv_positive_clinic_start_date']);
	    
	    if(!empty($date[0])){
	    $date=array('day'=>$date[2]-1,'month'=>$date[1],'year'=>$date[0]);
	    }else{
		  $date=array('day'=>1,'month'=>1,'year'=>1978);
	    }
	    $this->set('date',$date);
	    $this->set('reports',$this->reports);
	}
    }
  
	
}
