<?php
//判断显示时间
function showTime($time){
    if (strtotime($time) <= 0){
        return;
    }else{
        return $time;
    }
}

