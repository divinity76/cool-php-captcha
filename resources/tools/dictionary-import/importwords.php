<?php

/**
 * Generate fixed-width dictionary file
 *
 * @author  Jose Rodriguez <josecl@gmail.com>
 * @license GPLv3
 * @link    https://github.com/josecl/cool-php-captcha
 * @package captcha
 * @version 0.3.2
 *
 */


/** Word lengths */
$minLength = 5;
$maxLength = 8;





if ($argc < 3) {
    die("Usage: $argv[0] infile outfile\n");
}





if (!file_exists($argv[1])) {
    die("File '$argv[1]' doesn't exists\n");
}



$fp  = fopen($argv[1], "r");
$fp2 = fopen($argv[2], "w");
sfwrite($fp2, "<?php /*\n");

while ($lin = fgets($fp)) {
    $lin    = trim(strtolower($lin));
    $strlen = strlen($lin);
    if ($strlen>=$minLength && $strlen<=$maxLength && preg_match("/^[a-z]+$/", $lin)) {
        $lin = str_pad($lin, $maxLength);
        sfwrite($fp2, "$lin\n");
    }
}
sfwrite($fp2, "*/    ?>\n");

fclose($fp);
fclose($fp2);

function sfwrite($handle,$data){
    if(strlen($data)!==($written=fwrite($handle,$data))){
        throw new Exception('tried to write '.strlen($data).' bytes to disk, but could only write '.var_export($written,true).' bytes!');
    }
    return $written;
}

?>
