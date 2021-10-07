<?php
class Master extends CI_Model {
	
	/**
	 * Table name 
	 */
	protected $table;
	
	
    /**
	 * Entity Id 
	 */
	public $primaryKeyField;
    
    /**
     * Class Constructor
     * 
     */ 
    public function __construct(){
        parent::__construct();        
    }
    
    /**
     * Get total records
     * 
     * @return array
     */ 
    public function getCount(){
		return $this->db->count_all($this->table);
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getRecords($start, $limit, $order, $dir, $group=''){
		$this->db->limit($limit, $start)->order_by($order, $dir);
		if($group!='')
			$this->db->group_by($group);
		
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecords($start, $limit, $order, $dir, $search, $searchableFields, $where=[]){
		
		$this->db->limit($limit, $start);
		$this->db->order_by($order, $dir);
		
		if(count($searchableFields)){
			foreach($searchableFields as $field){
				$this->db->or_like($field,$search);
			}
		}
		
		if(!empty($where)){
			$query = $this->db->get_where($this->table, $where, 1);
		}
		else{
			$query = $this->db->get_where($this->table);
		}	
		

        if($this->db->affected_rows() > 0){
            return $query->result();

        }else{
            error_log('no record found in '.$this->table.' for '.$field.' -'.$value);
            return false;
        }
		
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecordCount($search, $searchableFields, $where=[]){
		
		if(count($searchableFields)){
			$this->db->group_start();
			foreach($searchableFields as $field){
				$this->db->or_like($field,$search);
			}
			$this->db->group_end();
		}
		
		if(!empty($where)){
			$this->db->where($where);
		}

        if($this->db->affected_rows() > 0){
           return $this->db->count_all_results($this->table);

        }else{
            error_log('no record found in '.$this->table.' for '.$field.' -'.$value);
            return false;
        }

	}
	
	/**
     * Get total records
     * 
     * @return array
     */ 
    public function getCountJoin($join){
		$this->db->select('COUNT(*) as count');
		$this->db->from($this->table);
		foreach($join as $k=>$v){
			$this->db->join($k, $k.'.id = '.$this->table.'.'.$v['onCloumn'], $v['type']);
		}
		$query = $this->db->get();
		//print_r($this->db->last_query());exit;
		return $query->row()->count;
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getRecordsJoin($join, $select, $start='', $limit='', $order='', $dir='asc', $where=[]){
		if($start!='' && $limit!='')
		$this->db->limit($limit, $start);
		
		if($order!='')
		$this->db->order_by($order, $dir);
		
		$selectString = '';
		$i=0;
		foreach ($select as $k=>$cols){
			
			foreach($cols as $ck => $col){
				if($col=='*'){
					$selectString .= $k.'.'.$col.',';
				}
				else{
					$selectString .= $k.'.'.$ck.' as '.$col.',';
				}	
			}  		
		}
		
		$selectString = rtrim($selectString, ',');
		
		$selectString = str_replace('main_table', $this->table, $selectString);
		
		$this->db->select($selectString);
		
		$this->db->from($this->table);
		
		if(!empty($where)){
			$this->db->where($where);
		}
		
		foreach($join as $k=>$v){
			if(isset($v['other_join_column'])){
				$this->db->join($k, $k.'.'.$v['other_join_column'].' = '.$this->table.'.'.$v['onCloumn'], $v['type']);
			}
			else{	
				$this->db->join($k, $k.'.id = '.$this->table.'.'.$v['onCloumn'], $v['type']);
			}
		}
		
		$query = $this->db->get()->result();
		//print_r($this->db->last_query());exit;
		
		return $query;
		
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecordsJoin($join, $select, $start, $limit, $order, $dir, $search, $searchableFields, $where=[]){
		
		
		$this->db->limit($limit, $start);
		$this->db->order_by($order, $dir);
		
		$selectString = '';
		$i=0;
		foreach ($select as $k=>$cols){
			foreach($cols as $ck => $col){
				$selectString .= $k.'.'.$ck.' as '.$col.',';
			}  		
		}
		
		$selectString = rtrim($selectString, ',');
		$selectString = str_replace('main_table', $this->table, 	$selectString);
		
		$this->db->select($selectString);
		
		
		foreach($join as $k=>$v){
			$this->db->join($k, $k.'.id = '.$this->table.'.'.$v['onCloumn'], $v['type']);
		}
		
		if(count($searchableFields)){
			foreach($searchableFields as $field){
				$this->db->or_like($field,$search);
			}
		}
		
		if(!empty($where)){
			$query = $this->db->get_where($this->table, $where, 1);
		}
		else{
			$query = $this->db->get_where($this->table);
		}	
		
		
		
        return $this->db->get()->result();
		
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecordCountJoin($join, $search, $searchableFields, $where=[]){
		
		if(count($searchableFields)){
			$this->db->group_start();
			foreach($searchableFields as $field){
				$this->db->or_like($field,$search);
			}
			$this->db->group_end();
		}
		
		if(!empty($where)){
			$this->db->where($where);
		}

        if($this->db->affected_rows() > 0){
           return $this->db->count_all_results($this->table);

        }else{
            error_log('no record found in '.$this->table.' for '.$field.' -'.$value);
            return false;
        }

	}
	
	/**
     * Get all records
     * 
     * @return array
     */ 
	public function getAllRecords(){
		$this->db->select(); 
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
     * Get all records
     * 
     * @return array
     */ 
	public function getRecordsByCondition($where=[], $order='', $dir='asc'){
		if($order==''){
			$order = $this->primaryKeyField;	
		}	
		$this->db->order_by($order, $dir);
		if(!empty($where)){
			$query = $this->db->get_where($this->table, $where);
		}
		else{
			$query = $this->db->get_where($this->table);
		}	
		

        if($this->db->affected_rows() > 0){
            return $query->result();

        }else{
            error_log('no record found in '.$this->table);
            return false;
        }
	}
	
	/**
     * Get records by id
     * 
     * @return array
     */
	public function getRecordById($id){
		$q = $this->db->get_where($this->table, array($this->primaryKeyField => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no record found in '.$this->table.' for entity id -'.$id);
            return false;
        }
	}
	
	/**
     * Insert data
     * 
     * @return array
     */
	public function insert($data)
    {  
		$q = $this->db->insert_string($this->table,$data);             
		$this->db->query($q);
		return $this->db->insert_id();
    }
    
    /**
     * Check is duplicate
     * 
     * @return array
     */
    public function isDuplicate($data)
    {     
        $this->db->get_where($this->table, $data, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }			    
    
    /**
     * Get records by field and value
     * @param string $field
     * @param mix $value
     * 
     * @return array
     */
	public function getRecordByField($field, $value){
		$q = $this->db->get_where($this->table, array($field => $value), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no record found in '.$this->table.' for '.$field.' -'.$value);
            return false;
        }
	}
	
	/**
     * update field value
     * @param string $field
     * @param mix $value
     * 
     * @return array
     */
	public function updateFieldByValue($id, $field, $value)
    {   
        $this->db->where($this->primaryKeyField, $id);
        $this->db->update($this->table, array($field => $value)); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to update '.$field.' of '.$this->table.' for id '.$id);
            return false;
        }        
        return true;
    }
    
    /**
     * update field value
     * @param int $id
     * @param array $data
     * 
     * @return array
     */
    public function update($id, $data)
    {   
        $this->db->where($this->primaryKeyField, $id);
        $this->db->update($this->table, $data); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to update '.$this->table.' for id '.$id);
            return false;
        }        
        return true;
    }
    
    
    
}
