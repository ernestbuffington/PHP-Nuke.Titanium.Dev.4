<?php 
// ==================================================================
	//  Author: Ted Kappes (pesoto74@soltec.net)
	//	Web: 	http://tkap.org/paginator/
	//	Name: 	Paginator_html
	// 	Desc: 	Class extension for Paginator. Adds pre-made link sets.
	//
	// 7/21/2003
	//
	//  Please send me a mail telling me what you think of Paginator
	//  and what your using it for. [ pesoto74@soltec.net]
	//
// ==================================================================
      
			class Paginator_html extends Paginator { 
			
			  //outputs a link set like this 1 of 4 of 25 First | Prev | Next | Last |              
				function firstLast()
			  {				
					 if($this->getCurrent()==1)
		         {
		         $first = "First | ";
		         } else { $first="<a href=\"" .  $this->getPageName() . "?op=ws_submemb&page=" . $this->getFirst() . "\">First</a> |"; }  
		       if($this->getPrevious())
		         {
		         $prev = "<a href=\"" .  $this->getPageName() . "?op=ws_submemb&page=" . $this->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		
	         if($this->getNext())
		         {
		         $next = "<a href=\"" . $this->getPageName() . "?op=ws_submemb&page=" . $this->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		
		       if($this->getLast())
		         {
		         $last = "<a href=\"" . $this->getPageName() . "?op=ws_submemb&page=" . $this->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
		         echo $this->getFirstOf() . " of " .$this->getSecondOf() . " of " . $this->getTotalItems() . " ";
		         echo $first . " " . $prev . " " . $next . " " . $last;
				} 
				//outputs a link set like this Previous 1 2 3 4 5 6 Next   
				function previousNext()
				{
					if($this->getPrevious())
		        {
		        echo "<a href=\"" . $this->getPageName() . "?op=ws_submemb&page=" . $this->getPrevious() . "\">Previous</a> ";
		        }
						$links = $this->getLinkArr();
		      foreach($links as $link)
	          {
	          if($link == $this->getCurrent())
					    {
					     echo " $link ";
					    } else { echo "<a href=\"" . $this->getPageName() . "?op=ws_submemb&page=$link\">" . $link . "</a> ";
					    }
		          } 
						if($this->getNext())
		          {
		          echo "<a href=\"" . $this->getPageName() . "?op=ws_submemb&page=" . $this->getNext() . "\">Next</a> ";
		          }
		        }  
	}//ends class


         ?>