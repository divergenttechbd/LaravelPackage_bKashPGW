<?php

namespace Divergent\Bkash;

class BkashLog
{
    public static function readLog()
    {
        $directory = base_path() . "/package/bKash/src/bkash.log";
        if (file_exists($directory)) {
            $filename = $directory;
            $f = fopen($filename, 'r');
            $contents = fread($f, filesize($filename));
            fclose($f);
            return nl2br($contents);
        } else {
            return 'No Log Data!!!';
        }
    }

    public static function writeLog($content)
    {
        $directory = base_path() . "/package/bKash/src/bkash.log";
        file_put_contents($directory, $content, FILE_APPEND | LOCK_EX);
    }
}
