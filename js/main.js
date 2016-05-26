/* global $this */

function goTo(){
	location.replace("application.php");
}

function disAgree(){

}

jQuery.validator.addMethod(
	"SexCompleted",
	function(value, element){
		if(element.value === "Female"){
			return true;
		}else if(element.value === "Male"){
			return true;
		}else{
			return false;
		}
	},
	"This field is required! You must select an option."
	);

jQuery.validator.addMethod(
	"TrueRes",
	function(value, element){
		if(element.value === "True"){
			return true;
		}else if(element.value === "False"){
			return false;
		}else{
			return false;
		}
	},
	"This field is required! You must select an option."
	);

jQuery.validator.addMethod(
	"GunType",
	function(value, element){
		if(element.value === "Revolver"){
			return true;
		}else if(element.value === "Semi-Automatic"){
			return true;
		}else if(element.value === "Rent"){
			return true;
		}else{
			return false;
		}
	},
	"This field is required! You must select an option."
	);

jQuery.validator.addMethod(
	"DL_ST",
	function(value, element){
		if(element.value === "NC"){
			return true;
		}else if(element.value === "SC"){
			return true;
		}else if(element.value === "GA"){
			return true;
		}else{
			return false;
		}
	},
	"This field is required! You must select an option."
	);

$(document).ready(function(){
	//do something if browser width is ?
	if(document.documentElement.clientWidth < 768){
		$('.hovering').wrap('<button></button>');
	}
	if(document.documentElement.clientWidth > 768){
		$('.hovering').unwrap('<button></button>');
	}


	//test js
	$('.button').on('click', function(){
		$('.content').toggleClass('isOpen');
	});

	$('li a').on('hover', function(){
		$('.hovering').toggleClass('active');
	});
	//end test js

	$('ol.courseOutline').slideUp();
	$('h4#outline').click(function(){
		$('ol.courseOutline').slideToggle();
	});

	$('#disagree').click(function(){
		var x = confirm("Are you sure? If you continue you will navigate away from this\nwebsite and will not be able to signup for the SC Concealed\nWeapons Permit Class!");
		if(x === true){
			location.replace("sorry.php");
		}else if(x === false){
			location.reload();
		}else{
			alert("Ooops, something went wrong! Try refreshing the page.");
		}
	});

	$("#signup").validate({
		rules: {
			fname: "required",
			lname: "required",
			sex: {
				required: true,
				SexCompleted: true
			},
			dob: "required",
			haddress: "required",
			city: "required",
			state: "required",
			zip: "required",
			resident: {
				required: true,
				TrueRes: true
			},
			guntype: {
				required: true,
				GunType: true
			},
			experience: "required",
			disabilities: "required",
			hphone: "required",
			email: {
				required: true,
				email: true
			},
			email2: {
				required: true,
				email: true,
				equalTo: "#email"
			},
			driverlic: "required",
			dlstate: {
				required: true,
				DL_ST: true
			},
			emergencyname: "required",
			emergencyrelation: "required",
			enrgencyaddress: "required",
			emergencycity: "required",
			emergencystate: "required",
			emergencyzip: "required",
			emergencyhome: "required",
			emergencycell: "required",
			emergencywork: "required",
			submissiondate: "required",
			submissiontime: "required"
		},
		message: {
			comment: "This field is required!"
		}
	}
	);

});