<?php
//$N = array(1,2,3,4);
//$N = array(1,2,3,4,5,6,7,8);
$N = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
$K = 3;

class CreateRecursiveUniqueArrayVariants {
	private $length = 1;

	public function __construct( $arr=array(), $k = 1) {
		asort($arr);

		$this->length = (count($arr) - $k);

		$result = $this->craete(array($arr));

		asort($result);

		foreach ($result as $key => $values) {
			echo '[' . implode(', ', $values) . ']<br>';
		}
	}

	private function craete($ar) {
		if(!is_array($ar)){ return array(); }

		$new_ar = array();

		$change = false;
		foreach ($ar as $main_key => $arr_2) {
			if( count($arr_2) == $this->length ){
				$new_ar[$main_key] = $arr_2;
			} else {
				foreach ($arr_2 as $key => $values) {
					$arr_2_copy = $arr_2;

					$index = count($arr_2_copy) - ($key+1);

					unset($arr_2_copy[$index]);

					$sort_key = implode('-', $arr_2_copy);

					$new_ar[$sort_key] = array_values($arr_2_copy);
				}

				$change = true;
			}
		}

		if( $change ) {
			return $this->craete($new_ar);
		} else {
			return $ar;
		}
	}
}
new CreateRecursiveUniqueArrayVariants($N,$K);

/*
class CreateUniqueArrayVariants {
	public function __construct( $arr=array(), $k = 1) {
		$l = (count($arr) - $k);

		asort($arr);
		$min = (int)substr(implode('', $arr), 0, $l);

		arsort($arr);
		$max = (int)substr(implode('', $arr), 0, $l);

		$result = array();

		for ($i=$min; $i <= $max; $i++) {
			$str = (string)$i;
			$arr_1 = $arr_2 = str_split($str);

			if( count(array_unique($arr_1) ) != $l){ continue; }

			if( array_diff($arr_1, $arr) ){ continue; }

			asort($arr_2); $arr_2 = array_values($arr_2);

			if( $arr_1 != $arr_2 ){ continue; }

			$result[] = $arr_1;
		}

		foreach ($result as $key => $values) {
			echo '[' . implode(', ', $values) . ']<br>';
		}
	}
}
new CreateUniqueArrayVariants($N,$K);
*/
?>