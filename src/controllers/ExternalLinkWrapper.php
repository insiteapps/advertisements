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
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;

class ExternalLinkWrapper extends Controller
{

    private $link;
    public static $allowed_actions = array(
        'go'
    );

    function Link($action = null)
    {
        return "linking/$action";
    }

    public function __construct()
    {
        parent::__construct();
    }

    function wrapper($link)
    {
        $this->link = $link;
        $wrappedLink = $this->baseControllerLink() . "go/?l=" . base64_encode($link);
        return $wrappedLink;
    }

    public function go()
    {
        $link = filter_input(INPUT_GET, "l");
        if ($link) {
            return $this->redirect(base64_decode($link));
        }
        $this->redirectBack();
    }

    private function baseControllerLink()
    {
        $baseLink = Director::baseURL();
        return $baseLink . $this->Link();
    }

}
