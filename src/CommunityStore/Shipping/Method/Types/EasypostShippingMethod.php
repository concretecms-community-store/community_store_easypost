<?php

namespace Concrete\Package\CommunityStoreEasypost\Src\CommunityStore\Shipping\Method\Types;

use Core;
use Config;
use Concrete\Package\CommunityStore\Src\CommunityStore\Shipping\Method\ShippingMethodTypeMethod;
use Concrete\Package\CommunityStore\Src\CommunityStore\Cart\Cart as StoreCart;
use Concrete\Package\CommunityStore\Src\CommunityStore\Customer\Customer as StoreCustomer;
use Concrete\Package\CommunityStore\Src\CommunityStore\Shipping\Method\ShippingMethodOffer as StoreShippingMethodOffer;

/**
 * @Entity
 * @Table(name="CommunityStoreEasypostMethods")
 */
class EasypostShippingMethod extends ShippingMethodTypeMethod
{
    public function getShippingMethodTypeName() {
        return t('EasyPost Shipping');
    }

    /**
     * @Column(type="string",nullable=true)
     */
    protected $company;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $street1;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $street2;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $city;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $state;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $country;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $zip;

    /**
     * @Column(type="string",nullable=true)
     */
    protected $phone;

    /**
     * @Column(type="text",nullable=true)
     */
    protected $countriesSelected;

    /**
     * @Column(type="float",nullable=true)
     */
    protected $fallbackWeight;

    /**
     * @Column(type="float",nullable=true)
     */
    protected $fallbackWidth;

    /**
     * @Column(type="float",nullable=true)
     */
    protected $fallbackLength;

    /**
     * @Column(type="float",nullable=true)
     */
    protected $fallbackHeight;

    /**
     * @Column(type="boolean",nullable=true)
     */
    protected $noMatch;

    /**
     * @Column(type="text",nullable=true)
     */
    protected $noMatchLabel;

    /**
     * @Column(type="text",nullable=true)
     */
    protected $noMatchDetails;

    /**
     * @Column(type="float")
     */
    protected $noMatchRate;

    /**
     * @Column(type="text",nullable=true)
     */
    protected $carrierFilter;

    /**
     * @Column(type="text",nullable=true)
     */
    protected $serviceFilter;

    /**
     * @Column(type="float",nullable=true)
     */
    protected $adjustmentFactor;

    /**
     * @Column(type="text",nullable=true)
     */
    protected $rateType;


    public function getKey() {
        $mode = Config::get('community_store_easypost.mode');

        if ($mode == 'test') {
            return Config::get('community_store_easypost.testKey');
        } else {
            return Config::get('community_store_easypost.liveKey');
        }
    }

    public function getMode()
    {
        return Config::get('community_store_easypost.mode');
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getStreet1()
    {
        return $this->street1;
    }

    public function setStreet1($street1)
    {
        $this->street1 = $street1;
    }

    public function getStreet2()
    {
        return $this->street2;
    }

    public function setStreet2($street2)
    {
        $this->street2 = $street2;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCountry()
    {
        return $this->country;
    }


    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCountriesSelected()
    {
        return $this->countriesSelected;
    }

    public function setCountriesSelected($countriesSelected)
    {
        $this->countriesSelected = $countriesSelected;
    }

    public function getFallbackWeight()
    {
        return $this->fallbackWeight;
    }

    public function setFallbackWeight($fallbackWeight)
    {
        $this->fallbackWeight = $fallbackWeight;
    }

    public function getFallbackWidth()
    {
        return $this->fallbackWidth;
    }

    public function setFallbackWidth($fallbackWidth)
    {
        $this->fallbackWidth = $fallbackWidth;
    }

    public function getFallbackLength()
    {
        return $this->fallbackLength;
    }

    public function setFallbackLength($fallbackLength)
    {
        $this->fallbackLength = $fallbackLength;
    }

    public function getFallbackHeight()
    {
        return $this->fallbackHeight;
    }

    public function setFallbackHeight($fallbackHeight)
    {
        $this->fallbackHeight = $fallbackHeight;
    }

    public function getNoMatch()
    {
        return $this->noMatch;
    }

    public function setNoMatch($noMatch)
    {
        $this->noMatch = $noMatch;
    }

    public function getNoMatchLabel()
    {
        return $this->noMatchLabel;
    }

    public function setNoMatchLabel($noMatchLabel)
    {
        $this->noMatchLabel = $noMatchLabel;
    }

    public function getNoMatchDetails()
    {
        return $this->noMatchDetails;
    }

    public function setNoMatchDetails($noMatchDetails)
    {
        $this->noMatchDetails = $noMatchDetails;
    }

    public function getNoMatchRate()
    {
        return $this->noMatchRate;
    }

    public function setNoMatchRate($noMatchRate)
    {
        $this->noMatchRate = $noMatchRate;
    }

    public function getCarrierFilter()
    {
        return $this->carrierFilter;
    }

    public function setCarrierFilter($carrierFilter)
    {
        $this->carrierFilter = $carrierFilter;
    }

    public function getServiceFilter()
    {
        return $this->serviceFilter;
    }

    public function setServiceFilter($serviceFilter)
    {
        $this->serviceFilter = $serviceFilter;
    }

    public function getAdjustmentFactor()
    {
        return $this->adjustmentFactor;
    }

    public function setAdjustmentFactor($adjustmentFactor)
    {
        $this->adjustmentFactor = $adjustmentFactor;
    }

    public function getRateType()
    {
        return $this->rateType;
    }

    public function setRateType($rateType)
    {
        $this->rateType = $rateType;
    }

    public function addMethodTypeMethod($data)
    {
        return $this->addOrUpdate('add', $data);
    }

    public function update($data)
    {
        return $this->addOrUpdate('update', $data);
    }

    private function addOrUpdate($type, $data)
    {
        if ($type == "update") {
            $sm = $this;
        } else {
            $sm = new self();
        }

        $sm->setCompany($data['company']);
        $sm->setStreet1($data['street1']);
        $sm->setStreet2($data['street2']);
        $sm->setCity($data['city']);
        $sm->setState($data['state']);
        $sm->setCountry($data['country']);
        $sm->setZip($data['zip']);
        $sm->setPhone($data['phone']);

        if (is_array($data['countriesSelected'])) {
            $sm->setCountriesSelected(implode(',', $data['countriesSelected']));
        } else {
            $sm->setCountriesSelected('');
        }

        $sm->setNoMatch($data['noMatch'] ? '1' : '0');
        $sm->setNoMatchLabel($data['noMatchLabel']);
        $sm->setNoMatchDetails($data['noMatchDetails']);
        $sm->setNoMatchRate($data['noMatchRate']);

        $sm->setFallbackHeight((int)$data['fallbackHeight']);
        $sm->setFallbackWidth((int)$data['fallbackWidth']);
        $sm->setFallbackLength((int)$data['fallbackLength']);
        $sm->setFallbackWeight((int)$data['fallbackWeight']);
        $sm->setCarrierFilter(trim($data['carrierFilter']));
        $sm->setServiceFilter(trim($data['serviceFilter']));
        $sm->setAdjustmentFactor(trim($data['adjustmentFactor']));
        $sm->setRateType(trim($data['rateType']));

        $em = \ORM::entityManager();
        $em->persist($sm);
        $em->flush();

        return $sm;
    }

    public function dashboardForm($shippingMethod = null)
    {
        $this->set('form', Core::make("helper/form"));
        $this->set('smt', $this);
        if (is_object($shippingMethod)) {
            $smtm = $shippingMethod->getShippingMethodTypeMethod();
        } else {
            $smtm = new self();
        }

        $this->set('countryList', \Core::make('helper/lists/countries')->getCountries());
        $this->set("smtm", $smtm);
    }

    public function isEligible()
    {
//        $subtotal = StoreCalculator::getSubTotal();
//        $totalWeight = StoreCart::getCartWeight();
        $customer = new StoreCustomer();
        $shippingcountry = $customer->getAddressValue('shipping_address', 'country');

        $offerCountries = $this->getCountriesSelected();
        if ($offerCountries) {
            $countries = explode(',', $offerCountries);
            return in_array($shippingcountry, $countries);
        }

        // use information from the above (or elsewhere) to determine if shipping offer can be used
        return true;
    }

    public function getOffers() {

        //$totalWeight = number_format(StoreCart::getCartWeight('oz'), 2, '.', '');

        $customer = new StoreCustomer();

        $sizeunit = \Config::get('community_store.sizeUnit');
        $storeweightunit = \Config::get('community_store.weightUnit');
        $weightmultiplier = 1;
        $sizemultiplier = 1;

        // convert to inches for gateway
        if ($sizeunit == 'cm') {
            $sizemultiplier = 0.39;
        }

        if ($sizeunit == 'mm') {
            $sizemultiplier = 0.039;
        }

        // convert to ounces
        if ($storeweightunit == 'kg') {
            $weightmultiplier *= 35.274;
        }

        if ($storeweightunit =='lb') {
            $weightmultiplier *= 16;
        }

        $invalid = false;

//        if ($totalWeight <= 0 ) {
//            if ($this->getFallbackWeight() > 0) {
//                $totalWeight = $this->getFallbackWeight();
//            }
//        }

//        if ($totalWeight <= 0) {
//            $invalid = true;
//        }

        if (!$invalid) {
            try {
                \EasyPost\EasyPost::setApiKey($this->getKey());

                $shipping_first_name = $customer->getValue("shipping_first_name");
                $shipping_last_name = $customer->getValue("shipping_last_name");

                // this is used to make each order unique (when same order with same details can be placed twice)
                $lastorderid = $customer->getLastOrderID();

                $to_address_values = array(
                    "name" => $shipping_first_name . ' ' . $shipping_last_name,
                    "street1" => $customer->getAddressValue('shipping_address', 'address1'),
                    "street2" => $customer->getAddressValue('shipping_address', 'address2'),
                    "city" => $customer->getAddressValue('shipping_address', 'city'),
                    "state" => $customer->getAddressValue('shipping_address', 'state_province'),
                    "zip" => $customer->getAddressValue('shipping_address', 'postal_code'),
                    "country" => $customer->getAddressValue('shipping_address', 'country'),
                    "phone" => $customer->getValue("billing_phone")
                );

                $from_address_values = array(
                    "company" => $this->getCompany(),
                    "street1" => $this->getStreet1(),
                    "street2" => $this->getStreet2(),
                    "city" => $this->getCity(),
                    "state" => $this->getState(),
                    "zip" => $this->getZip(),
                    "country" => $this->getCountry(),
                    "phone" => $this->getPhone()
                );

                $cartitems = StoreCart::getCart();
                $seperateboxes = array();
                $packboxes = array();

                $multipleParcels = \Config::get('community_store_easypost.multipleParcels');

                foreach ($cartitems as $cartitem) {

                    for ($i = 0; $i < $cartitem['product']['qty']; $i++) {
                        $product = $cartitem['product']['object'];

                        if ($product->isSeperateShip() && $multipleParcels) {
                            $seperateboxes  = array_merge($seperateboxes, $product->getPackages());
                        } else {
                            $packboxes = array_merge($packboxes, $product->getPackages());
                        }
                    }
                }

                if (!empty($packboxes)) {
                    $combinedweight = 0;
                    $laff = new LAFFPack();

                    $boxes = array();

                    foreach($packboxes as $box) {
                        $combinedweight += $box->getWeight();

                        $boxes[] = array(
                            "length" => $box->getLength() ,
                            "width" => $box->getWidth() ,
                            "height" => $box->getHeight(),
                        );

                    }

                    $laff->pack($boxes);
                    $dimensions = $laff->get_container_dimensions();

                    $parcel_sizes = [
                        "length" => $dimensions['length'] * $sizemultiplier,
                        "width" => $dimensions['width'] * $sizemultiplier,
                        "height" => $dimensions['height'] * $sizemultiplier,
                        "weight" => $combinedweight * $weightmultiplier];

                    if (!$parcel_sizes['length']) {
                        $parcel_sizes['length'] = $this->getFallbackLength() * $sizemultiplier;
                    }

                    if (!$parcel_sizes['width']) {
                        $parcel_sizes['width'] = $this->getFallbackWidth() * $sizemultiplier;
                    }

                    if (!$parcel_sizes['height']) {
                        $parcel_sizes['height'] = $this->getFallbackHeight() * $sizemultiplier;
                    }

                    if (!$parcel_sizes['weight']) {
                        $parcel_sizes['weight'] = $this->getFallbackWeight() * $weightmultiplier;
                    }

                }

                $boxesfingerprint = serialize(array_merge($seperateboxes, $packboxes));

                $shipping_fingerprint_data = array('to' => $to_address_values, 'from' => $from_address_values, 'parcel' => $boxesfingerprint, 'lastorderid'=>$lastorderid);
                $shipping_fingerprint = md5(serialize($shipping_fingerprint_data));

                $cache = \Core::make('cache/expensive');
                $shippingcache = $cache->getItem('cs_easypost/' . $shipping_fingerprint);

                if ($shippingcache->isMiss()) {
                    $shippingcache->lock();

                    $to_address = \EasyPost\Address::create(
                        $to_address_values
                    );
                    $from_address = \EasyPost\Address::create(
                        $from_address_values
                    );

                    $shipments = array();

                    if (!empty($seperateboxes)) {
                        foreach($seperateboxes as $seperatebox) {
                            $shipments[] = [
                                'parcel'=>[
                                    "length" => $seperatebox->getLength() * $sizemultiplier,
                                    "width" => $seperatebox->getWidth() * $sizemultiplier ,
                                    "height" => $seperatebox->getHeight() * $sizemultiplier ,
                                    "weight" => $seperatebox->getWeight() * $weightmultiplier
                                ]
                            ];
                        }

                        // add extra box of combined items if necessary
                        if (isset($parcel_sizes)) {
                            $shipments[] = [
                                'parcel'=>$parcel_sizes
                            ];
                        }

                        $shipment = \EasyPost\Order::create(
                            [
                                "to_address" => $to_address,
                                "from_address" => $from_address,
                                "shipments" => $shipments
                            ]
                        );

                    } else {
                        $parcel = \EasyPost\Parcel::create(
                            $parcel_sizes
                        );

                        $shipment = \EasyPost\Shipment::create(
                            [
                                "to_address" => $to_address,
                                "from_address" => $from_address,
                                "parcel" => $parcel
                            ]
                        );
                    }


                    if (version_compare(\Config::get('concrete.version'), '8.0', '>=')) {
                        $shippingcache->set($shipment)->expiresAfter(60 * 5)->save(); // expire after 5 minutes
                    } else {
                        $shippingcache->set($shipment, 60 * 5); // expire after 5 minutes
                    }

                } else {
                    $shipment = $shippingcache->get();
                }
            } catch(\EasyPost\Error $e) {
                //$e->prettyPrint();
                $invalid = true;
            }
        }

        $offers = array();

        $adjustmentFactor = $this->getAdjustmentFactor();

        if (!$adjustmentFactor) {
            $adjustmentFactor = 1;
        } else {
            $adjustmentFactor = 1 + ($adjustmentFactor / 100);
        }

        $carrierFilter = trim($this->carrierFilter);
        $serviceFilter = trim($this->serviceFilter);

        $carrierFilter = explode("\n", $carrierFilter);
        $serviceFilter = explode("\n", $serviceFilter);

        $rateType = $this->getRateType();

        if (!$rateType) {
            $rateType = 'rate';
        }


        if (!$invalid && $shipment && $shipment->rates && count($shipment->rates) > 0) {
            foreach ($shipment->rates as $rate) {

                if (!$this->carrierFilter|| in_array($rate->carrier, $carrierFilter)) {
                    if (!$this->serviceFilter || in_array($rate->service, $serviceFilter)) {
                        $offer = new StoreShippingMethodOffer();

                        // then set the rate
                        $offer->setRate($rate->$rateType * $adjustmentFactor);

                        // then set a label for it
                        $offer->setOfferLabel($rate->carrier . ' - ' . $rate->service);

                        if ($rate->delivery_days > 0) {
                            $offer->setOfferDetails(t('Estimated Delivery: %s days', $rate->delivery_days));
                        }

                        $offer->setShipmentID($shipment->id);
                        $offer->setRateID($rate->id);

                        // add it to the array
                        $offers[] = $offer;
                    }
                }
            }
        } elseif($this->getNoMatch()) {
            $offer = new StoreShippingMethodOffer();
            $offer->setRate($this->getNoMatchRate());
            $offer->setOfferLabel($this->getNoMatchLabel());
            $offer->setOfferDetails($this->getNoMatchDetails());
            $offers[] = $offer;
        }

        return $offers;
    }

}




/**
 * Largest Area Fit First (LAFF) 3D box packing algorithm class
 *
 * @author Maarten de Boer <info@maartendeboer.net>
 * @copyright Maarten de Boer 2012
 * @version 1.0
 *
 * Also see this PDF document for an explanation about the LAFF algorithm:
 * @link http://www.zahidgurbuz.com/yayinlar/An%20Efficient%20Algorithm%20for%203D%20Rectangular%20Box%20Packing.pdf
 *
 * Copyright (C) 2012 Maarten de Boer
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
class LAFFPack {

    /** @var array $boxes Array of boxes to pack */
    private $boxes = null;

    /** @var array $packed_boxes Array of boxes that have been packed */
    private $packed_boxes = null;

    /** @var int $level Current level we're packing (0 based) */
    private $level = -1;

    /** @var array $container_dimensions Current container dimensions */
    private $container_dimensions = null;

    /**
     * Constructor of the BoxPacking class
     *
     * @access public
     * @param array $boxes Array of boxes to pack
     */
    function __construct($boxes = null, $container = null)
    {
        if(isset($boxes) && is_array($boxes)) {
            $this->boxes = $boxes;
            $this->packed_boxes = array();

            // Calculate container size
            if(!is_array($container)) {
                $this->container_dimensions = $this->_calc_container_dimensions();
            }
            else {
                // Calculate container size
                if(!is_array($container)) {
                    $this->container_dimensions = $this->_calc_container_dimensions();
                }
                else {
                    if(!array_key_exists('length', $container) ||
                        !array_key_exists('width', $container)) {
                        throw new InvalidArgumentException("Function _pack only accepts array (length, width, height) as argument for $container");
                    }

                    $this->container_dimensions['length'] = $container['length'];
                    $this->container_dimensions['width'] = $container['width'];

                    // Note: do NOT set height, it will be calculated on-the-go
                }
            }
        }
    }

    /**
     * Start packing boxes
     *
     * @access public
     * @param array $boxes
     * @param array $container Set fixed container dimensions
     * @returns void
     */
    function pack($boxes = null, $container = null) {
        if(isset($boxes) && is_array($boxes)) {
            $this->boxes = $boxes;
            $this->packed_boxes = array();
            $this->level = -1;
            $this->container_dimensions = null;

            // Calculate container size
            if(!is_array($container)) {
                $this->container_dimensions = $this->_calc_container_dimensions();
            }
            else {
                if(!array_key_exists('length', $container) ||
                    !array_key_exists('width', $container)) {
                    throw new InvalidArgumentException("Pack function only accepts array (length, width, height) as argument for \$container");
                }

                $this->container_dimensions['length'] = $container['length'];
                $this->container_dimensions['width'] = $container['width'];

                // Note: do NOT set height, it will be calculated on-the-go
            }
        }

        if(!isset($this->boxes)) {
            throw new InvalidArgumentException("Pack function only accepts array (length, width, height) as argument for \$boxes or no boxes given!");
        }

        $this->pack_level();
    }

    /**
     * Get remaining boxes to pack
     *
     * @access public
     * @returns array
     */
    function get_remaining_boxes() {
        return $this->boxes;
    }

    /**
     * Get packed boxes
     *
     * @access public
     * @returns array
     */
    function get_packed_boxes() {
        return $this->packed_boxes;
    }

    /**
     * Get container dimensions
     *
     * @access public
     * @returns array
     */
    function get_container_dimensions() {
        return $this->container_dimensions;
    }

    /**
     * Get container volume
     *
     * @access public
     * @returns float
     */
    function get_container_volume() {
        if(!isset($this->container_dimensions)) {
            return 0;
        }

        return $this->_get_volume($this->container_dimensions);
    }

    /**
     * Get number of levels
     *
     * @access public
     * @returns int
     */
    function get_levels() {
        return $this->level + 1;
    }

    /**
     * Get total volume of packed boxes
     *
     * @access public
     * @returns float
     */
    function get_packed_volume() {
        if(!isset($this->packed_boxes)) {
            return 0;
        }

        $volume = 0;

        for($i = 0; $i < count(array_keys($this->packed_boxes)); $i++) {
            foreach($this->packed_boxes[$i] as $box) {
                $volume += $this->_get_volume($box);
            }
        }

        return $volume;
    }

    /**
     * Get number of levels
     *
     * @access public
     * @returns int
     */
    function get_remaining_volume() {
        if(!isset($this->packed_boxes)) {
            return 0;
        }

        $volume = 0;

        foreach($this->boxes as $box) {
            $volume += $this->_get_volume($box);
        }

        return $volume;
    }

    /**
     * Get dimensions of specified level
     *
     * @access public
     * @param int $level
     * @returns array
     */
    function get_level_dimensions($level = 0) {
        if($level < 0 || $level > $this->level || !array_key_exists($level, $this->packed_boxes)) {
            throw new OutOfRangeException("Level {$level} not found!");
        }

        $boxes = $this->packed_boxes;
        $edges = array('length', 'width', 'height');

        // Get longest edge
        $le = $this->_calc_longest_edge($boxes[$level], $edges);
        $edges = array_diff($edges, array($le['edge_name']));

        // Re-iterate and get longest edge now (second longest)
        $sle = $this->_calc_longest_edge($boxes[$level], $edges);

        return array(
            'width' => $le['edge_size'],
            'length' => $sle['edge_size'],
            'height' => $boxes[$level][0]['height']
        );
    }

    /**
     * Get longest edge from boxes
     *
     * @access public
     * @param array $edges Edges to select the longest from
     * @returns array
     */
    function _calc_longest_edge($boxes, $edges = array('length', 'width', 'height')) {
        if(!isset($boxes) || !is_array($boxes)) {
            throw new InvalidArgumentException('_calc_longest_edge function requires an array of boxes, '.typeof($boxes).' given');
        }

        // Longest edge
        $le = null;		// Longest edge
        $lef = null;	// Edge field (length | width | height) that is longest

        // Get longest edges
        foreach($boxes as $k => $box) {
            foreach($edges as $edge) {
                if(array_key_exists($edge, $box) && $box[$edge] > $le) {
                    $le = $box[$edge];
                    $lef = $edge;
                }
            }
        }

        return array(
            'edge_size' => $le,
            'edge_name' => $lef
        );
    }

    /**
     * Calculate container dimensions
     *
     * @access public
     * @returns array
     */
    function _calc_container_dimensions() {
        if(!isset($this->boxes)){
            return array(
                'length' => 0,
                'width' => 0,
                'height' => 0
            );
        }

        $boxes = $this->boxes;

        $edges = array('length', 'width', 'height');

        // Get longest edge
        $le = $this->_calc_longest_edge($boxes, $edges);
        $edges = array_diff($edges, array($le['edge_name']));

        // Re-iterate and get longest edge now (second longest)
        $sle = $this->_calc_longest_edge($boxes, $edges);

        return array(
            'length' => $le['edge_size'],
            'width' => $sle['edge_size'],
            'height' => 0
        );
    }

    /**
     * Utility function to swap two elements in an array
     *
     * @access public
     * @param array $array
     * @param mixed $el1 Index of item to be swapped
     * @param mixed $el2 Index of item to swap with
     * @returns array
     */
    function _swap($array, $el1, $el2) {
        if(!array_key_exists($el1, $array) || !array_key_exists($el2, $array)) {
            throw new InvalidArgumentException("Both element to be swapped need to exist in the supplied array");
        }

        $tmp = $array[$el1];
        $array[$el1] = $array[$el2];
        $array[$el2] = $tmp;

        return $array;
    }

    /**
     * Utility function that returns the total volume of a box / container
     *
     * @access public
     * @param array $box
     * @returns float
     */
    function _get_volume($box)  {
        if(!is_array($box) || count(array_keys($box)) < 3) {
            throw new InvalidArgumentException("_get_volume function only accepts arrays with 3 values (length, width, height)");
        }

        $box = array_values($box);

        return $box[0] * $box[1] * $box[2];
    }

    /**
     * Check if box fits in specified space
     *
     * @access private
     * @param array $box Box to fit in space
     * @param array $space Space to fit box in
     * @returns bool
     */
    private function _try_fit_box($box, $space)  {
        if(count($box) < 3) {
            throw new InvalidArgumentException("_try_fit_box function parameter $box only accepts arrays with 3 values (length, width, height)");
        }

        if(count($space) < 3) {
            throw new InvalidArgumentException("_try_fit_box function parameter $space only accepts arrays with 3 values (length, width, height)");
        }

        for($i = 0; $i < count($box); $i++) {
            if(array_key_exists($i, $space)) {
                if($box[$i] > $space[$i]) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Check if box fits in specified space
     * and rotate (3d) if necessary
     *
     * @access public
     * @param array $box Box to fit in space
     * @param array $space Space to fit box in
     * @returns bool
     */
    function _box_fits($box, $space) {
        $box = array_values($box);
        $space = array_values($space);

        if($this->_try_fit_box($box, $space)) {
            return true;
        }

        for($i = 0; $i < count($box); $i++) {
            // Temp box size
            $t_box = $box;

            // Remove fixed column from list to be swapped
            unset($t_box[$i]);

            // Keys to be swapped
            $t_keys = array_keys($t_box);

            // Temp box with swapped sides
            $s_box = $this->_swap($box, $t_keys[0], $t_keys[1]);

            if($this->_try_fit_box($s_box, $space))
                return true;
        }

        return false;
    }

    /**
     * Start a new packing level
     *
     * @access private
     * @returns void
     */
    private function pack_level() {
        $biggest_box_index = null;
        $biggest_surface = 0;

        $this->level++;

        // Find biggest (widest surface) box with minimum height
        foreach($this->boxes as $k => $box)
        {
            $surface = $box['length'] * $box['width'];

            if($surface > $biggest_surface) {
                $biggest_surface = $surface;
                $biggest_box_index = $k;
            }
            elseif($surface == $biggest_surface) {
                if(!isset($biggest_box_index) || (isset($biggest_box_index) && $box['height'] < $this->boxes[$biggest_box_index]['height']))
                    $biggest_box_index = $k;
            }
        }

        // Get biggest box as object
        $biggest_box = $this->boxes[$biggest_box_index];
        $this->packed_boxes[$this->level][] = $biggest_box;

        // Set container height (ck = ck + ci)
        $this->container_dimensions['height'] += $biggest_box['height'];

        // Remove box from array (ki = ki - 1)
        unset($this->boxes[$biggest_box_index]);

        // Check if all boxes have been packed
        if(count($this->boxes) == 0)
            return;

        $c_area = $this->container_dimensions['length'] * $this->container_dimensions['width'];
        $p_area = $biggest_box['length'] * $biggest_box['width'];

        // No space left (not even when rotated / length and width swapped)
        if($c_area - $p_area <= 0) {
            $this->pack_level();
        }
        else { // Space left, check if a package fits in
            $spaces = array();

            if($this->container_dimensions['length'] - $biggest_box['length'] > 0) {
                $spaces[] = array(
                    'length' => $this->container_dimensions['length'] - $biggest_box['length'],
                    'width' => $this->container_dimensions['width'],
                    'height' => $biggest_box['height']
                );
            }

            if($this->container_dimensions['width'] - $biggest_box['width'] > 0) {
                $spaces[] = array(
                    'length' => $biggest_box['length'],
                    'width' => $this->container_dimensions['width'] - $biggest_box['width'],
                    'height' => $biggest_box['height']
                );
            }

            // Fill each space with boxes
            foreach($spaces as $space) {
                $this->_fill_space($space);
            }

            // Start packing remaining boxes on a new level
            if(count($this->boxes) > 0)
                $this->pack_level();
        }
    }

    /**
     * Fills space with boxes recursively
     *
     * @access private
     * @returns void
     */
    private function _fill_space($space) {

        // Total space volume
        $s_volume = $this->_get_volume($space);

        $fitting_box_index = null;
        $fitting_box_volume = null;

        foreach($this->boxes as $k => $box)
        {
            // Skip boxes that have a higher volume than target space
            if($this->_get_volume($box) > $s_volume) {
                continue;
            }

            if($this->_box_fits($box, $space)) {
                $b_volume = $this->_get_volume($box);

                if(!isset($fitting_box_volume) || $b_volume > $fitting_box_volume) {
                    $fitting_box_index = $k;
                    $fitting_box_volume = $b_volume;
                }
            }
        }

        if(isset($fitting_box_index))
        {
            $box = $this->boxes[$fitting_box_index];

            // Pack box
            $this->packed_boxes[$this->level][] = $this->boxes[$fitting_box_index];
            unset($this->boxes[$fitting_box_index]);

            // Calculate remaining space left (in current space)
            $new_spaces = array();

            if($space['length'] - $box['length'] > 0) {
                $new_spaces[] = array(
                    'length' => $space['length'] - $box['length'],
                    'width' => $space['width'],
                    'height' => $box['height']
                );
            }

            if($space['width'] - $box['width'] > 0) {
                $new_spaces[] = array(
                    'length' => $box['length'],
                    'width' => $space['width'] - $box['width'],
                    'height' => $box['height']
                );
            }

            if(count($new_spaces) > 0) {
                foreach($new_spaces as $new_space) {
                    $this->_fill_space($new_space);
                }
            }
        }
    }
}

?>