<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Workshop_model', 'workshop');
		$this->load->model('Users_model', 'user');
		$this->load->model('Provider_Model');
		$this->load->model('Reviews_model');
		$this->load->model('Favorite_model');
		$this->load->model('Push_notification_model');
		$this->load->model('Booking_model');
		$this->load->model('Advertisement_model');
		$this->load->model('Serviceshop_model', 'serviceshop');
		$this->load->model('Partsshop_model', 'partshop');
		$this->load->model('Membership_model', 'membership');
		$this->load->model('Car_model', 'classes');
		$this->load->model('acl_model');
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
		$this->data['carowners'] = $this->partshop->total_carowners();
		$this->data['membership'] = $this->partshop->total_membership();
		$this->data['membership_users'] = $this->partshop->total_memberships_users();
		$this->data['rec'] = $this->acl_model->get_all_users();
		$this->data['chassis'] = $this->user->get_allusers_chassis();
		$this->data['classes'] = $this->user->get_allclasses();
		$this->data['classes'] = $this->classes->get_classes();
		$this->data['parts'] = $this->Provider_Model->get_partss();
		$this->data['booking_completed'] = $this->Booking_model->get_booking_completed();
		$this->data['booking_pending'] = $this->Booking_model->get_booking_pending();
		$this->data['booking_rejected'] = $this->Booking_model->get_booking_rejected();
		$this->data['reviews_pending'] = $this->Reviews_model->get_reviews_pending();
		$this->data['reviews_rejected'] = $this->Reviews_model->get_reviews_rejected();
		$this->data['reviews_approved'] = $this->Reviews_model->get_reviews_approved();
		$this->data['active_ads'] = $this->Advertisement_model->get_active_ads();
		$this->data['provider_parts'] = $this->Provider_Model->provider_parts();
		$this->data['notification_provider'] = $this->Push_notification_model->manage_notification_provider();
		$this->data['notification_users'] = $this->Push_notification_model->manage_notification_users();

		$this->data['active_parts'] = array_filter($this->Provider_Model->get_parts_admin(), function ($part) {
			return $part->status == 'approve' ? true : false;
		});
		$this->data['in_active_parts'] = array_filter($this->Provider_Model->get_parts_admin(), function ($part) {
			return $part->status == 'reject' ? true : false;
		});
		$this->data["favorites"] = $this->Favorite_model->get_favorites();
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
				$endat = $value->format('Y-m-d');
				$ios_user[] = $this->user->month_ios_users($date, endat);
				$android_user[] = $this->user->month_android_users($date, endat);
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
			$carowners = $this->user->month_carowners($date, $datef);
			$membership = $this->user->month_membership($date, $datef);
			$membership_users = $this->user->month_memberships_users($date, $datef);
			$active_parts = $this->user->month_active_parts($date, $datef);
			$in_active_parts = $this->user->month_in_active_parts($date, $datef);
			$favorites = $this->user->month_favorites($date, $datef);
			$booking_completed = $this->user->month_booking_completed($date, $datef);
			$booking_pending = $this->user->month_booking_pending($date, $datef);
			$booking_rejected = $this->user->month_booking_rejected($date, $datef);
			$reviews_pending = $this->user->month_reviews_pending($date, $datef);
			$reviews_rejected = $this->user->month_reviews_rejected($date, $datef);
			$reviews_approved = $this->user->month_reviews_approved($date, $datef);
			$active_ads = $this->user->month_active_ads($date, $datef);
			$provider_parts = $this->user->month_provider_parts($date, $datef);
			$notification_provider = $this->user->month_notification_provider($date, $datef);
			$notification_users = $this->user->month_notification_users($date, $datef);
			$this->data['serviceshop'] = $serviceshop;
			$this->data['workshop'] = $workshop;
			$this->data['partshop'] = $partshop;
			$this->data['carowners'] = $carowners;
			$this->data['membership'] = $membership;
			$this->data['membership_users'] = $membership_users;
			$this->data['active_parts'] = $active_parts;
			$this->data['in_active_parts'] = $in_active_parts;
			$this->data['favorites'] = $favorites;
			$this->data['booking_completed'] = $booking_completed;
			$this->data['booking_pending'] = $booking_pending;
			$this->data['booking_rejected'] = $booking_rejected;
			$this->data['reviews_pending'] = $reviews_pending;
			$this->data['reviews_rejected'] = $reviews_rejected;
			$this->data['reviews_approved'] = $reviews_approved;
			$this->data['active_ads'] = $active_ads;
			$this->data['provider_parts'] = $provider_parts;
			$this->data['notification_provider'] = $notification_provider;
			$this->data['notification_users'] = $notification_users;
			echo $this->load->view('ajx_count_shops', $this->data, true);
		} else {
			$ts = strtotime($date);
			$start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
			$start_date = date('Y-m-d', $start);
			$end_date = date('Y-m-d', strtotime('next sunday', $start));
			$workshop = $this->user->month_workshop($start_date, $end_date);
			$serviceshop = $this->user->month_serviceshop($start_date, $end_date);
			$partshop = $this->user->month_partshop($start_date, $end_date);
			$carowners = $this->user->month_carowners($date, $datef);
			$membership = $this->user->month_membership($date, $datef);
			$membership_users = $this->user->month_memberships_users($date, $datef);
			$active_parts = $this->user->month_active_parts($date, $datef);
			$in_active_parts = $this->user->month_in_active_parts($date, $datef);
			$favorites = $this->user->month_favorites($date, $datef);
			$booking_completed = $this->user->month_booking_completed($date, $datef);
			$booking_pending = $this->user->month_booking_pending($date, $datef);
			$booking_rejected = $this->user->month_booking_rejected($date, $datef);
			$reviews_pending = $this->user->month_reviews_pending($date, $datef);
			$reviews_rejected = $this->user->month_reviews_rejected($date, $datef);
			$reviews_approved = $this->user->month_reviews_approved($date, $datef);
			$active_ads = $this->user->month_active_ads($date, $datef);
			$provider_parts = $this->user->month_provider_parts($date, $datef);
			$notification_provider = $this->user->month_notification_provider($date, $datef);
			$notification_users = $this->user->month_notification_users($date, $datef);

			$this->data['serviceshop'] = $serviceshop;
			$this->data['workshop'] = $workshop;
			$this->data['partshop'] = $partshop;
			$this->data['carowners'] = $carowners;
			$this->data['membership'] = $membership;
			$this->data['membership_users'] = $membership_users;
			$this->data['active_parts'] = $active_parts;
			$this->data['in_active_parts'] = $in_active_parts;
			$this->data['favorites'] = $favorites;
			$this->data['booking_completed'] = $booking_completed;
			$this->data['booking_pending'] = $booking_pending;
			$this->data['booking_rejected'] = $booking_rejected;
			$this->data['reviews_pending'] = $reviews_pending;
			$this->data['reviews_rejected'] = $reviews_rejected;
			$this->data['reviews_approved'] = $reviews_approved;
			$this->data['active_ads'] = $active_ads;
			$this->data['provider_parts'] = $provider_parts;
			$this->data['notification_provider'] = $notification_provider;
			$this->data['notification_users'] = $notification_users;

			echo $this->load->view('ajx_count_shops', $this->data, true);

		}
	}
}
