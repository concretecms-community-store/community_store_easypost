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

    }

    private function initkey() {
        $mode = Config::get('community_store_easypost.mode');

        if ($mode == 'test') {
            $key = Config::get('community_store_easypost.testKey');
        } else {
            $key = Config::get('community_store_easypost.liveKey');
        }

        \EasyPost\EasyPost::setApiKey($key);
    }

    public function order($oID) {
        $this->initkey();
        $order = StoreOrder::getByID($oID);

        if ($order) {
            $this->set("order", $order);
        } else {
            $this->redirect('/dashboard/store/orders/easypost_shipping');
        }

        $shipmentid = $order->getShipmentID();

        if ($shipmentid) {
            try {

                $shipment = \EasyPost\Shipment::retrieve($shipmentid);
            } catch (\EasyPost\Error $e) {
                $this->error = $e->getMessage();
            }

            if ($this->post('action') == 'refund') {
                try {
                    $shipment->refund();
                    $this->set('success', t('Refund Requested'));
                } catch (\EasyPost\Error $e) {
                    $this->error = $e->getMessage();
                }

            }

            if ($this->post('action') == 'buy') {
                $rateid = $order->getRateID();

                try {
                    $shipment->buy(array('rate' => array('id' => $rateid)));
                    $order->setTrackingID($shipment->tracker->id);
                    $order->setTrackingCode($shipment->tracking_code);
                    $order->setTrackingURL($shipment->tracker->public_url);
                    $order->setCarrier($shipment->tracker->carrier);
                    $order->save();
                    $this->set('success', t('Shipping Purchased'));
                } catch(\EasyPost\Error $e) {
                    $this->error = $e->getMessage();
                }
            }


        }

        if ($this->post('action') == 'buytracking') {

            try {
                $tracker = \EasyPost\Tracker::create(array(
                    "tracking_code" => $this->post('trackingCode'),
                    "carrier" => $this->post('carrier')
                ));

                $order->setTrackingID($tracker->id);
                $order->setTrackingCode($tracker->tracking_code);
                $order->setTrackingURL($tracker->public_url);
                $order->setCarrier($this->post('carrier'));
                $order->save();

                $this->set('success', t('Tracking Purchased'));
            } catch(\EasyPost\Error $e) {
                $this->error = $e->getMessage();
            }
        }

        $this->set('shipment', $shipment);
        $this->set('pageTitle', t("EasyPost Shipping Details for Order #") . $order->getOrderID());
    }

}
