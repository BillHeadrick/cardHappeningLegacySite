<?php

	class RetailerContact
	{
		private $firstName;
		private $lastName;
		private $position;
		private $phone;
		private $email;
		private $notes;
		private $company;
		private $pass;
		
		public function __construct($rid, $dbc)
		{
			$q = "SELECT * FROM `retailer_contact` WHERE `retailer_id` = '$rid'";
			$r = mysqli_query($dbc, $q);
			if($r)
			{
				if(mysqli_num_rows($r) == 0)	//the contact information is blank, ie we need to collect it
				{
					$this->firstName = "";
					$this->lastName = "";
					$this->position = "";
					$this->phone = "";
					$this->email = "";
					$this->notes = "";
					$this->company = "";
					$this->pass = false;
				}
				else 
				{
					$r = mysqli_fetch_assoc($r);	//the contact information already exists
					$this->firstName = $r['first_name'];
					$this->lastName = $r['last_name'];
					$this->position = $r['position'];
					$this->phone = $r['phone'];
					$this->email = $r['email'];
					$this->notes = $r['notes'];
					$this->company = $r['company'];
					if($r['password'] != "")
					{
						$this->pass = true; 			//we have a password
					}
					else
					{
						$this->pass = false;	
					}
				}
			}
		}
		
		//returns contact first name
		public function getFirstName()
		{
			return $this->firstName;
		}
		
		//returns contact last name
		public function getLastName()
		{
			return $this->lastName;
		}
		
		//returns first name concatenated with the last name
		public function getName()
		{
			$name = $this->firstName . " " . $this->lastName;
			return $name;
		}
		
		//returns contact position
		public function getPosition()
		{
			return $this->position;
		}
		
		//returns contact phone
		public function getPhone()
		{
			return $this->phone;
		}
		
		//returns contact email
		public function getEmail()
		{
			return $this->email;
		}
		
		//returns the contact notes
		public function getNotes()
		{
			return $this->notes;	
		}
		
		//returns the contact company
		public function getCompany()
		{
			return $this->company;
		}
		
		//returns true if the retailer has a password, otherwise false
		public function getPass()
		{
			return $this->pass;
		}
		
		//updates retailer password in database and variable pass
		//returns true if update successful
		public function updatePass($password, $dbc, $rid)
		{
			if($password != "")
			{
				$password = '12jkrjsf@#$sf'.$password;
				$password = sha1($password);
				$q = "UPDATE `retailer_contact` SET `password`= '$password' WHERE `retailer_id` = '$rid';";
				$r = mysqli_query($dbc, $q);
				if($r)
				{
					$this->pass = true;
				}
			}
		}
		
		//checks if neccessary contact information exists
		//neccessary fields = firstName, lastName, company, email, phone
		public function contactExists()
		{
			 if($this->firstName != "" && $this->lastName != "" && $this->company != "" && $this->email != "" && $this->phone != "")
			 {
			 	return true;
			 }
			 else 
			 {
				 return false;
			 }
		}
		
		public function newContact($newFirstName, $newLastName, $newEmail, $newPosition, $newCompany, $newPhone, $rid, $dbc)
		{
			$q = "INSERT INTO `retailer_contact`(`retailer_id`, `first_name`, `last_name`, `position`, `phone`, `email`, `company`) VALUES ('$rid', '$newFirstName', '$newLastName', '$newPosition', '$newPhone', '$newEmail', '$newCompany')";
			$r = mysqli_query($dbc, $q);
			if($r)
			{
					$this->firstName = $newFirstName;
					$this->lastName = $newLastName;
					$this->position = $newPosition;
					$this->phone = $newPhone;
					$this->email = $newEmail;
					$this->company = $newCompany;
			}
		}
		
		//updates the company in the database and then updates the value held for company
		public function updateCompany($dbc, $rid, $company)
		{
			$q = "UPDATE `retailer_contact` SET `company`= '$company' WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			$this->company = $company;
		}
		
		//updates the firstname in the database and updates the displayed first name
		public function updateFirstName($dbc, $rid, $first)
		{
			$q = "UPDATE `retailer_contact` SET `first_name`= '$first' WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			$this->firstName = $first;
		}
		
		//updates the lastname in the database and updates value held for last name
		public function updateLastName($dbc, $rid, $last)
		{
			$q = "UPDATE `retailer_contact` SET `last_name`= '$last' WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			$this->lastName = $last;
		}		
		
		//updates the position in the database and updates value held for position
		public function updatePosition($dbc, $rid, $position)
		{
			$q = "UPDATE `retailer_contact` SET `position`= '$position' WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			$this->position = $position;
		}
		
		//updates the phone in the database and updates value held for phone
		public function updatePhone($dbc, $rid, $phone)
		{
			$q = "UPDATE `retailer_contact` SET `phone`= '$phone' WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			$this->phone = $phone;
		}	
		
		//updates the lastname in the database and updates value held for last name
		public function updateEmail($dbc, $rid, $email)
		{
			$q = "UPDATE `retailer_contact` SET `email`= '$email' WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			$this->email = $email;
		}		
}

?>