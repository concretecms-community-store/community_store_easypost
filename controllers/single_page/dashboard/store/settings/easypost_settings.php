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

        $this->set('mode', $mode);
        $this->set('liveKey', $liveKey);
        $this->set('testKey', $testKey);
    }

    public function save() {

        $args = $this->post();

        Config::save('community_store_easypost.mode',$args['mode']);
        Config::save('community_store_easypost.liveKey',$args['liveKey']);
        Config::save('community_store_easypost.testKey',$args['testKey']);

        $this->view();
        $this->set('success',t('Settings Saved'));

        //$this->redirect('/dashboard/store/settings/easypost_settings');
    }

}
