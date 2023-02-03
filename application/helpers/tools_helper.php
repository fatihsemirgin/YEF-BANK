<?php

function get_active_user(){
    $t=&get_instance();

    $user= $t->session->userdata("customer");

    if($user){
      return $user;
    }
    else{
      return false;
    }

}
function edit_card_no($card_no){
  $old_card_no = $card_no;
  $new_card_no="";

  for ($i= 1;$i<=strlen($card_no);$i++){

    $new_card_no .= $old_card_no[$i-1];
    if($i % 4 == 0){
      $new_card_no .= " ";
    }
  }

  return $new_card_no;
}

function create_iban() {
  $iban = "TR";
  for ($i = 0; $i < 24; $i++) {
      $randomNumber = rand(0, 9);
      $iban = $iban . strval($randomNumber);
  }
  return $iban;
}

function create_card_no() {
  $card = "4";
  for ($i = 0; $i < 15; $i++) {
      $randomNumber = rand(0, 9);
      $card = $card . strval($randomNumber);
  }
  return $card;
}

function get_active_wrong_user(){
  $t=&get_instance();

  $wrong_user= $t->session->userdata("customer_wrong");

  if($wrong_user){
    return $wrong_user;
  }
  else{
    return false;
  }

}

