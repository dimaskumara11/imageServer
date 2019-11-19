<?php
function cekAPIKEY($apiKey="")
{
    if($apiKey == "dimaskumara")
    {
        return 2;
    }
    else
    {
        return 0;
    }
}

// function cekToken($params=array())
// {
//     $ci =& get_instance();
//     $sign = md5($params['username'].$password['password']);

//     $sessi_token = $ci->session->userdata($sign);
//     if(empty($sessi_token))
//     {

//     }
// }

?>