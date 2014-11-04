<?php
##
## This little tool is listing the current php processes, who connecting to remote smtp server.
## Usualy they sending spam to open relay, or the target domain smtp server, wich will accept it, and deliver it localy.
##
## You can run it for example in cron, and put the output in a txt/log file like this:
## * * * * * php /where/you/put/emaillog.php > /where/you/put/emaillog.log 2>&1
##

exec('netstat -nap|grep ":25"|grep php',$procs);

foreach($procs as $k=>$v) {
    $t=preg_split('/[\s]+/', $v);
    $tt=explode("/",$t[6]);
    exec("ps aux |grep ".$tt[0],$out);
    if(count($out)>0) {
        print("\r\n\r\n\r\n".date("Y-m-d H:i")."\r\n");
        print_r($out);
        }
    }
?>
