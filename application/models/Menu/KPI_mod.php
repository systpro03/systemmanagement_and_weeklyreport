<?php 
class KPI_mod extends CI_Model
{
	function __construct() {
		parent::__construct();
	}



    public function getKpiGroupedByType()
    {
        $this->db->order_by('type', 'ASC');
        $query = $this->db->get('kpi');

        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->type][] = $row;
        }

        return $result;
    }

}