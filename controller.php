<?php
namespace Concrete\Package\CommunityStoreEasypost;

use Package;
use SinglePage;
use Whoops\Exception\ErrorException;
use Concrete\Package\CommunityStore\Src\CommunityStore\Shipping\Method\ShippingMethodType as StoreShippingMethodType;

class Controller extends Package
{
    protected $pkgHandle = 'community_store_easypost';
    protected $appVersionRequired = '5.7.2';
    protected $pkgVersion = '0.9.9';

    public function on_start()
    {
        require 'vendor/autoload.php';
    }

    public function getPackageDescription()
    {
        return t("EasyPost shipping method for Community Store");
    }

    public function getPackageName()
    {
        return t("Community Store EasyPost Shipping ");
    }

    public function install()
    {
        $installed = Package::getInstalledHandles();
        if(!(is_array($installed) && in_array('community_store',$installed)) ) {
            throw new ErrorException(t('This package requires that Community Store be installed'));
        } else {
            $pkg = parent::install();
            StoreShippingMethodType::add('easypost', 'EasyPost Shipping', $pkg);
            $page = SinglePage::add('/dashboard/store/orders/easypost_shipping',$pkg);
            $data = array('cName' => 'EasyPost Shipping');
            $page->update($data);

            $page = SinglePage::add('/dashboard/store/settings/easypost_settings',$pkg);
            $data = array('cName' => 'EasyPost Settings');
            $page->update($data);
        }
    }

    public function uninstall()
    {
        $pm = StoreShippingMethodType::getByHandle('easypost');
        if ($pm) {
            $pm->delete();
        }
        $pkg = parent::uninstall();
    }

}
?>