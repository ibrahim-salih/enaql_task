<?php

// active in side bar 
function is_active($page){
    return $page == Request::segment(2) ? 'active' : '';
}