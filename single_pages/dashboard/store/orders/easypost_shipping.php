<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$dh = Core::make('helper/date');
use \Concrete\Package\CommunityStore\Src\CommunityStore\Utilities\Price as Price;
use \Concrete\Package\CommunityStore\Src\Attribute\Key\StoreOrderKey as StoreOrderKey;
?>


    <div class="ccm-dashboard-header-buttons">
    </div>

<?php if ($shoppingDisabled) { ?>
    <p class="alert alert-warning text-center"><?php echo t('Cart and Ordering features are currently disabled. This setting can be changed via the');?> <a href="<?= \URL::to('/dashboard/store/settings#settings-checkout'); ?>"><?= t('settings page.');?></a></p>
<?php } ?>

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
                            $carrier = $order->getCarrier();

                            if ($trackingCode) { ?>
                                <p><?= $trackingCode; ?></p>
                            <?php } ?>

                            <?php if ($carrier) { ?>
                            <p><?= t('Carrier');?>: <?= $carrier; ?></p>
                            <?php } ?>

                            <?php if ($trackingURL) { ?>
                            <p><a class="" target="_blank" href="<?= $trackingURL; ?>"><?= t('View Tracking');?></a></p>
                            <?php } ?>

                            <?php if (!$order->getTrackingID()) { ?>
                                <form method="post" target="_blank">
                                    <input type="hidden" name="action" value="buytracking" />
                                    <input type="hidden" name="oID" value="<?= $order->getOrderID(); ?>" />
                                    <button class="btn btn-primary btn-sm" type="submit"><?= t("Buy Tracking")?></button>
                                </form>
                            <?php } else { ?>
                                <p><a target="_blank" href="?action=viewlabel&oID=<?= $order->getOrderID(); ?>"><?= t("View Print Label")?></a></p>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($order->getShipmentID()) { ?>
                                <?php if (!$order->getTrackingID()) { ?>
                                <form method="post">
                                    <input type="hidden" name="action" value="buy" />
                                    <input type="hidden" name="oID" value="<?= $order->getOrderID(); ?>" />
                                    <button class="btn btn-primary btn-sm" type="submit"><?= t("Buy Shipping & Tracking")?></button>
                                </form>
                                <?php } else {  ?>

                                <form method="post" target="_blank">
                                    <input type="hidden" name="action" value="refund" />
                                    <input type="hidden" name="oID" value="<?= $order->getOrderID(); ?>" />
                                    <button class="btn btn-warning btn-sm" type="submit"><?= t("Refund")?></button>
                                </form>
                            <?php }
                            } ?>
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



