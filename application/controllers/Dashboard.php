<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Workshop_model', 'workshop');
		$this->load->model('Users_model', 'user');
		$this->load->model('Serviceshop_model', 'serviceshop');
		$this->load->model('Partsshop_model', 'partshop');
		$this->load->model('Car_model', 'classes');
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		if (!$this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}
		if ($this->input->get('error')) {
			$this->data['error'] = $this->input->get('error');
		}
	}
	public function index() {
		ini_set('display_errors', 1);
		error_reporting(1);
		$this->data['serviceshop'] = $this->serviceshop->total_serviceshop();
		$this->data['workshop'] = $this->workshop->total_workshop();
		$this->data['partshop'] = $this->partshop->total_partshop();
		$this->data['chassis'] = $this->user->get_allusers_chassis();
		$this->data['classes'] = $this->user->get_allclasses();
		$this->data['classes'] = $this->classes->get_classes();
		$this->data['title'] = 'Dashboard';
		/*$this->data['count_user_x'] = 0;
			$this->data['ios_user'] = 0;
			$this->data['android_user'] = 0;*/

		$group_id = $this->ion_auth->get_users_groups()->result();
		if ($group_id[0]->name == 'Part_Providers') {
			redirect(base_url('part/'));
		} else {
			$this->load->view('dashboard', $this->data);
		}

	}

	public function user_by_chassis() {
		$date = $this->input->post('date');
		$datef = $this->input->post('datef');
		$chassis = $this->input->post('chassis');
		if ($datef) {
			$earlier = new DateTime($date);
			$later = new DateTime($datef);
			$diff = $later->diff($earlier)->format("%a");
			if ($diff > 365 || $diff == $datef) {
				redirect(base_url('dashboard/?error=NOTE SELECT MORE THEN YEAR'));
			}
			$ldate = $date;
			$begin = new DateTime($date);
			$end = new DateTime($datef);
			$end = $end->modify('+1 day');
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval, $end);
			$month = array();
			foreach ($daterange as $value) {
				$dt = $value->format('Y-m-d');
				$st = date('Y-m-01', strtotime($dt));
				$lt = date('Y-m-t', strtotime($dt));
				if ($ldate < $lt) {
					$sdat = date('Y-m-01', strtotime($dt));
					$endat = date('Y-m-t', strtotime($dt));
					$user_by_chassis[] = $this->user->get_users_by_chassis_month($sdat, $endat, $chassis);
				}
				$month[] = $value->format('M');
				$gt_date[] = $date;
				$ldate = $lt;
			}
			foreach ($user_by_chassis as $i) {

				$tt[] = $i[0]->total;
			}

			$this->data['count_user_x'] = json_encode(array_values(array_unique($month)));

			$this->data['chassis_users'] = json_encode($tt);
			echo $this->load->view('ajx_chassis_chart', $this->data, true);
		} else {
			$week_start = date("Y-m-d", strtotime('monday this week', strtotime($date)));
			$ldate = $week_start;
			$begin = new DateTime($week_start);
			$end = new DateTime($ldate);
			$end = $end->modify('+7 day');
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval, $end);
			foreach ($daterange as $value) {
				$date = $value->format('Y-m-d');
				$user_by_chassis[] = $this->user->get_users_by_chassis($date, $chassis);
				$gt_date[] = $date;
			}
			foreach ($user_by_chassis as $i) {
				$tt[] = $i[0]->total;
			}
			$this->data['count_user_x'] = json_encode($gt_date);
			$this->data['chassis_users'] = json_encode($tt);
			echo $this->load->view('ajx_chassis_chart', $this->data, true);
		}
	}

	public function count_classes() {
		$date = $this->input->post('date');
		$datef = $this->input->post('datef');
		$classes = $this->input->post('classes');
		if ($datef) {
			$earlier = new DateTime($date);
			$later = new DateTime($datef);
			$diff = $later->diff($earlier)->format("%a");
			if ($diff > 365 || $diff == $datef) {
				redirect(base_url('dashboard/?error=NOTE SELECT MORE THEN YEAR'));
			}
			$ldate = $date;
			$begin = new DateTime($date);
			$end = new DateTime($datef);
			$end = $end->modify('+1 day');
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval, $end);
			$month = array();
			foreach ($daterange as $value) {
				$dt = $value->format('Y-m-d');
				$st = date('Y-m-01', strtotime($dt));
				$lt = date('Y-m-t', strtotime($dt));
				if ($ldate < $lt) {
					$sdat = date('Y-m-01', strtotime($dt));
					$endat = date('Y-m-t', strtotime($dt));
					$class[] = $this->user->count_classes_month($sdat, $endat, $classes);
				}
				$month[] = $value->format('M');
				$gt_date[] = $date;
				$ldate = $lt;
			}
			foreach ($class as $i) {

				$tt[] = $i[0]->total;
			}

			$this->data['count_user_x'] = json_encode(array_values(array_unique($month)));

			$this->data['class'] = json_encode($tt);
			echo $this->load->view('ajx_class_chart', $this->data, true);
		} else {
			$week_start = date("Y-m-d", strtotime('monday this week', strtotime($date)));
			$ldate = $week_start;
			$begin = new DateTime($week_start);
			$end = new DateTime($ldate);
			$end = $end->modify('+7 day');
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval, $end);

			foreach ($daterange as $value) {
				$date = $value->format('Y-m-d');
				$class[] = $this->user->count_classes($date, $classes);
				$gt_date[] = $date;
			}
			foreach ($class as $i) {
				$tt[] = $i[0]->total;
			}
			$this->data['count_user_x'] = json_encode($gt_date);
			$this->data['class'] = json_encode($tt);
			echo $this->load->view('ajx_class_chart', $this->data, true);
		}
	}
	public function app_user_couunt() {
		$date = $this->input->post('date');
		$datef = $this->input->post('datef');
		if ($datef) {
			$earlier = new DateTime($date);
			$later = new DateTime($datef);
			$diff = $later->diff($earlier)->format("%a");
			if ($diff > 365 || $diff == $datef) {
				redirect(base_url('dashboard/?error=NOTE SELECT MORE THEN YEAR'));
			}
			$ldate = $date;
			$begin = new DateTime($date);
			$end = new DateTime($datef);
			$end = $end->modify('+1 day');
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval, $end);
			$month = array();
			foreach ($daterange as $value) {
				$dt = $value->format('Y-m-d');
				$st = date('Y-m-01', strtotime($dt));
				$lt = date('Y-m-t', strtotime($dt));
				if ($ldate < $lt) {
					$sdat = date('Y-m-01', strtotime($dt));
					$endat = date('Y-m-t', strtotime($dt));
					$ios_user[] = $this->user->month_ios_users($sdat, $endat);
					$android_user[] = $this->user->month_android_users($sdat, $endat);
				}
				$month[] = $value->format('M');
				$gt_date[] = $this->user->user_type_apl($date);
				$ldate = $lt;
			}
			foreach ($ios_user as $i) {

				$tt[] = $i[0]->total;
			}
			foreach ($android_user as $a) {

				$and[] = $a[0]->total;
			}
			$this->data['count_user_x'] = json_encode(array_values(array_unique($month)));
			$this->data['ios_user'] = json_encode($tt);
			$this->data['android_user'] = json_encode($and);
			$this->data['serviceshop'] = $this->serviceshop->total_serviceshop();
			$this->data['total'] = $this->workshop->total_workshop();
			$this->data['partshop'] = $this->partshop->total_partshop();
			echo $this->load->view('ajx_app_user_chart', $this->data, true);
		} else {
			$week_start = date("Y-m-d", strtotime('monday this week', strtotime($date)));
			$ldate = $week_start;
			$begin = new DateTime($week_start);
			$end = new DateTime($ldate);
			$end = $end->modify('+7 day');
			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval, $end);
			foreach ($daterange as $value) {
				$date = $value->format('Y-m-d');
				$ios_user[] = $this->user->get_ios_users($date);
				$android_user[] = $this->user->get_android_users($date);
				$gt_date[] = $this->user->user_type_apl($date);
			}
			foreach ($ios_user as $i) {

				$tt[] = $i[0]->total;
			}
			foreach ($android_user as $a) {

				$and[] = $a[0]->total;
			}
			$this->data['count_user_x'] = json_encode($gt_date);
			$this->data['ios_user'] = json_encode($tt);
			$this->data['android_user'] = json_encode($and);
			$this->data['serviceshop'] = $this->serviceshop->total_serviceshop();
			$this->data['total'] = $this->workshop->total_workshop();
			$this->data['partshop'] = $this->partshop->total_partshop();
			$this->data['chassis'] = $this->user->get_allusers_chassis();
			echo $this->load->view('ajx_app_user_chart', $this->data, true);
		}
	}
	public function shop_count() {
		$date = $this->input->post('date');
		$datef = $this->input->post('datef');
		if ($datef) {

			$workshop = $this->user->month_workshop($date, $datef);
			$serviceshop = $this->user->month_serviceshop($date, $datef);
			$partshop = $this->user->month_partshop($date, $datef);
			$this->data['serviceshop'] = $serviceshop;
			$this->data['workshop'] = $workshop;
			$this->data['partshop'] = $partshop;
			echo $this->load->view('ajx_count_shops', $this->data, true);
		} else {
			$ts = strtotime($date);
			$start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
			$start_date = date('Y-m-d', $start);
			$end_date = date('Y-m-d', strtotime('next sunday', $start));
			$workshop = $this->user->month_workshop($start_date, $end_date);
			$serviceshop = $this->user->month_serviceshop($start_date, $end_date);
			$partshop = $this->user->month_partshop($start_date, $end_date);
			$this->data['serviceshop'] = $serviceshop;
			$this->data['workshop'] = $workshop;
			$this->data['partshop'] = $partshop;
			echo $this->load->view('ajx_count_shops', $this->data, true);

		}
	}
}
