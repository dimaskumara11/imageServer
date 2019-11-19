<?php
function cekAPIKEY($apiKey="")
{
    if($apiKey == "dimaskumara")
    {
        return TRUE;
    }
    else
    {
        return FALSE;
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