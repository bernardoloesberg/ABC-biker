<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 9-6-2015
 * Time: 13:19
 */

require_once("../ABC-biker/lib/PHPchart/conf.php");


echo '<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">';



                $pc = new C_PhpChartX(array(array(11, 9, 5, 12, 14)),'basic_chart');
                $pc->set_title(array('text'=>'Basic Chart Animated'));
                $pc->draw();

 echo'               </div>
          </div>';