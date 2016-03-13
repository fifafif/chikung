<?php

abstract class FDebugChannel
{

    const UNDEFINED = 0;
    const DB = 1;
    const SERVICE = 2;
    const NET = 3;
    const SYSTEM = 4;

    public static $channelNames = array('undefined', 'db', 'service', 'net', 'system');

}

class FDebug
{

    private static $_enabled = false;
    private static $enabledChannels = array();
    private static $_channelColorA = array('black', 'blue', 'green', 'yellow', 'orange', 'yellow', 'cyan');
    private static $logToFile = false;
    private static $logFileName = "log.txt";

    public static function setEnabled($enabled)
    {
        self::$_enabled = $enabled;
    }

    public static function setLogToFile($logToFile)
    {
        self::$logToFile = $logToFile;
    }

    public static function setLogFileName($logFileName)
    {
        self::$logFileName = $logFileName;
    }

    public static function enableChannels($channels)
    {
        self::$enabledChannels = $channels;
    }

    private static function printLog($variable, $channelName = 'undefined', $color = 'black')
    {
        if (!self::$_enabled)
        {
            return;
        }

        echo '<div style="margin:2px; padding:2px; font-size:11px; line-height:12px; color:black; border:1px solid ' . $color . '; font-family:Arial;">';
        echo '<pre>';

        echo '<div>channel: ' . $channelName . '</div>';

        echo '<span style="font-weight: bold;">';

        var_dump($variable);

        echo '</span>';

        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        echo '</pre>';
        echo '</div>';
    }

    public static function log($variable, $channel = -1)
    {
        if (self::$logToFile)
        {
            self::appendToFile($variable);
        }

        if (!self::$_enabled)
        {
            return;
        }

        if ($channel > -1 && count(self::$enabledChannels) > 0)
        {
            if (!isset(self::$enabledChannels[$channel]))
            {
                return;
            }
        }

        self::printLog($variable, FDebugChannel::$channelNames[$channel], self::$_channelColorA[$channel]);
    }

    private static function appendToFile($message)
    {
        if (self::$logFileName == null)
        {
            return;
        }

        file_put_contents(self::$logFileName, $message . "\n", FILE_APPEND);
    }

}

?>