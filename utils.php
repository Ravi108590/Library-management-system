<?php

function overDaysFinder($returned, $days_remaining) {
    if(!$returned) {
        if($days_remaining<0) {
            return abs($days_remaining);
        } else {
            return "-";
        }
    } else {
        return "-";
    }
}

function fine($returned, $days_remaining, $user_type) {
    
    if($user_type == "teacher") {
        return 0;
    }
    if(!$returned) {
        if($days_remaining<0) {
            return abs($days_remaining)*5;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function isLate($days_remaining) {
    if($days_remaining<0) {
        echo ' <span class="badge bg-primary">Late</span>';
    }
    return;
}