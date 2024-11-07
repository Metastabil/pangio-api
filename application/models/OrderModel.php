<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Julius Derigs <info@pangio.de>
 * @version 1.0.0
 */

class OrderModel extends CI_Model {
	/**
	 * @var string
	 */
	private string $table = 'orders';

	/**
	 * @param int $id
	 * @param int $user_id
	 * @param bool $with_deleted
	 * @return array
	 */
	public function get(int $id = 0, int $user_id = 0, bool $with_deleted = false) :array {
		$select = 'id, user_id, paid, delivered, deleted, created_at, updated_at, username';

		$this->db->select($select)
				 ->from('v_orders');

		if ($id > 0) {
			$this->db->where('id', $id);
		}

		if ($user_id > 0) {
			$this->db->where('user_id', $user_id);
		}

		if (!$with_deleted) {
			$this->db->where('deleted', 0);
		}

		$result = $this->db->order_by('created_at', 'desc')
						   ->get()
						   ->result_array();

		return !empty($result) && $id > 0 ? $result[0] : $result;
	}

	/**
	 * @param array $data
	 * @return bool
	 */
	public function create(array $data) :bool {
		return $this->db->insert($this->table, $data);
	}

	/**
	 * @param int $id
	 * @param array $data
	 * @return bool
	 */
	public function update(int $id, array $data) :bool {
		return $this->db->where('id', $id)
						->update($this->table, $data);
	}
}
