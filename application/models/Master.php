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
	public $start;
	public $limit;
	public $order;
	public $dir;
	public $group;
	public $select;
	public $join;
	public $searchable;
	public $where;
	public $searchTerm;
	public $titnyIntTranslate = [];
    
    /**
     * Class Constructor
     * 
     */ 
    public function __construct(){
		$this->start = 0;
		$this->limit = 0;
		$this->order = '';
		$this->dir	 = 'asc';
		$this->group = '';
		$this->select['main_table'] = '*';
		$this->join = [];
		$this->searchable = [];
		$this->where = [];
		$this->searchTerm = '';
        parent::__construct();        
    }
    
    public function reset(){
		$this->start = 0;
		$this->limit = 0;
		$this->order = '';
		$this->dir	 = 'asc';
		$this->group = '';
		$this->select['main_table'] = '*';
		$this->join = [];
		$this->searchable = [];
		$this->where = [];
		$this->searchTerm = '';
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
    
    public function init(){
		$this->reset();
		return $this;
	}	
    
    public function setStart($start){
		$this->start = $start;
		return $this;
	}
	
    public function setLimit($limit){
		$this->limit = $limit;
		return $this;
	}
	
	public function setOrder($order){
		$this->order = $order;
		return $this;
	}
	
	public function setDirection($dir){
		$this->dir = $dir;
		return $this;
	} 
	
	public function setJoin($join){
		$this->join = $join;
		return $this;
	}
	
	public function setWhere($where){
		$this->where = $where;
		return $this;
	}
	
	public function setSearchable($serchable){
		$this->searchable = $serchable;
		return $this;
	}
	
	public function setGroup($group){
		$this->group = $group;
		return $this;
	}
	
	public function setSearchTerm($search){
		$this->searchTerm = $search;
		return $this;
	}
	
	public function setSelect($select){
		$this->select = $select;
		return $this;
	}	
    
	private function has_string_keys() {
		return count(array_filter(array_keys($this->select), 'is_string')) > 0;
	}
	
	private function buildQuery(){
		if($this->limit > 0)
			$this->db->limit($this->limit, $this->start);
		
		if($this->order!='')
			$this->db->order_by($this->order, $this->dir);
		
		if($this->group!='')
			$this->db->group_by($this->group);
		
		$selectString = '';
		
		if($this->select['main_table'] == '*'){
			$selectString = '*';
		}
		elseif($this->select['main_table'] == 'COUNT(*)'){
			$selectString = 'COUNT(*)';
		}	
		else{
			if($this->has_string_keys()){
				foreach ($this->select as $k=>$cols){
					foreach($cols as $ck => $col){
						$selectString .= $k.'.'.$ck.' as '.$col.',';
					}  		
				}
			}
			else{
				foreach ($this->select as $k=>$cols){
					foreach($cols as $ck => $col){
						$selectString .= $k.'.'.$ck.',';
					}  		
				}
			}
			
			$selectString = rtrim($selectString, ',');
			$selectString = str_replace('main_table', $this->table, $selectString);
								
		}	
		
		$this->db->select($selectString);
		$this->db->from($this->table);
		
		if(!empty($this->join)){
			

			foreach($this->join as $k=>$v){
				$c = 'id';
				if(isset($v['selfCloumn'])){
					$c = $v['selfCloumn'];	
				}	

				$table = $this->table;
				
				if(isset($v['joinTable'])){
					$table = $v['joinTable'];
				}

				$this->db->join($k, $k.'.'.$c.' = '.$table.'.'.$v['onCloumn'], $v['type']);
			}
		}
		
		
		if(!empty($this->searchable)){
			foreach($this->searchable as $field){

				$field = str_replace('main_table', $this->table, $field);
				
				$this->db->or_like($field,$this->searchTerm);
			}
		}
		
		if(!empty($this->where)){
			foreach($this->where as $field => $value){
				$this->db->where($field,  $value);
			}
		}
		
		return $this;
		
	}	
	
	private function count(){
		return $this->db->count_all_results();
	}
	
	private function result(){
		return $this->db->get()->result();
	}
	
	private function printQuery(){
		return $this->db->get_compiled_select();
	}		
	
	/**
     * Get total records
     * 
     * @return array
     */ 
    public function getCountJoin(){
		$this->select['main_table'] = 'COUNT(*)';
		
		return $this->buildQuery()->count();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getRecordsJoin(){
		return $this->buildQuery()->result();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecordsJoin(){
		return $this->buildQuery()->result();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecordCountJoin(){
		$this->select['main_table'] = 'COUNT(*)';
		return $this->buildQuery()->count();

	}
	
	/**
     * Get total records
     * 
     * @return array
     */ 
    public function getCount(){
		$this->select['main_table'] = 'COUNT(*)';
		return $this->buildQuery()->count();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getRecords(){
		return $this->buildQuery()->result();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecords(){
		return $this->buildQuery()->result();
	}
	
	/**
     * Get records
     * 
     * @return array
     */ 
	public function getFilteredRecordCount(){
		$this->select['main_table'] = 'COUNT(*)';
		return $this->buildQuery()->count();
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
     * Get all records
     * 
     * @return array
     */ 
	public function getAllRecords($where=[]){
		$this->db->select(); 
		$this->db->from($this->table);
		if(!empty($where)){
			$this->db->where($where);	
		}	
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
     * update field value
     * @param string $field
     * @param mix $value
     * 
     * @return array
     */
	public function updateFieldsByValue($id, $fields)
    {   
        $this->db->where($this->primaryKeyField, $id);
        $this->db->update($this->table, $fields); 
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to update '.$field.' of '.$this->table.' for id '.$id);
            return false;
        }        
        return true;
    }
    
    /**
     * Get all records
     * 
     * @return array
     */ 
	public function getAllPagedRecords($where=[],$page=0,$perpage=10){
		$this->db->select(); 
		$this->db->from($this->table);
		if(!empty($where)){
			$this->db->where($where);	
		}
		$start=$page*$perpage;
        $this->db->limit($perpage,$start);	
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
     * Get all records
     * 
     * @return array
     */ 
	public function getAllRecordCount($where=[]){
		 
		$this->db->from($this->table);
		if(!empty($where)){
			$this->db->where($where);	
		}
		
		$count = $this->db->count_all_results();
		return $count;
	}
}
