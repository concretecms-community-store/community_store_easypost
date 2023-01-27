<?php defined('C5_EXECUTE') or die("Access Denied.");
$dh = Core::make('helper/date');
use \Concrete\Package\CommunityStore\Src\CommunityStore\Utilities\Price as Price;
?>

<?php $task = $controller->getTask(); ?>


<?php if ($task == 'view') { ?>
<div class="ccm-dashboard-header-buttons">
</div>

    <div class="ccm-dashboard-content-full">

        <?php if (!empty($orderList)) { ?>
            <table class="ccm-search-results-table">
                <thead>
                <tr>
                    <th><a><?= t("Order %s","#")?></a></th>
                    <th><a><?= t("Customer Name")?></a></th>
                    <th><a><?= t("Order Date")?></a></th>
                    <th><a><?= t("Payment")?></a></th>
                    <th><a><?= t("Fulfilment Status")?></a></th>
                    <th><a><?= t("Shipping Method")?></a></th>
                    <th><a><?= t("Shipping Charge")?></a></th>
                    <th><a><?= t("Tracking")?></a></th>
                    <th><a><?= t("Shipping")?></a></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($orderList as $order){

                    $cancelled = $order->getCancelled();
                    $canstart = '';
                    $canend = '';
                    if ($cancelled) {
                        $canstart = '<del>';
                        $canend = '</del>';
                    }
                    ?>
                    <tr class="danger">
                        <td><?= $canstart; ?>
                            <a href="<?=URL::to('/dashboard/store/orders/order/',$order->getOrderID())?>"><?= $order->getOrderID()?></a><?= $canend; ?>

                            <?php if ($cancelled) {
                                echo '<span class="text-danger">' . t('Cancelled') .'</span>';
                            }
                            ?>
                        </td>
                        <td><?= $canstart; ?><?php

                            $last = $order->getAttribute('billing_last_name');
                            $first = $order->getAttribute('billing_first_name');

                            if ($last || $first ) {
                                echo $last.", ".$first;
                            } else {
                                echo '<em>' .t('Not found') . '</em>';
                            }

                            ?><?= $canend; ?></td>
                        <td><?= $canstart; ?><?= $dh->formatDateTime($order->getOrderDate())?><?= $canend; ?></td>
                        <td>
                            <?php
                            $refunded = $order->getRefunded();
                            $paid = $order->getPaid();

                            if ($refunded) {
                                echo '<span class="label label-warning">' . t('Refunded') . '</span>';
                            } elseif ($paid) {
                                echo '<span class="label label-success">' . t('Paid') . '</span>';
                            } elseif ($order->getTotal() > 0) {
                                echo '<span class="label label-danger">' . t('Unpaid') . '</span>';
                            } else {
                                echo '<span class="label label-default">' . t('Free Order') . '</span>';
                            }
                            ?>
                        </td>
                        <td><?=t(ucwords($order->getStatus()))?></td>
                        <td><?= $canstart; ?><?= $order->getShippingMethodName(); ?><?= $canend; ?></td>
                        <td><?= $canstart; ?><?=Price::format($order->getShippingTotal())?><?= $canend; ?></td>
                        <td>
                            <?php
                            $trackingURL = $order->getTrackingURL();
                            $trackingCode = $order->getTrackingCode();
                            $trackingID = $order->getTrackingID();
                            $carrier = $order->getCarrier();
                            $shipmentID = $order->getShipmentID();

                            if ($trackingCode) { ?>
                                <p><?= $trackingCode; ?></p>
                            <?php } ?>

                            <?php if ($carrier) { ?>
                            <p><?= t('Carrier');?>: <?= $carrier; ?></p>
                            <?php } ?>

                            <?php if ($trackingURL) { ?>
                                <p><a class="" target="_blank" href="<?= $trackingURL; ?>"><?= t('View Tracking');?></a></p>
                              <?php } ?>
                        </td>
                        <td>
                            <?php if ($shipmentID) { ?>
                                <?php if (!$trackingID) { ?>
                                    <a href="<?= URL::to('/dashboard/store/orders/easypost_shipping/order',$order->getOrderID())?>"><?= t('Buy Shipping / Tracking');?></a>
                                <?php } else {  ?>
                                    <a href="<?= URL::to('/dashboard/store/orders/easypost_shipping/order',$order->getOrderID())?>"><?= t('View Details/Label');?></a>
                            <?php }
                            } elseif (!$shipmentID) {  ?>
                                <?php if (!$trackingID) {  ?>
                                <a href="<?= URL::to('/dashboard/store/orders/easypost_shipping/order',$order->getOrderID())?>"><?= t('Buy Tracking');?></a>
                                    <?php } else { ?>
                                    <a href="<?= URL::to('/dashboard/store/orders/easypost_shipping/order',$order->getOrderID())?>"><?= t('View Details');?></a>
                                    <?php }?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

<?php if (empty($orderList)) { ?>
    <br /><p class="alert alert-info"><?= t('No Orders Found');?></p>
<?php } ?>

<?php if ($paginator->getTotalPages() > 1) { ?>
    <?= $pagination ?>
<?php } ?>
<?php } ?>

<?php if ($task == 'order') { ?>



        <div class="row">
            <div class="col-md-6">
                <h3><a href="<?=URL::to('/dashboard/store/orders/order/',$order->getOrderID())?>"><?= t('Order #');?><?= $order->getOrderID()?></a></h3>


                <?php

            $last = $order->getAttribute('billing_last_name');
            $first = $order->getAttribute('billing_first_name');

            if ($last || $first ) {
                $name = $last.", ".$first;
            } else {
                $name = '<em>' .t('Not found') . '</em>';
            }

            ?>

        <p><strong><?= t('Order Placed');?>:  </strong><?= $dh->formatDateTime($order->getOrderDate())?></p>
        <p><strong><?= t('Customer Name');?>: </strong><?= $name; ?></p>
        <p><strong><?= t('Payment Status');?>: </strong>
            <?php
            $refunded = $order->getRefunded();
            $paid = $order->getPaid();

            if ($refunded) {
                echo '<span class="label label-warning">' . t('Refunded') . '</span>';
            } elseif ($paid) {
                echo '<span class="label label-success">' . t('Paid') . '</span>';
            } elseif ($order->getTotal() > 0) {
                echo '<span class="label label-danger">' . t('Unpaid') . '</span>';
            } else {
                echo '<span class="label label-default">' . t('Free Order') . '</span>';
            }
            ?>
        </p>
        <p><strong><?= t("Fulfilment Status")?>: </strong><?=t(ucwords($order->getStatus()))?></p>
        <p><strong><?= t("Shipping Method")?>: </strong><?= $order->getShippingMethodName(); ?></p>
        <p><strong><?= t("Shipping Price")?>: </strong><?=Price::format($order->getShippingTotal())?></p>

        <br />
        <?php
        $trackingURL = $order->getTrackingURL();
        $trackingCode = $order->getTrackingCode();
        $carrier = $order->getCarrier();

        if ($trackingCode) { ?>
            <p><strong><?= t('Tracking Code');?>:</strong> <?= $trackingCode; ?></strong></p>
        <?php } ?>

        <?php if ($carrier) { ?>
            <p><strong><?= t('Carrier');?>:</strong> <?= $carrier; ?></p>
        <?php } ?>

        <?php if ($trackingURL) { ?>
            <p><a class="" target="_blank" href="<?= $trackingURL; ?>"><?= t('View Tracking');?></a></p>
        <?php } ?>
            <?php if ($shipment && $trackingCode) { ?>
            <p><strong><?= t('Estimated Delivery Date');?>:</strong> <?= $shipment->tracker->est_delivery_date; ?></p>
            <p><strong><?= t('Shipping Status');?>:</strong> <?= $shipment->status; ?></p>

            <?php if ($shipment->refund_status) { ?>
            <p><strong><?= t('Refund Status');?>:</strong> <?= $shipment->refund_status; ?></p>
            <?php } ?>


            <?php

            $refundable = true;

            if ($shipment->status == 'delivered') {
                $refundable = false;
            }
            ?>

            <?php if ($trackingCode && !$shipment->refund_status && $refundable) { ?>
            <h3><?= t('Request Refund');?></h3>
            <form method="post">
                <input type="hidden" name="action" value="refund" />
                <button class="btn btn-warning btn-sm" type="submit"><?= t("Refund")?></button>
            </form>
        <?php } ?>
        <?php }?>


            </div>
        <div class="col-md-6">

            <?php if ($order->getShipmentID() && !$order->getTrackingID()) { ?>
                <h3><?= t("Buy Shipping and Tracking")?></h3>
                <form method="post" class="mb-5">
                    <input type="hidden" name="action" value="buy" />
                    <input type="hidden" name="oID" value="<?= $order->getOrderID(); ?>" />
                    <button class="btn btn-primary btn-sm" type="submit"><?= t("Buy Shipping & Tracking")?></button>
                </form>
            <?php } ?>

            <?php if (!$order->getTrackingID()) { ?>
                <h3><?= t("Buy Tracking")?></h3>
                <form method="post">
                    <div class="form-group">
                        <?= $form->label('carrier',t("Carrier Code")); ?>
                        <?= $form->text('carrier',''); ?>
                    </div>

                    <div class="form-group">
                        <?= $form->label('trackingCode',t("Tracking Code")); ?>
                        <?= $form->text('trackingCode',''); ?>
                    </div>

                    <input type="hidden" name="action" value="buytracking" />
                    <button class="btn btn-primary btn-sm" type="submit"><?= t("Buy Tracking")?></button>
                </form>
            <?php } ?>



            <?php if ($shipment &&  $shipment->postage_label &&  $shipment->postage_label->label_url && !$shipment->refund_status) { ?>
                <p>(<?= t('Click to open label in new window for printing'); ?>)</p>
                <p>
                <a href="<?= $shipment->postage_label->label_url; ?>" target="_blank"><img style="max-width: 100%;" src="<?= $shipment->postage_label->label_url; ?>" /></a>
                </p>
            <?php } ?>
        </div>
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">

            <a href="<?= \URL::to('/dashboard/store/orders/easypost_shipping')?>" class="btn btn-default pull-left"><?= t("Return to view all orders")?></a>
        </div>
    </div>

<?php } ?>


