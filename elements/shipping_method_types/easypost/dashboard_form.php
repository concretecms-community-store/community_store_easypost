<?php
defined('C5_EXECUTE') or die("Access Denied.");
extract($vars); ?>


<div class="row">
    <div class="col-md-4">
        <h4><?= t('From Address (required)'); ?></h4>


        <div class="form-group">
            <?= $form->label('company',t("Company")); ?>
            <?= $form->text('company',$smtm->getCompany()); ?>
        </div>

        <div class="form-group">
            <?= $form->label('street1',t("Street 1")); ?>
            <?= $form->text('street1',$smtm->getStreet1()); ?>
        </div>


        <div class="form-group">
            <?= $form->label('street2',t("Street 2")); ?>
            <?= $form->text('street2',$smtm->getStreet2()); ?>
        </div>


        <div class="form-group">
            <?= $form->label('city',t("City")); ?>
            <?= $form->text('city',$smtm->getCity()); ?>
        </div>

        <div class="form-group">
            <?= $form->label('state',t("State")); ?>
            <?= $form->text('state',$smtm->getState()); ?>
        </div>

        <div class="form-group">
            <?= $form->label('zip',t("Zip")); ?>
            <?= $form->text('zip',$smtm->getZip()); ?>
        </div>

        <div class="form-group">
            <?= $form->label('country',t("Country")); ?>
            <?= $form->text('country',$smtm->getCountry()); ?>
        </div>

        <div class="form-group">
            <?= $form->label('phone',t("Phone")); ?>
            <?= $form->text('phone',$smtm->getPhone()); ?>
        </div>
    </div>


    <div class="col-md-4">

        <h4><?= t('Fallback Size/Weights'); ?></h4>
        <p><?= t('If cart weight or size(s) are zero, assume the following values'); ?></p>
        <div class="form-group">
            <?= $form->label('fallbackWeight',t("Fallback Weight")); ?>
            <div class="input-group">
                <?= $form->text('fallbackWeight',$smtm->getFallbackWeight()); ?>
                <div class="input-group-addon input-group-text">oz</div>
            </div>
        </div>

        <div class="form-group">
            <?= $form->label('fallbackWidth',t("Fallback Width")); ?>
            <div class="input-group">
                <?= $form->text('fallbackWidth',$smtm->getFallbackWidth()); ?>
                <div class="input-group-addon input-group-text">in</div>
            </div>
        </div>

        <div class="form-group">
            <?= $form->label('fallbackLength',t("Fallback Length")); ?>
            <div class="input-group">
                <?= $form->text('fallbackLength',$smtm->getFallbackLength()); ?>
                <div class="input-group-addon input-group-text">in</div>
            </div>
        </div>

        <div class="form-group">
            <?= $form->label('fallbackHeight',t("Fallback Height")); ?>
            <div class="input-group">
                <?= $form->text('fallbackHeight',$smtm->getFallbackHeight()); ?>
                <div class="input-group-addon input-group-text">in</div>
            </div>
        </div>

        <h4><?= t('No rate fallback'); ?></h4>

        <p><label>
                <?= $form->checkbox('noMatch','1', $smtm->getNoMatch(), array('id'=>'noMatch')); ?>
                <?= t('Offer fallback option when no offers');?>
            </label></p>

        <div id="nomatchfields" style="<?= ($smtm->getNoMatch() ? '' : 'display: none;') ;?>">
            <div class="form-group">
                <?= $form->label('noMatchLabel',t("Label")); ?>
                <?= $form->text('noMatchLabel',$smtm->getNoMatchLabel()); ?>
            </div>

            <div class="form-group">
                <?= $form->label('noMatchDetails',t("Details")); ?>
                <?= $form->text('noMatchDetails',$smtm->getNoMatchDetails()); ?>
            </div>

            <div class="form-group">
                <?= $form->label('noMatchRate',t("Rate")); ?>
                <div class="input-group">
                    <div class="input-group-addon">
                        <?=  Config::get('community_store.symbol');?>
                    </div>
                    <?= $form->text('noMatchRate',$smtm->getNoMatchRate()); ?>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <h4><?= t('Country Restriction');?></h4>
        <div class="form-group">
            <?= $form->label('countriesSelected',t("Apply to selected countries only")); ?>
            <select class="form-control" style="height: 300px" multiple name="countriesSelected[]">
                <?php $selectedCountries = explode(',',$smtm->getCountriesSelected()); ?>
                <?php foreach($countryList as $code=>$country){?>
                    <option value="<?= $code?>"<?php if(in_array($code,$selectedCountries)){echo " selected";}?>><?= $country?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <?= $form->label('carrierFilter',t("Carrier Restriction")); ?>
            <?= $form->textarea('carrierFilter',$smtm->getCarrierFilter()); ?>
            <span class="help-block"><?= t('Enter carrier names to restrict to, one on each line');?></span>
        </div>

        <div class="form-group">
            <?= $form->label('serviceFilter',t("Service Restriction")); ?>
            <?= $form->textarea('serviceFilter',$smtm->getServiceFilter()); ?>
            <span class="help-block"><?= t('Enter service names to restrict to, one on each line');?></span>
        </div>

        <div class="form-group">
            <?= $form->label('adjustmentFactor',t("Price Adjustment Factor")); ?>
            <div class="input-group">
                <?= $form->text('adjustmentFactor',$smtm->getAdjustmentFactor()); ?>
                <div class="input-group-addon">%</div>
            </div>
        </div>

        <div class="form-group">
            <?= $form->label('rateType',t("Rate Type")); ?>
            <?= $form->select('rateType', array('rate'=>t('Actual Rate'),'retail_rate'=>t('Retail Rate'),'list_rate'=>t('List Rate')), $smtm->getRateType()); ?>
        </div>

    </div>

</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('#noMatch').change(function(){
            $('#nomatchfields').toggle();
        });
    });
</script>
