<?php
class error{

	/**
	 * __construct()	: Constructor Of The Class
	 * @return 
	 **/
	
	function __construct(){
	}
	
	/**
	 * errorMessage()		: Get Error Message
	 * 
	 * @param $id			: Error Id
	 * @return 				: Error Message
	 **/
	
	function errorMessage($id){
		$error;
		switch($id){
			case '1':
				$error = "Invalid user name or password.";
				break;
			case '2':
				$error = "Please enter username.";	
				break; 
			case '3':
				$error = "Please enter password.";	
				break; 
			case '4':
				$error = "Please enter old password.";	
				break; 
			case '5':
				$error = "Please enter new password.";	
				break; 
			case '6':
				$error = "Please enter confirm password.";	
				break; 
			case '7':
				$error = "Old password and confirm password should not matched.";	
				break; 
			case '8':
				$error = "You have entered wrong old password.";	
				break;
			case '9':
				$error = "Please enter link name.";	
				break;
			case '10':
				$error = "Link already exist.";	
				break;
			case '11':
				$error = "Please select link for.";	
				break;
			case '12':
				$error = "Please enter Sub-Link name.";	
				break;
			case '13':
				$error = "Sub-Link already exist.";	
				break;
			case '14':
				$error = "Please select Link.";	
				break;
			case '15':
				$error = "Link has been updated successfully.";	
				break;
			case '16':
				$error = "Link has been added successfully.";	
				break;
			case '17':
				$error = "Sub-Link has been updated successfully.";	
				break;
			case '18':
				$error = "Sub-Link has been added successfully.";	
				break;
			case '19':
				$error = "Branch has been deleted successfully.";
				break;
			case '20':
				$error = "Branch(s) has been deleted successfully.";
				break;
			case '21':
				$error = "Branch status has been updated successfully.";
				break;
			case '22':
				$error = "Branch has been added successfully.";
				break;
			case '23':
				$error = "Branch has been updated successfully.";	
				break;
			case '24':
				$error = "Please enter branch name.";	
				break;
			case '25':
				$error = "Branch already exist.";
				break;
			case '26':
				$error = "Subject has been deleted successfully.";
				break;
			case '27':
				$error = "Subject(s) has been deleted successfully.";
				break;
			case '28':
				$error = "Subject status has been updated successfully.";
				break;
			case '29':
				$error = "Subject has been added successfully.";
				break;
			case '30':
				$error = "Subject has been updated successfully.";	
				break;
			case '31':
				$error = "Please enter subject.";	
				break;
			case '32':
				$error = "Please enter subject code.";
				break;
			case '33':
				$error = "Please enter session.";	
				break;
			case '34':
				$error = "Please enter start date.";
				break;
			case '35':
				$error = "Please enter end date.";
				break;
			case '36':
				$error = "Record has been deleted successfully.";
				break;
			case '37':
				$error = "Record(s) has been deleted successfully.";
				break;
			case '38':
				$error = "Record status has been updated successfully.";
				break;
			case '39':
				$error = "Record has been added successfully.";
				break;
			case '40':
				$error = "Record has been updated successfully.";	
				break;
			case '41':
				$error = "Please enter house.";	
				break;
			case '42':
				$error = "Please enter description.";
				break;
			case '43':
				$error = "Please enter section.";
				break;
			case '44':
				$error = "Please enter extra curricular.";	
				break;
			case '45':
				$error = "Please enter attendance abbreviation.";	
				break;	
			case '46':
				$error = "Please enter marks type.";	
				break;	
			case '47':
				$error = "Please select relation.";
				break;	
			case '48':
				$error = "Please select title.";	
				break;	
			case '49':
				$error = "Please enter name.";
				break;	
			case '50':
				$error = "Please enter city.";
				break;	
			case '51':
				$error = "Please enter state.";
				break;	
			case '52':
				$error = "Please enter address.";	
				break;	
			case '53':
				$error = "Please enter mobile.";	
				break;	
			case '51':
				$error = "Please enter date of birth.";	
				break;			
			case '53':
				$error = "Please select a file for student image.";	
				break;	
			case '54':
				$error = "Please enter first name.";	
				break;	
			case '55':
				$error = "Please enter last name.";	
				break;	
			case '56':
				$error = "Please enter father name.";	
				break;
			case '57':
				$error = "Please enter mother name.";	
				break;
			case '58':
				$error = "Please select session.";	
				break;	
			case '59':
				$error = "Please select standard.";
				break;
			case '60':
				$error = "Please enter addmission number.";
				break;	
			case '61':
				$error = "Please enter pincode.";
				break;
			case '62':
				$error = "Addmission number already exist.";
				break;
			case '63':
				$error = "Please enter notice.";
				break;
			case '64':
				$error = "Please enter roll number.";	
				break;
			case '65':
				$error = "Please enter section.";
				break;
			case '66':
				$error = "Author Type has been deleted successfully.";
				break;
			case '67':
				$error = "Announcement has been added successfully.";
				break;
			case '68':
				$error = "Announcement has been updated successfully.";
				break;
			case '69':
				$error = "Please enter announcement heading.";
				break;
			case '70':
				$error = "Please enter announcement text.";
				break;
			case '71':
				$error = "Please select announcement for.";	
				break;	
			case '72':
				$error = "Notice(s) has been deleted successfully.";	
				break;	
			case '73':
				$error = "Notice has been added successfully.";	
				break;
			case '74':
				$error = "Notice has been updated successfully.";	
				break;
			case '75':
				$error = "Please enter notice heading.";	
				break;
			case '76':
				$error = "Please enter notice text.";
				break;
			case '77':
				$error = "Please enter date.";	
				break;	
			case '78':
				$error = "Please enter Subject.";	
				break;
			case '79':
				$error = "Mail Successfully sent.";	
				break;	
			case '80':
				$error = "Please enter designation.";	
				break;	
			case '81':
				$error = "Please enter title.";	
				break;
			case '82':
				$error = "Please enter location.";	
				break;
			case '83':
				$error = "Please enter unit outline.";	
				break;
			case '84':
				$error = "Please enter name.";	
				break;	
			case '85':
				$error = "News(s) has/have been deleted successfully.";	
				break;	
			case '86':
				$error = "News has been updated successfully.";	
				break;
			case '87':
				$error = "News has been inserted successfully.";	
				break;
			case '88':
				$error = "Please enter contact number.";	
				break;
			case '89':
				$error = "Please enter maximum marks.";	
				break;
			case '90':
				$error = "Please enter minimum marks.";	
				break;
			case '91':
				$error = "Ingredient has been deleted successfully.";	
				break;
			case '92':
				$error = "Ingredient(s) have been deleted successfully.";	
				break;
			case '93':
				$error = "Email has been added successfully.";	
				break;
			case '94':
				$error = "Email has been updated successfully.";	
				break;
			case '95':
				$error = "Email has been deleted successfully.";	
				break;
			case '96':
				$error = "Email(s) have been deleted successfully.";	
				break;
			case '97':
				$error = "Topic has been added successfully.";	
				break;
			case '98':
				$error = "Topic has been updated successfully.";	
				break;
			case '99':
				$error = "Topic has been deleted successfully.";	
				break;
			case '100':
				$error = "Topic(s) have been deleted successfully.";	
				break;
			case '101':
				$error = "Please Enter Last Name.";	
				break;		
			case '102':
				$error = "Please Enter New Email.";	
				break;
			case '103':
				$error = "Please Enter New Email (Confirm).";	
				break;
			case '104':
				$error = "New Email and Confirm New Email should be same.";	
				break;
			case '105':
				$error = "Email already Exist.";	
				break;
			case '106':
				$error = "Please Enter Current Password.";	
				break;
			case '107':
				$error = "Please Enter New Password.";	
				break;
			case '108':
				$error = "Please Enter New Password(Confirm).";	
				break;
			case '109':
				$error = "Please Enter right Current Password.";	
				break;
			case '110':
				$error = "New Password and Confirm New Password does not match.";	
				break;
			case '111':
				$error = "Recipe has been saved successfully.";	
				break;
			case '112':
				$error = "Recipe Ingredient has been saved successfully.";	
				break;
			case '113':
				$error = "Please enter heading.";	
				break;
			case '114':
				$error = "Welcome Note has been added successfully.";	
				break;
			case '115':
				$error = "Welcome Note has been updated successfully.";	
				break;
			case '116':
				$error = "Welcome Note has been deleted successfully.";	
				break;
			case '117':
				$error = "Welcome Note(s) have been deleted successfully.";	
				break;
			case '118':
				$error = "Please enter Step1.";	
				break;
			case '119':
				$error = "Please enter Step2.";	
				break;
			case '120':
				$error = "Please enter Step3.";	
				break;
			case '121':
				$error = "Please enter Step4.";	
				break;
			case '122':
				$error = "How To Use has been added successfully.";	
				break;
			case '123':
				$error = "How To Use has been updated successfully.";	
				break;
			case '124':
				$error = "Product has been added successfully.";	
				break;
			case '125':
				$error = "Product has been updated successfully.";	
				break;
			case '126':
				$error = "Product has been deleted successfully.";	
				break;
			case '127':
				$error = "Product(s) have been deleted successfully.";	
				break;
			case '128':
				$error = "Please enter Step5.";	
				break;
			case '129':
				$error = "Please enter Header1.";	
				break;
			case '130':
				$error = "Please enter Header2.";	
				break;
			case '131':
				$error = "Please enter Header3.";	
				break;
			case '132':
				$error = "Please enter Header4.";	
				break;
			case '133':
				$error = "Please enter Header5.";	
				break;
			case '134':
				$error = "About Us has been added successfully.";	
				break;
			case '135':
				$error = "About Us has been updated successfully.";	
				break;
			case '136':
				$error = "About Us has been deleted successfully.";	
				break;
			case '137':
				$error = "About Us(s) have been deleted successfully.";	
				break;
				
			default :
				$error = "Unknown error.";	
				break; 					
		}
		return $error;
	}
}
?>