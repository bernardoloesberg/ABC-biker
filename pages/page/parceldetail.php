<?php
    /**
     * Created by PhpStorm.
     * User: Bernardo
     */

    include_once('code/controllers/ParcelController.php');

    if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'biker' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'manager'){
        $parcelController = new ParcelController();

        if(isset($_POST['pickup'])){
            $result = $parcelController->setPickupTime($_GET['id']);

            if($result == 'success'){
                showMessage('success','Je hebt een ophaaltijd toegevoegd');
            }else{
                showMessage('danger',$result);
            }
        }

        if(isset($_POST['deliver'])){
            $result = $parcelController->setDeliverTime($_GET['id']);

            if($result == 'success'){
                showMessage('success','Je hebt een bezorgtijd toegevoegd');
            }else{
                showMessage('danger',$result);
            }
        }

        if(isset($_POST['hqarrival'])){
            $result = $parcelController->setHqArrivalTime($_GET['id']);

            if($result == 'success'){
                showMessage('success','Je hebt een hoofdkantoor ophaaltijd toegevoegd');
            }else{
                showMessage('danger',$result);
            }
        }

        if(isset($_POST['hqdeliver'])){
            $result = $parcelController->setHqDepatureTime($_GET['id']);

            if($result == 'success'){
                showMessage('success','Je hebt een hoofdkantoor bezorgtijd toegevoegd');
            }else{
                showMessage('danger',$result);
            }
        }

        if(isset($_GET['id'])){
            $parcel = $parcelController->getParcel($_GET['id']);

            echo '<div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <strong>Pakket</strong><br/>
                            Pakketnummer: '.$parcel['parcelnumber'].'<br/>
                            Zendingnummer: '.$parcel['consignmentnumber'].'<br/>
                            Afstand: <span class="distance"></span><br/>
                            Bedrag: <span class="distanceprice"></span><br/><br/>
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

            loadscript('code/js/calculateDistancePrice.js');
        }else{
            echo 'U heeft geen pakket gekozen!';
        }
    }else{
        showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
    }

