<?php

// abstract class to design class framework

abstract class AbstractFramework{

  abstract public function model($model);
  abstract public function view($model, $data = []);
  abstract public function getUrl();
  abstract public function redirect($url = '');

}
