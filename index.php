<?php

class crob
{
    private $_cronBin = '/usr/bin/crontab';

    
    private $_tmpFile = '/tmp/cronJob';

    /**
     * 分钟(0-59)
     */
    private $_minute = '*';

    /**
     * 小时( 0-23 )
     */
    private $_hour = '*';

    /**
     * 月份中日期(1-31)
     */
    private $_dayOfMonth = '*';

    /**
     * 月份(1-12)
     */
    private $_month = '*';

    /**
     * 周几(0-6)
     */
    private $_dayOfWeek = '*';

    public function setMinute( $minute )
    {
        $this->_minute = $minute;
        return $this;
    }

    public function setHour( $hour )
    {
        $this->_hour = $hour;
        return $this;
    }

    public function setDayOfMonth( $dayOfMonth )
    {
        $this->_dayOfMonth = $dayOfMonth;
        return $this;
    }

    public function setMonth( $month )
    {
        $this->_month = $month;
        return $this;
    }

    public function setDayOfWeek( $dayOfWeek )
    {
        $this->_dayOfWeek = $dayOfWeek;
        return $this;
    }

    /**
     * 获取本地文件的任务列表
     */
    public function getLocalList()
    {
        exec( $this->_cronBin . ' -l;' , $output , $retval );
        return $output;
    }

    /**
     * 任务写入文件
     */
    public function writeJobToFile( $content )
    {  
        if( !file_exists( $this->_tmpFile )
            ||
            !is_writable( $this->_tmpFile ) 
        )
        {
            return false;
        }
        exec( $this->_cronBin . ' -r;' );
        file_put_contents( $this->_tmpFile , $content , LOCK_EX );
        exec( sprintf( '%s %s;' , $this->_cronBin , $this->_tmpFile ) );
        return true;
    }

    /**
     * 清除所有任务
     */
    public function clear()
    {
        return $this->writeJobToFile('');
    }

    /**
     * 删除某个任务
     */
    public function remove( $jobId )
    {
        $allJobs = $this->getLocalList();
        foreach( $allJobs as $key => $job )
        {
            if( $key == $jobId ) {
                unset( $allJobs[$key] );
            }
        }

        $content = implode( "\n" , array_values( $allJobs ) ) . "\n";
        return $this->writeJobToFile( $content );
    }

    /**
     * 新增任务
     */
    public function addJob( $job )
    {
        $newJob = implode(
            ' ',
            [
                $this->_minute ,
                $this->_hour ,
                $this->_dayOfMonth ,
                $this->_month ,
                $this->_dayOfWeek ,
                $job
            ]
        );

        $content = implode( "\n" , array_merge( $this->getLocalList() , [ $newJob ] ) ) . "\n";
        return $this->writeJobToFile( $content );
    }

}

$cron = new crob;
$list = $cron->clear();
$rtn = $cron->setMinute( 5 )->addJob( 'ls >> /tmp/ls.log' );
$list = $cron->getLocalList();
var_dump( $list );