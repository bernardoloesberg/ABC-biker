<?php

    echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="customer">Klant</label>
                        <select class="form-control" name="customernumber">';



    echo '          </div>
                    <div class="form-group">
                        <label for="pickupstreet">Straat</label>
                        <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="">
                    </div>
                    <div class="form-group">
                        <label for="pickuphousenumber">Huisnummer</label>
                        <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="">
                    </div>
                    <div class="form-group">
                        <label for="pickuphousenumberaddon">Huisnummer toevoeging</label>
                        <input type="text" class="form-control" id="pickuphousenumberaddon" name="pickuphousenumberaddon" value="">
                    </div>
                    <div class="form-group">
                        <label for="pickupzipcode">Postcode</label>
                        <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="">
                    </div>
                    <div class="form-group">
                        <label for="pickupcity">Stad</label>
                        <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="">
                    </div>
                    <div class="form-group">
                        <label for="consignorname">Getekend door</label>
                        <input type="text" class="form-control" id="consignorname" name="consignorname" value="">
                    </div>
                    <div class="form-group">
                        <label for="completedlabel">Afgerond</label><br/>
                        <label class="radio-inline">
                            <input type="radio" name="completed" id="completed1" value="1"> Ja
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="completed" id="completed2" value="0"> Nee
                        </label>
                    </div>
                    <div class="form-group date">
                        <label for="consignorname">Ophaaltijd</label>
                        <input type="text" class="form-control" id="scheduledpickup" name="scheduledpickup" value="">
                    </div>
                    <div class="form-group date">
                        <label for="consignorname">Aflevertijd</label>
                        <input type="text" class="form-control" id="scheduleddelivery" name="scheduleddelivery" value="">
                    </div>
                    <div class="form-group date">
                        <label for="consignorname">Prijs</label>
                        <div class="input-group">
                            <span class="input-group-addon">&euro;</span>
                            <input type="text" class="form-control" id="price" name="price" value="">
                        </div>
                    </div>
                    <div class="form-group date">
                        <label for="consignorname">Totaal prijs</label>
                        <div class="input-group">
                            <span class="input-group-addon">&euro;</span>
                            <input type="text" class="form-control" id="totalprice" name="totalprice" value="">
                        </div>
                    </div>
                    <button type="submit" name="createConsignment" class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>';