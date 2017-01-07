<?php

namespace Concrete\Package\CommunityStoreEasypost\Controller\SinglePage\Dashboard\Store\Orders;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Package\CommunityStore\Src\CommunityStore\Order\OrderList as StoreOrderList;
use Concrete\Package\CommunityStore\Src\CommunityStore\Order\OrderStatus\OrderStatus as StoreOrderStatus;
use Concrete\Package\CommunityStore\Src\CommunityStore\Order\Order as StoreOrder;
use Config;

class EasypostShipping extends DashboardPageController {

    public function view() {
        $this->set('pageTitle', t('EasyPost Orders'));

        $orderList = new StoreOrderList();

        if ($this->get('keywords')) {
            $orderList->setSearch($this->get('keywords'));
        }

        $orderList->setItemsPerPage(20);
        $orderList->setIsShippable(true);

        $paginator = $orderList->getPagination();
        $pagination = $paginator->renderDefaultView();
        $this->set('orderList',$paginator->getCurrentPageResults());
        $this->set('pagination',$pagination);
        $this->set('paginator', $paginator);
        $this->set('orderStatuses', StoreOrderStatus::getList());
        $this->requireAsset('css', 'communityStoreDashboard');
        $this->requireAsset('javascript', 'communityStoreFunctions');
        $this->set('statuses', StoreOrderStatus::getAll());

        if (Config::get('community_store.shoppingDisabled') == 'all') {
            $this->set('shoppingDisabled', true);
        }

        $mode = Config::get('community_store_easypost.mode');

        if ($mode == 'test') {
            $key = Config::get('community_store_easypost.testKey');
        } else {
            $key = Config::get('community_store_easypost.liveKey');
        }


        \EasyPost\EasyPost::setApiKey($key);



        if ($this->post() && $this->post('action') == 'buy') {
            $order = StoreOrder::getByID($this->post('oID'));

            $shipmentid = $order->getShipmentID();
            $rateid = $order->getRateID();

            $shipment = \EasyPost\Shipment::retrieve($shipmentid);

            $shipment->buy(array('rate' => array('id' => $rateid)));
            $order->setTrackingID($shipment->tracker->id);
            $order->setTrackingCode($shipment->tracking_code);
            $order->setTrackingURL($shipment->tracker->public_url);
            $order->setCarrier($shipment->tracker->carrier);
            $order->save();
        }

        if ($this->get('action') == 'viewlabel') {
            $order = StoreOrder::getByID($this->get('oID'));
            $shipmentid = $order->getShipmentID();
            $shipment = \EasyPost\Shipment::retrieve($shipmentid);
            $this->redirect($shipment->postage_label->label_url);
        }

        if ($this->get('action') == 'refund') {
            $order = StoreOrder::getByID($this->get('oID'));
            $shipmentid = $order->getShipmentID();
            $shipment = \EasyPost\Shipment::retrieve($shipmentid);
            $shipment->refund();
            print_r($shipment);
        }

    }

}
