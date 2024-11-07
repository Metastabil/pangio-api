<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Julius Derigs <info@pangio.de>
 * @version 1.0.0
 */

class CartElementModel extends CI_Model {
	/**
	 * @var string
	 */
	private string $table = 'cart_elements';

	/**
	 * @param int $id
	 * @param int $cart_id
	 * @param int $article_id
	 * @param bool $with_deleted
	 * @return array
	 */
	public function get(int $id = 0, int $cart_id = 0, int $article_id = 0, bool $with_deleted = false) :array {
		$select = 'id, article_id, cart_id, amount, deleted, created_at, updated_at';

		$this->db->select($select)
				 ->from($this->table);

		if ($id > 0) {
			$this->db->where('id', $id);
		}

		if ($cart_id > 0) {
			$this->db->where('cart_id', $cart_id);
		}

		if ($article_id > 0) {
			$this->db->where('article_id', $article_id);
		}

		if (!$with_deleted) {
			$this->db->where('deleted', 0);
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
