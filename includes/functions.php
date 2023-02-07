<?php
function calcTotalLpltr($up, $ltr)
{
	return $ltr * ((100-$up)/100);

}
function getUpId($uptype)
{
	$up_info = UpInfo::find_by_up_type($uptype);
	return $up_info->id;
}
function getUserType()
{
	if(isset($_SESSION['auth']))
		{
			return $_SESSION['auth'];
		}
		else
		{
			return false;
		}
}
//function getStartEndMonth()
//{

//}
function generatecode($room,$project,$rack,$rack_part,$reg_no)
{
    $final_code = $reg_no."/".$room."/".$project."/".$rack."/".$rack_part;
    return $final_code;
}
function setornot($var)
{
    if(!isset($var))
    {
        $var = "";
    }
    return $var;
}
function calculateLpltr($qty,$power)
{
	$qty_lpltr = ($qty * $power)/100;
	return $qty_lpltr;
}
function updateIrdStickerStock($up_id=0,$vol_id=0,$qty=0,$task)
{
	$sticker_stock = IrdStickerCurrentStock::find_by_upid_volid($up_id,$vol_id);
	if($task==="addup")
	{
		if(empty($sticker_stock))
		{
			$sticker = new IrdStickerCurrentStock();
			$sticker->stock_quantity = $qty;
			$sticker->up_id = $up_id;
			$sticker->vol_id = $vol_id;
			$sticker->save();
		}
		else
		{
			$sticker_stock->stock_quantity = $sticker_stock->stock_quantity + $qty;
			$sticker_stock->save();
		}
	}
	if($task==="deduct")
	{
		$sticker_stock->stock_quantity = $sticker_stock->stock_quantity - $qty;
		$sticker_stock->save();
	}

}
function checkIrdStickerStock($up_id=0,$vol_id=0,$qty=0)
{
	$sticker_stock = IrdStickerCurrentStock::find_by_upid_volid($up_id,$vol_id);

	if(empty($sticker_stock))
	{
		return false;
	}
	if($sticker_stock->stock_quantity<$qty)
	{
		return false;
	}
	return true;
}
function getPrevBlendStock($vendor_id=0,$brand_id=0)
{
	$blend_total_stock = VendorBlendTotalStock::find_by_vendor_id_brand_id($vendor_id,$brand_id);
	if(empty($blend_total_stock))
	{
		$prev_stock = 0;
	}
	else
	{
		$prev_stock = $blend_total_stock->stock_quantity;
	}
	return $prev_stock;
}
function updateIsCurrent()
{
	$fiscals = Fiscalyear::find_all();
	foreach($fiscals as $fiscal)
	{
		$fiscal->is_current = 0;
		$fiscal->save();
	}
}
function checkCartoonStock($data)
{
		// Rendering all the possible sizes and converting to arrays
		$size_array = array('size_L','size_Q','size_P','size_N','size_D');
		foreach($size_array as $size_list)
		{
			$data[$size_list] = explode("-", $data[$size_list]);
		}

		$brand_count = count($data['brand_id']);
		//print_r($data['brand_id']); exit;
		for($i=0;$i<$brand_count; $i++)// looping through each brand and checking the stock
		{
			foreach($size_array as $size)
			{
				$stock = VendorCartoonStock::find_by_vendor_id_brand_id(getVendorId(),$data['brand_id'][$i]);

				if(!empty($stock) &&  !empty($data[$size][$i]))
				{
					if($data[$size][$i]>$stock->$size)
					{
						return false;
					}

				}
				if(empty($stock))
				{
					return false;
				}
			}
			return true;
		}

}

function updateWhStockAddDrStock($brand_id,$vendor_id)
{

}
function deductCartoonStock($data)
{
	$size_array = array('size_L','size_Q','size_P','size_N','size_D');
		foreach($size_array as $size_list)
		{
			$data[$size_list] = explode("-", $data[$size_list]);
		}

		$brand_count = count($data['brand_id']);
		//print_r($data['brand_id']); exit;
		for($i=0;$i<$brand_count; $i++)// looping through each brand and deduting the stock
		{
			foreach($size_array as $size)
			{
				$stock = VendorCartoonStock::find_by_vendor_id_brand_id(getVendorId(),$data['brand_id'][$i]);

					$stock->$size = $stock->$size - $data[$size][$i];
					$stock->save();
			}

		}
}
function UpdateCartoonStock($post)
{
	$stock = VendorCartoonStock::find_by_vendor_id_brand_id(getVendorId(),$post['brand_id']);
	$size_array = array('size_L','size_Q','size_P','size_N','size_D');
	if(empty($stock))
	{
		$cartoon_stock = new VendorCartoonStock();
		$cartoon_stock->vendor_id=getVendorId();
		$cartoon_stock->brand_id = $post['brand_id'];
		foreach($size_array as $size)
		{
			$cartoon_stock->$size = $post[$size];
		}

		$cartoon_stock->save();
	}
	else
	{
		foreach($size_array as $size)
		{
			$stock->$size = $stock->$size + $post[$size];
		}

		$stock->save();
	}
}
function UpdateDispatchBrandStock($data,$task)
{
	$brand_id_array = explode("-",$data->brand_id);
	$brand_count = count($brand_id_array);
	$size_L = explode("-", $data->size_L);
	$size_Q = explode("-", $data->size_Q);
	$size_P = explode("-", $data->size_P);
	$size_N = explode("-", $data->size_N);
	$size_D = explode("-", $data->size_D);

	for($i=0;$i<$brand_count;$i++)
	{
		$stock = VendorDispatchBrandStock::find_by_vendor_id_brand_id(getVendorId(),$brand_id_array[$i]);
		$size_array = array('size_L','size_Q','size_P','size_N','size_D');
		if(empty($stock))
		{
			$cartoon_stock = new VendorDispatchBrandStock();
			$cartoon_stock->vendor_id=getVendorId();
			$cartoon_stock->brand_id = $brand_id_array[$i];
			foreach($size_array as $size)
			{


				$cartoon_stock->$size = $$size[$i];
			}

			$cartoon_stock->save();
		}
		else
		{
			foreach($size_array as $size)
			{


				$stock->$size = $stock->$size + $$size[$i];

			}

			$stock->save();
		}
	}

}
function createPrevStockPostData($post)
{
	$stock = VendorCartoonStock::find_by_vendor_id_brand_id(getVendorId(),$post['brand_id']);
	$size_array = array('size_L','size_Q','size_P','size_N','size_D');
	$stock_array = array('prev_stock_L','prev_stock_Q','prev_stock_P','prev_stock_N','prev_stock_D');
	if(empty($stock))
	{
		foreach ($stock_array as $stock)
		{

			$post[$stock] = 0;

		}
	}
	else
	{
		$post['prev_stock_L']  = $stock->size_L;
		$post['prev_stock_Q']  = $stock->size_Q;
		$post['prev_stock_P']  = $stock->size_P;
		$post['prev_stock_N']  = $stock->size_N;
		$post['prev_stock_D']  = $stock->size_D;
	}
	return $post;
}

function getVendorId()
{
	$user = User::find_by_id($_SESSION['auth_id']);
	return $user->vendor_id;
}
function getUserMode()
{
	$user = User::find_by_id($_SESSION['auth_id']);
	return $user->mode;
}
function createSizePostData($post)
{
	$size_array = array('size_L','size_Q','size_P','size_N','size_D');
	foreach ($size_array as $size) {

		if(!isset($post[$size]))
		{
			$post[$size] = "";
		}
	}
	return $post;

}
/*function createPrevStockPostData($post)
{
	$stock_array = array('prev_stock_L','prev_stock_Q','prev_stock_P','prev_stock_N','prev_stock_D');
	foreach ($stock_array as $stock) {

		if(!isset($post[$stock]))
		{
			$post[$stock] = 0;
		}
	}
	return $post;

}
*/function getSizeString($postdata)
{
	$size_string = '';
	if(empty($postdata))
	{
		$size_string='';

	}
	else
	{
		$total_count = count($postdata);
		$i = 1;
		foreach($postdata as $data)
		{
			if($i!=$total_count){
				$size_string .=$data."-";
			}
			else{
				$size_string .=$data;
			}


			$i++;
		}
	}
	return $size_string;
}
function updateSpiritStock($spirit_id=0,$qty,$task)
{
	switch ($task) {
		case 'new':
			$spirit_stock = new VendorSpiritStock();
			$spirit_stock->stock_quantity = $qty;
			$spirit_stock->spirit_id = $spirit_id;
			$spirit_stock->vendor_id = getVendorId();
			$spirit_stock->save();
		break;

		case 'add':
			$spirit_stock = VendorSpiritStock::find_by_spirit_id_vendor_id($spirit_id,getVendorId());
			$spirit_stock->stock_quantity = $spirit_stock->stock_quantity + $qty;
			$spirit_stock->save();
		break;

		case 'deduct':
			$spirit_stock = VendorSpiritStock::find_by_spirit_id_vendor_id($spirit_id,getVendorId());
			$spirit_stock->stock_quantity = $spirit_stock->stock_quantity - $qty;
			$spirit_stock->save();
		break;


	}
	return;

}
function getVendorStock($spirit_id=0,$spirit_qty=0)
{
	$spirit = VendorSpiritStock::find_by_spirit_id_vendor_id($spirit_id,getVendorId());
	if($spirit_qty>$spirit->stock_quantity || empty($spirit->stock_quantity))
	{
		return false;
	}
	else
	{
		return true;
	}
}
function getSpiritStock($spirit_id=0,$spirit_qty=0)
{
	$spirit = VendorSpiritStock::find_by_spirit_id_vendor_id($spirit_id,getVendorId());
	if($spirit_qty>$spirit->stock_quantity || empty($spirit->stock_quantity))
	{
		return false;
	}
	else
	{
		return true;
	}
}
function getBlendStockIncSpiritId()
{

}
function generateCurrDate(){
	$cal = new Nepali_Calendar();
	$nepdate = $cal->eng_to_nep(date("Y", time()), date("m", time()), date("d", time()));
     $curr_date = $nepdate['year'].'-'.$nepdate['month'].'-'.$nepdate['date'];
     return $curr_date;
}
function DateNepToEng($nep_date)
{
	$cal = new Nepali_Calendar();
	$nep_date = explode("-",$nep_date);

	$eng_date = $cal->nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
	return $eng_date["year"]."-".$eng_date["month"]."-".$eng_date["date"];

}
function total_letters(){
	$letter1 = Taxcert::count_all();
    $letter2 = Taxpersonal::count_all();
    $letter3 = Taxlabour::count_all();
    $letter4 = Taxrenewal::count_all();
    $total_letters = $letter1 + $letter2 + $letter3 +$letter4;
    return $total_letters;
}

function getMaxLetterNo($cert){
	if($cert==1)
	{
		 $letter = Taxcert::count_all();
		 $letter = $letter+1;

	}
	if($cert==2){ $letter = Taxlabour::count_all(); $letter=$letter+1; }
	if($cert==3){ $letter = Taxpersonal::count_all();  $letter=$letter+1; }
	if($cert==4){ $letter = Taxrenewal::count_all(); $letter=$letter+1; }
	if($cert==5){ $letter = Taxdisc::count_all(); $letter=$letter+1; }
    return $letter;
  }
/* function max_letter_no(){
    $letter_no1 = Taxcert::find_max_letter_no();
    $letter_no2 = Taxpersonal::find_max_letter_no();
    $letter_no3 = Taxlabour::find_max_letter_no();
    $letter_no4 = Taxrenewal::find_max_letter_no();
    $letter_no5 = Taxdisc::find_max_letter_no();
    $letter_array = array($letter_no1,$letter_no2,$letter_no3,$letter_no4,$letter_no5);
    return max($letter_array);
}*/

function convert_date($date){

    $date = explode("-",$date);
    $final_date = '';
    $i=1;
    $count = count($date);
    foreach($date as $datestring)
    {
        if($i==$count){
            $final_date.= convertedNOs($datestring);
        }
        else{
        $final_date.= convertedNOs($datestring)."/";
        }
        $i++;
    }
    return $final_date;

}
	function convertNos($nos)
{
    $n = '';
  switch($nos){
    case "०": $n = 0; break;
    case "१": $n = 1; break;
    case "२": $n= 2; break;
    case "३": $n = 3; break;
    case "४": $n = 4; break;
    case "५": $n = 5; break;
    case "६": $n = 6; break;
    case "७": $n = 7; break;
    case "८": $n = 8; break;
    case "९": $n = 9; break;
    case "0": $n = "०"; break;
    case "1": $n = "१"; break;
    case "2": $n = "२"; break;
    case "3": $n = "३"; break;
    case "4": $n = "४"; break;
    case "5": $n = "५"; break;
    case "6": $n = "६"; break;
    case "7": $n = "७"; break;
    case "8": $n = "८"; break;
    case "9": $n = "९"; break;
   }
   return $n;
}

 function convertedcit($string)
    {
        	$string = str_split($string);
        	$out = '';
        	foreach($string as $str)
        	{
        		if(is_numeric($str))
        		{
        			$out .= convertNos($str);
        		}
        		else
        		{
        			$out .=$str;
        		}
        	}
        	return $out;

    }
    function convertedNos($num)
    {
        $str_num = preg_split('//u', ("". $num), -1); // not explode('', ("". $num))

            // For each item in your exploded string, retrieve the Nepali equivalent or vice versa.
            $out = '';
            $out_arr = array_map('convertNos', $str_num);
            $out = implode('', $out_arr);
            return $out;

    }
	function strip_zeros_from_date($marked_string)
	{
		// first remove the marked zeros
		$no_zeros=str_replace('*0','',$marked_string);
		// then remove any remaining marks
		$cleaned_string=str_replace('*','',$no_zeros);
		return $cleaned_string;
	}
	function strip_zeros_from_month($marked_string)
	{
		// first remove the marked zeros
		$new_string = '';
		$str_len = strlen($marked_string);
		for($i=0; $i<$str_len; $i++)
		{
			if($i==0 && $marked_string[$i]==0)
			{
				$marked_string[$i]='';
			}
			$new_string = $new_string.$marked_string[$i];
		}
		return $new_string;
	}
	function redirect_to($location=NULL)
	{
		if ($location != NULL)
		{
			header ("location:{$location}");

		}
	}
	function set_sort()
	{
		if(!isset($_SESSION['sort']))
		{
			$_SESSION['sort'] = 1;


		}
		if(isset($_GET['sort']))
		{
			if(isset($_GET['sort']) && $_SESSION['sort']==1 )
			{

				$_SESSION['sort'] = 2;
				$i=1;
			}
			if(isset($_GET['sort']) && $_SESSION['sort']==2 && $i!=1 )
			{

				$_SESSION['sort'] = 1;

			}
		}
		$i='';
	}
	function output_message($message="")
	{
		if (!empty($message))
		{
			return"<p class=\"message\">{$message}</p>";
		}
		else
		{
			return "";
		}
	}
	/*function __autoload($class_name)
	{
		$class_name = strtolower($class_name);
		$path = "../includes/{$class_name}.php";
		if (file_exists($path))
		{
			require_once($path);
		}
		else
		{
			die("The file {$class_name}.php could not be found.");
		}
	}
	*/
	function log_action($action, $message="")
	{
		$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
		$new = file_exists($logfile) ? false: true ;
		if ($handle = fopen($logfile, 'a'))//append
		{
			$timestamp = strftime("%Y-%m-%d %H:%M:%S" , time());
			$content = "{$timestamp} | {$action} | {$message}\n";
			fwrite($handle, $content);
			fclose($handle);
			if ($new)
			{
				chmod($logfile, 0755);
			}
			else
			{
				echo "could not open the log file for writing";
			}
		}
	}

	function datetime_to_text($datetime="")
	{
		$unixdatetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
	}
	function datetime_to_text_nosec($datetime="")
	{
		$unixdatetime = strtotime($datetime);
		return strftime("%B %d, %Y", $unixdatetime);
	}
	function randname($filename)
	{
		$name = explode(".", $filename);
		$ext_index_count = count($name)-1;
		$extension = $name[$ext_index_count];
		$firstname = time()*rand();
		$filename = $firstname.'.'.$extension;
		return $filename;
	}
	function mailto($to, $subject, $body, $link='')
	{
		//$to = $username;
		$body = "Your Registration has been processed. Please click the link below to activate your account with Uptown Cars: \r\n";
		$body.= $link;
		$headers = 'From: http://uniwebdesignusa.com/uptown';
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail = mail($to, $subject, $body, $headers);
		return $mail;
	}

	function compress($source, $destination, $quality)
 	{

	    $info = getimagesize($source);
 		if ($info['mime'] == 'image/jpeg')
	        $image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif')
	        $image = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png')
	        $image = imagecreatefrompng($source);
		imagejpeg($image, $destination, $quality);
		return $destination;
	}
?>
