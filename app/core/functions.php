<?php

// function  to show out my code to the home screen
function show($stuffs)
{

    echo "<pre>";
    print_r($stuffs);
    echo "</pre>";
}


// function  to escape non-html characters to
//prevent sql injections


function esc($str)
{

    return htmlspecialchars($str);
}
