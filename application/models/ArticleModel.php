<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Julius Derigs <info@pangio.de>
 * @version 1.0.0
 */

class ArticleModel extends CI_Model {
	/**
	 * @var string
	 */
	private string $table = 'articles';

	/**
	 * @param int $id
	 * @param string $name
	 * @param bool $with_unavailable
	 * @param bool $with_deleted
	 * @return array
	 */
	public function get(int $id = 0, string $name = '', bool $with_unavailable = true, bool $with_deleted = false) :array {
		$select = 'id, name, description, price, unavailable, deleted, created_at, updated_at';

		$this->db->select($select)
				 ->from($this->table);

		if ($id > 0) {
			$this->db->where('id', $id);
		}

		if (!empty($name)) {
			$this->db->where('name', $name);
		}

		if (!$with_unavailable) {
			$this->db->where('unavailable', 0);
		}

		if (!$with_deleted) {
			$this->db->where('deleted', 0);
		}

		$result = $this->db->order_by('name', 'desc')
						   ->get()
						   ->result_array();

		return !empty($result) && ($id > 0 || !empty($name)) ? $result[0] : $result;
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
