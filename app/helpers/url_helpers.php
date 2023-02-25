<?php
		function redirect($page){
			header('location: '. URLROOT . '/'.$page );
		}


		function random_numbers($limit){
			$random_number_array = range(1, 10);
			shuffle($random_number_array );
			$random_number_array = array_slice($random_number_array ,0,$limit);
			return $random_number_array;
		}

		function result_diff($array1,$array2){

			$show_result = "";
			foreach($array2 as $check_win)
			{
				if(in_array($check_win, $array1))
				{
					$show_result .= "<div class='h2 bg-success'>".$check_win."</div>";
				}
				else 
				{
					$show_result .= "<div class='h2 bg-danger'>".$check_win."</div>";
				}
			}

			return $show_result;
		}


		function getSolved($array1,$array2){

			$show_result = "";
			foreach($array2 as $check_win)
			{
				if(in_array($check_win, $array1))
				{
					$show_result .= "<div class='h2 bg-success'>".$check_win."</div>";
				}
			}

			return $show_result;
		}


		function result_div($array){
			$array = json_decode($array,true);
			$show_result = "";
			foreach($array as $check_win)
			{
					$show_result .= "<div class='h2 bg-success'>".$check_win."</div>";
			}

			return $show_result;
		}


		function string_to_json($string){
			$json = json_encode(explode(',',rtrim(@$string,',')));
			return $json;
		}

		function check_duplicate($array) {
			if (count(array_unique(array_diff($array,array("")))) < count(array_diff($array,array("")))){
				return true;
			}
		}

		function check_ints($array){
			$array = implode('', $array);
			return is_numeric($array);
		}

		function check_range($array){
			foreach($array as $number){
				if ($number > 20 OR $number < 1) {
					return true;
				}
			}
		}

		function abbr_status($abbr){
			
			switch ($abbr) {
				case 'O':
					$text = "Order";
					$type = "success";
					break;
				case 'D':
					$text = "Disorder";
					$type = "info";
					break;
				case 'L':
					$text = "Loss";
					$type = "danger";
					break;				
				default:
					return false;
					break;
			}
				return "<span class='p-2 mt-2 alert-".@$type."'>".@$text."</span>";
		}

		function current_url(){
		    // Program to display URL of current page.
		    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		        $link = "https";
		    else $link = "http";
		      
		    // Here append the common URL characters.
		    $link .= "://";
		      
		    // Append the host(domain name, ip) to the URL.
		    $link .= $_SERVER['HTTP_HOST'];
		      
		    // Append the requested resource location to the URL
		    $link .= $_SERVER['REQUEST_URI'];
		      
		    // Print the link
		    return $link;
		}