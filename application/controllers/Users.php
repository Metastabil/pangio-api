<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Julius Derigs <info@pangio.de>
 * @version 1.0.0
 *
 * @property UserModel $UserModel
 */

class Users extends CI_Controller {
	/**
	 * @return void
	 */
	public function get() :void {
		if (is_post()) {
			$request = to_array(file_get_contents('php://input'));

			if (empty($request['token'])) {
				$this->output
					->set_status_header(401)
					->set_content_type('application/json')
					->set_output(to_json(['status' => '401', 'message' => 'Authentication token is missing.']));

				return;
			}

			if (!authenticate_token((string)$request['token'])) {
				$this->output
					->set_status_header(401)
					->set_content_type('application/json')
					->set_output(to_json(['status' => '401', 'message' => 'Invalid authentication token.']));

				return;
			}

			$id = empty($request['id']) ? 0 : (int)$request['id'];
			$username = empty($request['username']) ? '' : (string)$request['username'];
			$with_deleted = !empty($request['with_deleted']);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(to_json($this->UserModel->get($id, $username, $with_deleted)));
		}
		else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json')
				->set_output(to_json(['status' => '401', 'message' => 'Method Not Allowed. Please use POST.']));
		}
	}

	/**
	 * @return void
	 */
	public function create() :void {
		if (is_post()) {
			$request = to_array(file_get_contents('php://input'));

			if (empty($request['token'])) {
				$this->output
					 ->set_status_header(401)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '401', 'message' => 'Authentication token is missing.']));

				return;
			}

			if (!authenticate_token((string)$request['token'])) {
				$this->output
					 ->set_status_header(401)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '401', 'message' => 'Invalid authentication token.']));

				return;
			}

			if (empty($request['username'])) {
				$this->output
					 ->set_status_header(400)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '400', 'message' => 'Username is missing.']));

				return;
			}

			if (empty($request['password'])) {
				$this->output
					 ->set_status_header(400)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '400', 'message' => 'Password is missing.']));

				return;
			}

			$data = [
				'username' => $request['username'],
				'password' => password_hash($request['password'], PASSWORD_DEFAULT)
			];

			if ($this->UserModel->create($data)) {
				$this->output
					->set_status_header(200)
					->set_content_type('application/json')
					->set_output(to_json(['status' => '200', 'message' => 'Element ID: ' . $this->db->insert_id()]));
			}
			else {
				$this->output
					 ->set_status_header(500)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '500', 'message' => 'Unable to process request.']));
			}
		}
		else {
			$this->output
				 ->set_status_header(405)
				 ->set_content_type('application/json')
				 ->set_output(to_json(['status' => '401', 'message' => 'Method Not Allowed. Please use POST.']));
		}
	}

	/**
	 * @return void
	 */
	public function update() :void {
		if (is_post()) {
			$request = to_array(file_get_contents('php://input'));

			if (empty($request['token'])) {
				$this->output
					 ->set_status_header(401)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '401', 'message' => 'Authentication token is missing.']));

				return;
			}

			if (!authenticate_token((string)$request['token'])) {
				$this->output
					 ->set_status_header(401)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '401', 'message' => 'Invalid authentication token.']));

				return;
			}

			if (empty((int)$request['id'])) {
				$this->output
					 ->set_status_header(400)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '400', 'message' => 'ID is missing.']));

				return;
			}

			$data = [];

			if (!empty($request['username'])) {
				$data['username'] = $request['username'];
			}

			if (!empty($request['password'])) {
				$data['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
			}

			if ($this->UserModel->update((int)$request['id'], $data)) {
				$this->output
					 ->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '200', 'message' => 'User updated.']));
			}
			else {
				$this->output
					 ->set_status_header(500)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '500', 'message' => 'Unable to process request.']));
			}
		}
		else {
			$this->output
				 ->set_status_header(405)
				 ->set_content_type('application/json')
				 ->set_output(to_json(['status' => '401', 'message' => 'Method Not Allowed. Please use POST.']));
		}
	}

	/**
	 * @return void
	 */
	public function delete() :void {
		if (is_post()) {
			$request = to_array(file_get_contents('php://input'));

			if (empty($request['token'])) {
				$this->output
					 ->set_status_header(401)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '401', 'message' => 'Authentication token is missing.']));

				return;
			}

			if (!authenticate_token((string)$request['token'])) {
				$this->output
					 ->set_status_header(401)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '401', 'message' => 'Invalid authentication token.']));

				return;
			}

			if (empty((int)$request['id'])) {
				$this->output
					 ->set_status_header(400)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '400', 'message' => 'ID is missing.']));

				return;
			}

			if ($this->UserModel->update((int)$request['id'], ['deleted' => 1])) {
				$this->output
					 ->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '200', 'message' => 'User deleted.']));
			}
			else {
				$this->output
					 ->set_status_header(500)
					 ->set_content_type('application/json')
					 ->set_output(to_json(['status' => '500', 'message' => 'Unable to process request.']));
			}
		}
		else {
			$this->output
				 ->set_status_header(405)
				 ->set_content_type('application/json')
				 ->set_output(to_json(['status' => '401', 'message' => 'Method Not Allowed. Please use POST.']));
		}
	}
}
