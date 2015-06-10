<?php
    /**
     * Created by PhpStorm.
     * User: Bernardo
     */

    include_once('code/controllers/ParcelController.php');

    $parcelController = new ParcelController();

    if(isset($_POST['pickup'])){
        $result = $parcelController;
    }

    if(isset($_POST['deliver'])){

    }

    if(isset($_POST['hqarrival'])){

    }

    if(isset($_POST['hqdeliver'])){

    }

    if(isset($_GET['id'])){
        $parcel = $parcelController->getParcel($_GET['id']);
        print_r($parcel);

        echo '<div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <strong>Pakket</strong><br/>
                        Pakketnummer: '.$parcel['parcelnumber'].'<br/>
                        Zendingnummer: '.$parcel['consignmentnumber'].'<br/><br/>
                    </div>
                    <div class="col-md-3">
                        <strong>Adres</strong><br/>
                        Districtnr: '.$parcel['districtnumber'].'<br/>
                        Straat: '.$parcel['street'].'<br/>
                        Postcode: '.$parcel['zipcode'].'<br/>
                        Woonplaats: '.$parcel['city'].'<br/>
                        Huisnummer: '.$parcel['housenumber'].'<br/>
                        Huisnummer toevoeging: '.$parcel['housenumberaddon'].'<br/><br/>
                    </div>
                    <div class="col-md-3">
                        <strong>Werknemers</strong><br/>
                        Wordt opgehaald door:<br/> '.$parcel['pickupemployeefirstname'].' '.$parcel['pickupemployeelastname'].'<br/>
                        Wordt bezorgd door:<br/> '.$parcel['deliveremployeefirstname'].' '.$parcel['deliveremployeelastname'].'<br/><br/>
                    </div>
                    <div class="col-md-3">
                        <strong>Tijden</strong><br/>
                        Opgehaald om:<br/> '.(!empty($parcel['pickup']) ? $parcel['pickup'] : 'nog niet opgehaald').'<br/>
                        Bezorgd om:<br/> '.(!empty($parcel['delivery']) ? $parcel['delivery'] : 'nog niet bezorgd').'<br/>
                        Op hoofdkantoor gebracht:<br/> '.(!empty($parcel['hqarrival']) ? $parcel['hqarrival'] : 'nog niet gebracht').'<br/>
                        Op hoofdkantoor vrijgegeven:<br/> '.(!empty($parcel['hqdepature']) ? $parcel['hqdepature'] : 'nog niet vrijgegeven').'<br/><br/>
                    </div>
                </div>
                <div class="col-md-12">
                    <form action="#" method="post">
                        <div class="col-md-3">
                            <input class="btn btn-info btn-block" type="submit" value="Pakket opgehaald" name="pickup" /><br/>
                        </div>
                        <div class="col-md-3">
                            <input class="btn btn-info btn-block" type="submit" value="Pakket bezorgd" name="deliver" /><br/>
                        </div>
                        <div class="col-md-3">
                            <input class="btn btn-info btn-block" type="submit" value="Bezorgd bij hoofdkantoor" name="hqdeliver" /><br/>
                        </div>
                        <div class="col-md-3">
                            <input class="btn btn-info btn-block" type="submit" value="Opgehaald bij hoofdkantoor" name="hqarrival" /><br/>
                        </div>
                    </form>
                </div>
              </div>';
    }else{
        echo 'U heeft geen pakket gekozen!';
    }

