<?php
class Mdl_sizeImage extends CI_Model
{
    function __construct()
    {
        $this->table = array(
            'sizeImage' => 'tbl_size_thumbnail',
            'thumb' => 'tbl_image_thumbnail'
        );
    }

    function getList($params = array())
    {
        $data = $this->db->get($this->table['sizeImage'])->result();
        return $data;
    }
}

?>