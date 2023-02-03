<?php if(empty($card_info)){ ?>
  <div class="alert alert-info text-center">
    <p>There is no card. <a href="<?php echo base_url("account_op/new_form");?>">Click</a> to add.</p>
  </div>
<?php } else {?>
  <div class="row justify-content-center">
  <?php for ($i =0 ; $i<count($card_info);$i++) { ?>
    <div class="col-sm-4" style="height:250px">
    <div class="card">
      <div class="card__front card__part">
      <img class="card__front-square card__square" src="<?php echo base_url("resources");?>/assets/img/chip.png">
      <img class="card__front-logo card__logo" style="height:25px" src="<?php echo base_url("resources");?>/assets/img/visa.png">
      <p class="card_numer"><?php echo edit_card_no($card_info[$i]->Card_No); ?></p>
      <div class="card__space-75">
        <span class="card__label">Card holder</span>
        <p class="card__info"><?php echo ($card_info[$i]->First_Name .' '. $card_info[$i]->Last_Name); ?></p>
      </div>
      <div class="card__space-25">
        <span class="card__label">Expires</span>
        <p class="card__info"><?php echo ($card_info[$i]->dateM .'/'. $card_info[$i]->dateY); ?></p>
      </div>
  </div>

  <div class="card__back card__part">
    <div class="card__black-line"></div>
    <div class="card__back-content">
    <div class="card__secret">
    
    <p class="card__secret--last"><?php echo($card_info[$i]->CVV); ?></p>
  </div>
    <img class="card__back-logo card__logo" style="height:25px" src="<?php echo base_url("resources");?>/assets/img/visa.png">
  
      </div>
    </div>

  </div>
  <div style="margin-top:10px"> 
    Account Balance : <?php echo(number_format($card_info[$i]->Balance,2)); ?> 
  </div>
    </div>
    
  <?php } ?>
</div>

  
<?php } ?>


