<?php
class Mdl_image extends CI_Model
{
    function __construct()
    {
        $this->table = array(
            'image' => 'tbl_image_file',
            'thumb' => 'tbl_image_thumbnail'
        );
    }

    function getList($params = array())
    {
        $this->db->start_cache();
        if (!empty($params['search']['value']))
        {
            $this->db->group_start()
                        ->like($this->table['image'].'.image_file_title',$params['search']['value'])
                    ->group_end();
        }
        $count_all = $this->db->count_all_results($this->table['image']);

        $this->db->stop_cache();

        if ($params['start'] == 0){
            $this->db->limit($params['length']);
        } else {
            $this->db->limit($params['length'], $params['start']);
        }
        $query = $this->db->get();
        $this->db->flush_cache();

        $data_request  = $query->result_array();
        $count_request = $query->num_rows();

        $data = array();

        $data['recordsTotal']       = $count_request;
        $data['recordsFiltered']    = $count_all;
        
        foreach($data_request as $row => $value)
        {
            $data_request[$row]['nomor'] = $row+1;

            $data_request[$row]['image_file_all'] = '<a class="label label-warning" href="">Show Ori</a><br>';

            $thumb = $this->db->select('image_thumbnail_name')->where('image_file_id',$value['image_file_id'])->get($this->table['thumb'])->result_array();
            if(!empty($thumb))
            {
                $data_request[$row]['image_thumb'] = '<img src="'.$thumb[0]['image_thumbnail_name'].'" width="100" height="100">';
                foreach($thumb as $row1 => $value1)
                {
                    $num = $row1+1;
                    $data_request[$row]['image_file_all'] .= '<a class="label label-warning" href="">Show Thumb '.$num.'</a><br>';
                }
            }
            else
            {
                $data_request[$row]['image_thumb'] = '<img src="#" width="100" height="100">';
            }

            $data_request[$row]['actions'] = '<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>';

        }
        $data['list'] = $data_request;
        return $data;
    }

    function getDetail($id = 0)
    {
        $data =  $this->db->join($this->table['image'],$this->table['image'].'.image_file_id ='.$this->table['thumb'].'.image_file_id','left')
        ->where('image_thumbnail_id',$id)
        ->get($this->table['thumb'])->row_array();

        $img = base_url('/images/').$data['image_file_title'].'/thumbnail/'.$data['image_thumbnail_name'];

        return $img;
    }

    function insertImageThumb($data=array())
    {
        $res = $this->db->set($data)->insert($this->table['thumb']);
        return $res;
    }

    function insertImage($data=array(), $data2=array())
    {
        $dataInput = array(
            'image_file_title' => $data['folder'],
            'update_by'        => $data['updateBy']
        );
        $res = $this->db->set($data)->insert($this->table['image']);
        $this->insertImageThumb($data2);

        return $res;
    }
    
}

?>