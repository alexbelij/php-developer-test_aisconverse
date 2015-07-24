<?php
	error_reporting(-1) ;
	ini_set('display_errors', 'On');

	$document = new DOMDocument();
	$doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML TRANSITIONAL 1.0//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$html = $document->createElement( 'html' );
	$html->setAttribute( 'xmlns', 'http://www.w3.org/1999/xhtml' );
	$html->setAttribute( 'xml:lang', 'en' );
	$html->setAttribute( 'lang', 'en' );
	$head = $document->createElement( 'head', ' ' );
    $body = $document->createElement( 'body', ' ' );
	$title = $document->createElement( 'title', 'Задание №5' );
	$head->appendChild( $title );
	$html->appendChild( $head );
	/* ------------------------------------------------------------ */
	$array = array(
		array("test", 1000, "test"),
		array(500, "aple", "banana"),
		array("lol", "ololo", 1),
	);
	$colspan = 0;
	$summ = 0;
	$i = 0;
	$table = $document->createElement('table');
	foreach ($array as $row) {
		$i++;
		$tr = $document->createElement('tr');
		if($i % 2 == 0) {
			$tr->setAttribute( 'style', 'background-color: #ddd' );
		}
		$cols = count($row);
		foreach($row as $col) {
			$td = $document->createElement('td');
			$td->setAttribute( 'class', 'cell' );
			//$td->nodeValue = $col;
			$td_value = $document->createTextNode($col);
			$td->appendChild($td_value);
			$tr->appendChild($td);
			$colspan = ($colspan < $cols) ? $cols : $colspan;
			if(is_numeric($col)) {
				$summ += $col;
			}
		}
		$table->appendChild($tr);
	}
	$tr = $document->createElement('tr');
	$td = $document->createElement('td');
	$td->setAttribute( 'colspan', $colspan );
	$td->setAttribute( 'style', 'font-weight: bold;' );
	$td_value = $document->createTextNode($summ);
	$td->appendChild($td_value);
	$tr->appendChild($td);
	$table->appendChild($tr);
	
	$body->appendChild($table);
	$html->appendChild( $body );
	$document->appendChild( $html );
    printf( '%s', $doctype . $document->saveHTML() );
?>