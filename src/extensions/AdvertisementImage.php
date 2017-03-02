<?php
/**
 *
 * @copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * @package insiteapps
 * @author Patrick Chitovoro  <patrick@insiteapps.co.za>
 * All rights reserved. No warranty, explicit or implicit, provided.
 *
 * NOTICE:  All information contained herein is, and remains the property of Insite Apps and its suppliers,  if any.  
 * The intellectual and technical concepts contained herein are proprietary to Insite Apps and its suppliers and may be covered by South African. and Foreign Patents, patents in process, and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material is strictly forbidden unless prior written permission is obtained from Insite Apps.
 *
 * There is no freedom to use, share or change this file.
 *
 *
 */
namespace InsiteApps\Advertisement;
use SilverStripe\Assets\Image;

class AdvertisementImage extends Image
{

    function generateCroppedResize($gd, $width, $height)
    {
        return $gd->croppedResize($width, $height);
    }

    function generatePaddedResize($gd, $width, $height)
    {
        return $gd->paddedResize($width, $height);
    }

    function generateFittedResize($gd, $width, $height)
    {
        return $gd->fittedResize($width, $height);
    }

    function generateResize($gd, $width, $height)
    {
        return $gd->resize($width, $height);
    }

    function generateResizeByWidth($gd, $width)
    {
        return $gd->resizeByWidth($width);
    }

    function generateResizeByHeight($gd, $height)
    {
        return $gd->resizeByHeight($height);
    }

    function generateResizeRatio($gd, $width, $height)
    {
        return $gd->resizeRatio($width, $height);
    }

}
