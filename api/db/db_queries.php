<?php

//Query to save call back request
$get_call_back = "INSERT INTO
        user_query (
        uq_user_full_name, 
        uq_user_number, 
        uq_user_exp_heads, 
        uq_user_event_type, 
        uq_user_event_location, 
        uq_user_event_date) 
        VALUES 
        (?, ?, ?, ?, ?, ?)";
