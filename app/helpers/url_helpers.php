<?php
		function redirect($page){
			header('location: '. URLROOT . '/'.$page );
		}


		function random_numbers($limit){
			$random_number_array = range(1, HORSES_NUMBERS_LIMIT);
			shuffle($random_number_array );
			$random_number_array = array_slice($random_number_array ,0,$limit);
			return $random_number_array;
		}

		function result_diff($array1,$array2){

			$show_result = "";
			foreach($array2 as $key => $value)
			{


				if(in_array($value, $array1))
				{

					if ($value == $array1[$key]) 
					{
					   $show_result .= "<div class='h2 bg-info'>".$value."</div>";
					}
					else
					{
					    $show_result .= "<div class='h2 bg-success'>".$value."</div>";

					}
				}
				else 
				{
					$show_result .= "<div class='h2 bg-danger'>".$value."</div>";
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

		function abbr_status($abbr, $prize = null){
			
			if ($prize != null) {
				$prize =  '<br>$'.$prize;
			}


			switch ($abbr) {
				case 'O':
					$text = "Order ".$prize;
					$type = "success";
					break;
				case 'D':
					$text = "Disorder ".$prize;
					$type = "info";
					break;
				case 'B':
					$text = "Bonus ".$prize;
					$type = "primary";
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

		function array_group(array $data, $by_column)
		{
		    $result = [];
		    foreach ($data as $item) {
		        $column = $item->$by_column;
		        unset( $item->$by_column);
		        $result[$column][] = $item;
		    }
		    return $result;
		}

		function make_hints_array($submited,$random,$hints){

		$wins = array();
			foreach($submited as $submit_num)
			{
				if(in_array($submit_num, $random))
				{
					$wins[] .= $submit_num;
				}
			}


		$hint_array = $hints;
			foreach($wins as $win)
			{
				if(!in_array($win, $hint_array))
				{
					$hint_array[] .= $win;
				}
			}

			return array_unique($hint_array);

		}

		function hintsPicker($array,$limit){

			$show_result = "";
			foreach($array as $check_win)
			{
					$show_result .= "<div class='h2 bg-primary'>".$check_win."</div>";
			}
			$obscure_limit = $limit-count($array);

			for ($i=0; $i < $obscure_limit ; $i++) { 
				$show_result .= "<div class='h2 bg-info'>?</div>";
			}

			return $show_result;
		}