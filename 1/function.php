<?php
$arr_test = array("1","2","4","7","1","6","2","8");
$arr_test_2 = array("10","10","11");
$group = 3;
split_array($arr_test,$group);
# v1.0
function split_array($array,$group){
	if(is_array($array) && ($group >= 0)){
		$arr_rezult = array();
		$arr_sum = 0;
		foreach($array as $var) { 
			if(is_numeric($var)) { 
				$arr_sum += $var;
			}else{
				echo "Массив должен состоять из чисел";
				return NULL;
			}
		}
		// отсортируем исходный массив от большего к меньшему
		rsort($array);		
		$etalon = floor($arr_sum/$group); // средняя сумма элементов одной группы (эталон)
		$cor = $etalon + ($etalon+1)*$group - $arr_sum; // мин погрешность
		$i = $group;
		// проходит по всем элементам массива
		foreach($array as $key => $var){
			// сначала заполняем строки сверху вниз
			if ($i > 0){
				$arr_rezult[$i-1][0][] = $var;
				$arr_rezult[$i-1][1]['sum'] = $var;
				$i--;
			}else{
				// даллее заполняем строки снизу вверх, проверяю сумму значений в группе для приведения к эталонному значению
				$flag = FALSE;
				for($l = 0; $l < count($arr_rezult);$l++){
					if( ($arr_rezult[$l][1]['sum']+ $var) <= $etalon ){
						$arr_rezult[$l][0][] = $var;
						$arr_rezult[$l][1]['sum'] += $var;
						$flag = TRUE;
						break;
					}
				}
				//если больше ни одна группа не может быть меньше или равна эталону, 
				//снизу вверху продолжаем дополнять по 1 числу с макс.значением, т.е. исходны массив отсортирован от большего к меньшему
				if(!$flag){
					for($l = 0; $l < count($arr_rezult);$l++){
						if( ($arr_rezult[$l][1]['sum']+ $var)  < $cor ){
							$arr_rezult[$l][0][] = $var;
							$arr_rezult[$l][1]['sum'] += $var;
							$flag = TRUE;
							break;
						}
					}
					// мы сформировали группы с максимальным приближением к эталону, но числа в исх.массиве остались - раскидываем их с сохранением среднего веса суммы группы
					if(!$flag){
						$arr_rezult[0][0][] = $var;
						$arr_rezult[0][1]['sum'] += $var;
					}
				}
					
			}
		}
		print_r($arr_rezult);
		return NULL;
	}else{
		echo "Введите корректные данные";
		return NULL;
	}
	return NULL;
}