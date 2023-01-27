<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $form = \Core::make('helper/form'); ?>


<form action="<?=URL::to('/dashboard/store/settings/easypost_settings','save')?>" method="post">
    <div class="form-group">
        <?= $form->label('mode',t("Mode")); ?>
        <?= $form->select('mode', array('test'=>t('Test Mode'),'live'=>t('Live Mode')),$mode); ?>
    </div>

    <div class="form-group">
        <?= $form->label('testKey',t("Test API Key")); ?>
        <?= $form->text('testKey',$testKey); ?>
    </div>

    <div class="form-group">
        <?= $form->label('liveKey',t("Live API Key")); ?>
        <?= $form->text('liveKey',$liveKey); ?>
    </div>

    <div class="form-group">
        <?= $form->label('multipleParcels',t("Allow multiple parcel shipping (not supported by all carriers)")); ?>
        <?= $form->select('multipleParcels', array('0'=>t('No'),'1'=>t('Yes')),$multipleParcels); ?>
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-primary float-end" type="submit" ><?= t('Save Settings')?></button>
        </div>
    </div>

</form>
