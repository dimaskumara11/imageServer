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

            $thumb = $this->db->select('image_thumbnail_size,image_file_id')->where('image_file_id',$value['image_file_id'])->get($this->table['thumb'])->row_array();
            if(!empty($thumb))
            {
                $data_request[$row]['image_file_all']   = '<a target="_blank" href="'.base_url('image/show/showImage/').$value['image_file_id'].'" class="label label-warning" href="">Show Ori</a><br>';
                $data_request[$row]['image_thumb']      = '<img src="'.base_url('MyImage/show/').'ori/img'.$value['image_file_id'].'.jpg" width="100" height="100">';
            }
            else
            {
                $data_request[$row]['image_file_all'] = '<img src="#" width="100" height="100">';
            }

            $data_request[$row]['actions'] = '<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>';

        }
        $data['list'] = $data_request;
        return $data;
    }

    function getDetail($size="", $id = "")
    {
        $data =  $this->db->join($this->table['image'],$this->table['image'].'.image_file_id ='.$this->table['thumb'].'.image_file_id','left')
        ->where($this->table['thumb'].'.image_file_id',$id)
        ->where('image_thumbnail_size',$size)
        ->get($this->table['thumb'])->row_array();

        if($size != "ori")
        {
            $fileName = $data['image_file_name'];
            $fileName = explode('.',$fileName);
            $data['image_file_name'] = $fileName[0].'_thumb.'.$fileName[1];
        }

        $img = base_url("/images/").$data['image_file_title']."/$size/".$data['image_file_name'];
        return $img;
    }

    function getThumbImage($id = "")
    {
        $data =  $this->db->join($this->table['image'],$this->table['image'].'.image_file_id ='.$this->table['thumb'].'.image_file_id','left')
        ->where($this->table['thumb'].'.image_file_id',$id)
        ->get($this->table['thumb'])->result();
        
        $dataCache = array();
        foreach($data as $key => $val)
        {
            $dataCache[$val->image_file_id][$val->image_thumbnail_size] = "/$val->image_file_title/".$val->image_thumbnail_size.'/'.$val->image_file_name;
        }
        
        $res = array(
            'id' => $val->image_file_id,
            'data' => $dataCache
        );
        return $res;
    }

    function insertImageThumb($data=array(),$data2="")
    {
        $cekImageID = $this->db->where(array(
            'image_file_name' => $data2
        ))->get($this->table['image'])->row_array();

        $cekImage = array(
            'image_file_id' => empty($cekImageID['image_file_id'])?0:$cekImageID['image_file_id']
        );

        $data = array_merge($cekImage,$data);
        $res = $this->db->set($data)->insert($this->table['thumb']);

        return empty($cekImageID['image_file_id'])?0:$cekImageID['image_file_id'];
    }

    function insertImage($data=array(), $data2=array())
    {
        $dataInput = array(
            'image_file_title'  => $data['folder'],
            'image_file_name'   => $data['name'],
            'updated_by'        => $data['updateBy']
        );
        $insertImageFile    = $this->db->set($dataInput)->insert($this->table['image']);
        $insertThumb        = $this->insertImageThumb($data2,$data['name']);

        return $insertThumb;
    }

    function showImageAll($id)
    {
        $res = $this->db->where(array('image_file_id'=>$id))->order_by('image_thumbnail_id','asc')->get($this->table['thumb'])->result();
        $data = array();
        foreach($res as $key => $val):
            $img = $this->getDetail($val->image_thumbnail_size, $val->image_file_id);
            $data[] = array('img'=>$img);
        endforeach;
        return $data;
    }
    
}

?>