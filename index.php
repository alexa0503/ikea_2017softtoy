<?php
if( isset($_GET) && !empty($_GET) )
    Header("Location:public/?".http_build_query($_GET));
else
    Header("Location:public/");