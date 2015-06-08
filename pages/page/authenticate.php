<?php
    echo ' <div class="login-form">
                <form method="POST">
                  <h3>Two-Factor Verification</h3>
                  Token: <input id="authy-token" name="authy-token" type="text" value=""/>
                  <br/>
                  <a href="#" id="authy-help">help</a>
                </form>
              </div>


            Token: <input id="token" name="token" type="text" value=""/>
            <button class="btn btn-primary" id="loginButton">Login</button>';

    loadscript('code/js/authentication.js');
    /*loadscript('lib/authy/form.authy.js');*/