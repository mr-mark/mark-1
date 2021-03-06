<?php
if ( ! function_exists('get_lang')) {
	function get_lang() {
	    return "persian";
	}
}

function car_array() {
	$cars	= array("رنو تندر90",
					"رنو مگان",
					"پیکان",
					"پراید",
					"پژو پارس",
					"پژو 206",
					"پژو 206 SD",
					"پژو پرشیا",
					"سمند LK",
					"سیتروئن",
					"زانتیا",
					"مزدا",
					"MVM",
					"فیات سینا",
					"هیوندای",
					"کیا",
					"BMW",
					"تویوتا",
					"سایر");

	return $cars;
}

if ( ! function_exists('get_province')) {
	function get_province() {
	    $cities = array("خارج از ایران",
	                    "تهران",
	                    "------",
	                    "آذربایجان شرقی",
	                    "آذربایجان غربی",
	                    "اردبیل",
	                    "اصفهان",
	                    "ایلام",
	                    "بوشهر",
	                    "چهارمحال و بختیاری",
	                    "خراسان جنوبی",
	                    "خراسان رضوی",
	                    "خراسان شمالی",
	                    "خوزستان",
	                    "زنجان",
	                    "سمنان",
	                    "سیستان و بلوچستان",
	                    "فارس",
	                    "قزوین",
	                    "قم",
	                    "کردستان",
	                    "کرمان",
	                    "کرمانشاه",
	                    "کهگیلویه و بویراحمد",
	                    "گلستان",
	                    "گیلان",
	                    "لرستان",
	                    "مازندران",
	                    "مرکزی",
	                    "هرمزگان",
	                    "همدان",
	                    "یزد"
		);

		return $cities;
	}
}