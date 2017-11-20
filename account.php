<?php
    class Account
    {
        var $id;
        var $lastname;
        var $hours;
        var $minutes;
        var $ratio;
        
        function __construct($i, $ln, $h, $m, $r)
        {
        	$this->id = $i;
        	$this->lastname = $ln;
        	$this->hours = $h;
        	$this->minutes = $m;
        	$this->ratio = $r;
        }
        
        function getTotalTimeMinutes()
        {
        	return ($this->hours * 60) + $this->minutes;
        }
    }
    
    function cmpPlaytimeAsc($a, $b)
    {
    	if($a->getTotalTimeMinutes() < $b->getTotalTimeMinutes())
    		return -1;
		else if($a->getTotalTimeMinutes() > $b->getTotalTimeMinutes())
			return 1;
		else return 0;
    }
    
    function cmpPlaytimeDesc($a, $b)
    {
    	if($a->getTotalTimeMinutes() < $b->getTotalTimeMinutes())
    		return 1;
		else if($a->getTotalTimeMinutes() > $b->getTotalTimeMinutes())
			return -1;
		else return 0;
    }
    
    function cmpRatioAsc($a, $b)
    {
        if($a->ratio < $b->ratio)
            return -1;
        else if($a->ratio > $b->ratio)
            return 1;
        else return 0;
    }
    
    function cmpRatioDesc($a, $b)
    {
        if($a->ratio < $b->ratio)
            return 1;
        else if($a->ratio > $b->ratio)
            return -1;
        else return 0;
    }
?>