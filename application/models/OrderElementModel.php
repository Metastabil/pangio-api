<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Julius Derigs <info@pangio.de>
 * @version 1.0.0
 */

class OrderElementModel extends CI_Model {
	/**
	 * @var string
	 */
	private string $table = 'order_elements';

	/**
	 * @param int $id
	 * @param int $article_id
	 * @param int $order_id
	 * @param int $user_id
	 * @param bool $with_deleted
	 * @return array
	 */
	public function get(int $id = 0, int $article_id = 0, int $order_id = 0, int $user_id = 0, bool $with_deleted = false) :array {
		$select = 'id, article_id, order_id, amount, price, deleted, created_at, updated_at, article_name,
				   article_group_name, paid, delivered, username';

		$this->db->select($select)
				 ->from('v_order_elements');

		if ($id > 0) {
			$this->db->where('id', $id);
		}

		if ($article_id > 0) {
			$this->db->where('article_id', $article_id);
		}

		if ($order_id > 0) {
			$this->db->where('order_id', $order_id);
		}

		if ($user_id > 0) {
			$this->db->where('user_id', $user_id);
		}

		if (!$with_deleted) {
			$this->db->where('deleted', 0);
		}

		$result = $this->db->get()
						   ->result_array();

		return !empty($result) && ($id > 0) ? $result[0] : $result;
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
