<?php
class Reviews extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->model('Reviews_model', 'review');
		$this->load->library('session');
		if (!$this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
		if ($this->input->get('success')) {
			$this->data['success'] = $this->input->get('success');
		}
	}

	public function index() {
		$this->data['rec'] = $this->review->get_review();
		$this->data['title'] = 'Manage Review';
		$this->load->view('review', $this->data);
	}
	public function provider() {
		$this->data['rec'] = $this->review->get_provider_reviews();
		$this->data['title'] = 'Provider User Review';
		$this->load->view('provider_review', $this->data);
	}

	public function status_update() {
		if ($this->input->post()) {
			$id = $this->input->post('id');
			date_default_timezone_set('Egypt');
			$data = array(
				'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$result = $this->review->status_update($data, $id);
			if ($result) {
				redirect(base_url('reviews?success=status updated successfully!'));
			}
		}
	}
	public function provider_status_update() {
		if ($this->input->post()) {
			$id = $this->input->post('id');
			date_default_timezone_set('Egypt');
			$data = array(
				'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$result = $this->review->status_update($data, $id);
			if ($result) {
				redirect(base_url('reviews/provider?success=status updated successfully!'));
			}
		}
	}

	public function approve($id) {

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.clubenz.com';
		$config['smtp_crypto'] = 'tls';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'support@clubenz.com';
		$config['smtp_pass'] = 'Support@2020';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$to = $this->review->get_email($id);
		$name = $this->review->get_name($id);
		$this->email->initialize($config);
		$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
		$this->email->to($to);
		$this->email->subject('Review Request Clubenz');
		$this->email->message(
			'Dear ' . $name .
			'<br> Thank you for your valuable feedback, please note that your review has been added and now it can be seen by others. <br>
			شكراً لوقتك، برجاء العلم انه قد تم اضافة تقييمك، و سيراه الآخرين للأستفادة من تجربتك');
		if ($this->email->send()) {
			$this->review->approve_part($id);
			date_default_timezone_set('Egypt');
			$data = array(
				// 'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$this->review->status_update($data, $id);
			redirect(base_url('reviews/provider?success=updated  successfully!'));
		} else {
			show_error($this->email->print_debugger());
			return false;
			$this->review->approve_part($id);
			redirect(base_url('reviews/provider?error=error!'));
		}

	}
	public function reject($id) {

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.clubenz.com';
		$config['smtp_crypto'] = 'tls';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'support@clubenz.com';
		$config['smtp_pass'] = 'Support@2020';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$to = $this->review->get_email($id);
		$name = $this->review->get_name($id);

		$this->email->initialize($config);
		$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
		$this->email->to($to);
		$this->email->subject('Review Request Clubenz');
		$this->email->message('Dear ' . $name . '<br> Thank you for your feedback, we have reviewed your message, unfortunately، the content of your message may not be aligned to CluBenz review terms and rules. <br> Your voice matters, to re-enter your feedback please go to link to the app provider page <br>
			شكراً لوقتك، برجاء العلم انه قد تمت مراجعة تقييمك، و قد ترأى لنا انه لا يتناسب مع سياسات التقييم الخاصة  بنا.. ');
		if ($this->email->send()) {
			$this->review->reject_part($id);
			date_default_timezone_set('Egypt');
			$data = array(
				// 'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$this->review->status_update($data, $id);
			redirect(base_url('reviews/provider?success=updated  successfully!'));
		} else {
			show_error($this->email->print_debugger());
			return false;
			$this->review->reject_part($id);
			date_default_timezone_set('Egypt');
			$data = array(
				// 'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$this->review->status_update($data, $id);
			redirect(base_url('reviews/provider?error=error!'));
		}
	}

	public function status_approve($id) {

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.clubenz.com';
		$config['smtp_crypto'] = 'tls';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'support@clubenz.com';
		$config['smtp_pass'] = 'Support@2020';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$to = $this->review->get_email($id);
		$name = $this->review->get_name($id);
		$this->email->initialize($config);
		$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
		$this->email->to($to);
		$this->email->subject('Review Request Clubenz');
		$this->email->message(
			'Dear ' . $name .
			'<br> Thank you for your valuable feedback, please note that your review has been added and now it can be seen by others. <br>
			شكراً لوقتك، برجاء العلم انه قد تم اضافة تقييمك، و سيراه الآخرين للأستفادة من تجربتك');
		if ($this->email->send()) {
			$this->review->approve_part($id);
			date_default_timezone_set('Egypt');
			$data = array(
				// 'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$this->review->status_update($data, $id);
			redirect(base_url('reviews?success=updated  successfully!'));
		} else {
			show_error($this->email->print_debugger());
			return false;
			$this->review->approve_part($id);
			redirect(base_url('reviews?error=error!'));
		}

	}
	public function status_reject($id) {

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.clubenz.com';
		$config['smtp_crypto'] = 'tls';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'support@clubenz.com';
		$config['smtp_pass'] = 'Support@2020';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$to = $this->review->get_email($id);
		$name = $this->review->get_name($id);

		$this->email->initialize($config);
		$this->email->from('support@clubenz.com', 'Clubenz--NoReply');
		$this->email->to($to);
		$this->email->subject('Review Request Clubenz');
		$this->email->message('Dear ' . $name . '<br> Thank you for your feedback, we have reviewed your message, unfortunately، the content of your message may not be aligned to CluBenz review terms and rules. <br> Your voice matters, to re-enter your feedback please go to link to the app provider page <br>
			شكراً لوقتك، برجاء العلم انه قد تمت مراجعة تقييمك، و قد ترأى لنا انه لا يتناسب مع سياسات التقييم الخاصة  بنا.. ');
		if ($this->email->send()) {
			$this->review->reject_part($id);
			date_default_timezone_set('Egypt');
			$data = array(
				// 'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$this->review->status_update($data, $id);
			redirect(base_url('reviews?success=updated  successfully!'));
		} else {
			show_error($this->email->print_debugger());
			return false;
			$this->review->reject_part($id);
			date_default_timezone_set('Egypt');
			$data = array(
				// 'status' => $this->input->post('status'),
				"updated_by" => $this->ion_auth->user()->row()->id,
				"date_updated" => date("Y-m-d H:i"),
			);
			$this->review->status_update($data, $id);
			redirect(base_url('reviews?error=error!'));
		}
	}

}
?>
