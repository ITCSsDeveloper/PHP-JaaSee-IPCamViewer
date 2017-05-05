<?php 
function getTokenCount($level)
{   
    if($level == "superAdmin")  { return 1000; }
    else if($level == "tester") { return 100;  }
    else if($level == "member") { return 10;  }
    else if($level == "guest")  { return 2;  }
    else { return 0;  }
}
?>