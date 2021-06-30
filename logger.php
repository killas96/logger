function generateCallTrace() {
    $e = new Exception();
    $trace = explode("\n", $e->getTraceAsString());
    // reverse array to make steps line up chronologically
    $trace = array_reverse($trace);
    array_shift($trace); // remove {main}
    array_pop($trace); // remove call to this method
    $length = count($trace);
    $result = array();
   
    for ($i = 0; $i < $length; $i++)
    {
        $result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
    }
   
    return "\t" . implode("\n\t", $result);
}

function customLog($text) {
	if(empty($text))
		$text = 'EMPTY VALUE!!!';
	$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
			"Data: ".print_r($text,1).PHP_EOL.
			"Trace: ".generateCallTrace().PHP_EOL.
			"-------------------------".PHP_EOL;

	file_put_contents($_SERVER['DOCUMENT_ROOT']. 'log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
