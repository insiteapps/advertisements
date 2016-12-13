<?php

/**
 * Class Advertisement
 */
class Advertisement extends DataObject
{
    private static $db = array(
        "Title" => "Varchar(255)",
        "ExternalLink" => "Varchar(150)",
        "Description" => "Text",
        "SortOrder" => "Int"
    );
    private static $has_one = array(
        "Image" => "AdvertisementImage",
        "LinkedPage" => "SiteTree",
    );

    private static $casting = array(
        "FullTitle" => "HTMLText",
        "Link" => "Varchar",
    );

    private static $searchable_fields = array(
        "Title" => "PartialMatchFilter"
    );
    private static $singular_name = "Advertisement";
    private static $defaults = array(
        "SortOrder" => 100
    );
    static $summary_fields = array(
        'Thumbnail',
        "Title" => "Title",
        "Link" => "Link"
    );

    function getLink()
    {
        $link = '';
        if ($this->ExternalLink) {
            $linkManager = new ExternalLinkWrapper();
            $link = $this->ExternalLink;
            return $linkManager->wrapper($link);
        } elseif ($this->LinkedPageID) {
            return $this->LinkedPage()->Link();
        }
        return 'javascript:void(0)';
    }

    function Link()
    {
        return $this->getLink();
    }

    function getThumbnail()
    {
        $image = $this->Image();
        if ($image && $image->ID) {
            return $image->CMSThumbnail();
        }
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->Sort) {
            $this->Sort = self::$defaults["Sort"];
        }

        $url = $this->ExternalLink;
        if ($url) {
            if (strtolower(substr($url, 0, 8)) != 'https://' && strtolower(substr($url, 0, 7)) != 'http://') {
                $this->ExternalLink = 'http://' . $url;
            }
        }
    }

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName(array('SortOrder'));

        $UploadField = UploadField::create('Image');
        $UploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $UploadField->setConfig('allowedMaxFileNumber', 1);
        $UploadField->setFolderName('Uploads/Ads/');
        $f->addFieldToTab("Root.Main", $UploadField);
        return $f;
    }

}