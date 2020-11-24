<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function makeRandomColor(){
  $color = dechex(rand(0x000000, 0xFFFFFF));
  return $color;

}
