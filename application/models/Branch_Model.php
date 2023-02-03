<?php 
    class Branch_Model extends CI_Model{
        public $tableName = "branch";
    public function __construct()
    {
        parent::__construct();
    }
    public function get($where = array())
    {
            $result= $this->db
            ->where($where)
            ->get("Branch")->row();
            return $result;
    }
    public function get_all($where = array())
    {
            $result= $this->db
            ->where($where)
            ->get("Branch")->result();
            return $result;
    }
    public function query($query)
    {
            $result= $this->db
            ->query($query);
            return $result;
    }
    public function query2()    // deneme
    {
            $result= $this->db
            ->query("CALL GetBranches();");
            return $result;
    }
    public function get_districts($city_id)     ///     There may be a branch in more than one county, but it becomes duplicate
    {
        $result = $this->db
        ->where(array(
                "Branch_ID=" => $city_id
        ))
        ->get("Branch")->result();
        return $result;
    }
    public function get_info($city_name="")     ///     There may be a branch in more than one county, but it becomes duplicate
    {
        $result = $this->db
        ->where(array(
                "City=" => $city_name
        ))
        ->get("Branch")->result();
        return $result;
    }
    public function update_city($city, $where)
    {
        return $this->db->update($this->tableName, $city, $where);
    }
    public function update_district($district, $where)
    {
        return $this->db->update($this->tableName, $district, $where);
    }
    public function update_address($address, $where)
    {
        return $this->db->update($this->tableName, $address, $where);
    }
    public function update_branch_name($name, $where)
    {
        return $this->db->update($this->tableName, $name, $where);
    }
    public function last_item()
    {
        $query = "SELECT {$this->tableName}.Branch_ID FROM {$this->tableName}
        ORDER BY {$this->tableName}.Branch_ID DESC 
        LIMIT 1";
        return  $this->db->query($query)->row();
    }
    public function add_Branch($data = array())
    {
        return $this->db->insert($this->tableName,$data);
    }
    public function check_query($where = array())
    {
        $query = $this->db->get_where($this->tableName, $where);
        return $query->row();
    }
}

;
