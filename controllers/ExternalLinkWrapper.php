<?php

/**
 * @author Patrick Chitovoro
 * @copyright (c) 2015, ChitoSystems
 *
 */
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
