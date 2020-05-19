<?php

namespace src\helpers;

/**
 * Class SaveFileHelpers
 * SaveFileHelpers is a class help to create and save a file
 *
 * Example usage:
 * $example =  SaveFileHelpers::createFile($fileToSave, $extension);
 *
 * @access public
 * @package src/helpers
 * @author Layiri Batiene <eratos02@yahoo.fr>
 */
class SaveFileHelpers
{
    /**
     *
     *Creation of a file.
     * Create a file with the text provided,
     * and the name of the extension.
     *
     *
     * @param string $fileToSave This is string text, you needs to save
     * @param string $extension this is extension you needs
     *
     * @return void
     */
    public static function createFile($fileToSave, $extension = 'txt')
    {
        $filename = self::filename();
        $myfile = fopen('resources' . '/' . $filename . '.' . $extension, "w") or die("Unable to open file!");
        fwrite($myfile, $fileToSave);
        fclose($myfile);
    }

    /**
     * This function return a file name from dateTime the format days.month.years.hours.minutes.seconds
     * @return false|string
     */
    public static function filename()
    {
        return date('d.m.Y.h.i.s', time());
    }
}