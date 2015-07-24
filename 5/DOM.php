<?php
	$document = new DOMDocument();
	$head = $document->createElement( 'head', ' ' );
	$body = $document->createElement( 'body', ' ' );
	$table = $document->createElement( 'table' );
	$array = array(array('1','2'), array('3','f')	);
	$i = 0;
	$total = 0;
	$cols = 0;
	foreach ($array as $row){
		$i++;
		$tr = $document->createElement( 'tr' );
		$cols = ($cols < count($row)) ? count($row) : $cols;
		foreach ($row as $col){
			$td = $document->createElement( 'td' );
			$td->nodeValue = $col;
			$td->setAttribute( 'class', 'cell' );
			$tr->appendChild( $td );
			$total = (is_numeric($col))? ($total+$col) : $total;
		}
		if ($i%2 == 0) {
			$tr->setAttribute( 'style', 'background-color: #ddd' );
		}
		$table->appendChild ( $tr );
	}
	$tr = $document->createElement( 'tr' );
	$td = $document->createElement( 'td' );
	$td->setAttribute( 'colspan', $cols );
	$td->setAttribute( 'style', 'font-weight: bold' );
	$td->nodeValue = $total;
	$tr->appendChild( $td );
	$table->appendChild ( $tr );
	
	$body->appendChild( $table );
	
	$doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML TRANSITIONAL 1.0//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$title = $document->createElement( 'title', 'Задание №5' );
	$head->appendChild( $title );       
	$html = $document->createElement( 'html' );
	$html->setAttribute( 'xmlns', 'http://www.w3.org/1999/xhtml' );
	$html->setAttribute( 'xml:lang', 'en' );
	$html->setAttribute( 'lang', 'en' );
	$html->appendChild( $head );
	$html->appendChild( $body );
	$document->appendChild( $html );
	
	printf( '%s', $doctype . $document->saveXML( ) );