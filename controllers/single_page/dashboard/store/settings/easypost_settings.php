<?php

namespace Concrete\Package\CommunityStoreEasypost\Controller\SinglePage\Dashboard\Store\Settings;

use Concrete\Core\Page\Controller\DashboardPageController;
use Config;

class EasypostSettings extends DashboardPageController {

    public function view() {

        $this->set('pageTitle', t('EasyPost Settings'));

        $mode = Config::get('community_store_easypost.mode');
        $liveKey = Config::get('community_store_easypost.liveKey');
        $testKey = Config::get('community_store_easypost.testKey');
        $multipleParcels = Config::get('community_store_easypost.multipleParcels');

        $this->set('mode', $mode);
        $this->set('liveKey', $liveKey);
        $this->set('testKey', $testKey);
        $this->set('multipleParcels', $multipleParcels);
    }

    public function save() {

        $args = $this->post();

        if ($args['multipleParcels']) {
            Config::save('community_store.multiplePackages', true);
        };

        Config::save('community_store_easypost.mode',$args['mode']);
        Config::save('community_store_easypost.liveKey',$args['liveKey']);
        Config::save('community_store_easypost.testKey',$args['testKey']);
        Config::save('community_store_easypost.multipleParcels',$args['multipleParcels']);

        $this->view();
        $this->set('success',t('Settings Saved'));

        //$this->redirect('/dashboard/store/settings/easypost_settings');
    }

}
