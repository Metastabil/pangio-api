<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Julius Derigs <info@pangio.de>
 * @version 1.0.0
 */

class UserGroupAssociationModel extends CI_Model {
	/**
	 * @var string
	 */
	private string $table = 'user_group_associations';

	/**
	 * @param int $id
	 * @param int $user_id
	 * @param int $group_id
	 * @return array
	 */
	public function get(int $id = 0, int $user_id = 0, int $group_id = 0) :array {
		$select = 'id, user_id, dealer_group_id';

		$this->db->select($select)
			->from($this->table);

		if ($id > 0) {
			$this->db->where('id', $id);
		}

		if ($user_id > 0) {
			$this->db->where('user_id', $user_id);
		}

		if ($group_id > 0) {
			$this->db->where('group_id', $group_id);
		}

		$result = $this->db->get()
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
