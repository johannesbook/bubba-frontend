<?php
function to_ordinal($number) {
    switch(abs((int)$number) % 10) {
    case 1:
        $suffix = "st";
        break;
    case 2:
        $suffix = "nd";
        break;
    case 3:
        $suffix = "rd";
        break;
    default:
        $suffix = "th";
        break;
    }
    return "$number$suffix";
}
