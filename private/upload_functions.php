<?php
function imageUpload($string, $object, $location, $num=''){
  $file = new Bulletproof\Image($_FILES);

    if ($file[$string]){
      $file->setName($object->id . '-' . $location . $num);
      $file->setSize(8, 2097152);
      $file->setMime(array('jpeg', 'jpg', 'png'));
      $file->setLocation($_SERVER['DOCUMENT_ROOT'] . '/public/upload/' . $location);
            
      $upload = $file->upload();
      if($upload) {
        $source = '/public/upload/' . $location . '/' . $upload->getName() . '.' . $upload->getMime();
        if($upload->getWidth() >= $upload->getHeight()){
          $idealHeight = 200;
          $idealWidth = (200/$upload->getHeight()) * $upload->getWidth();
        } else {
          $idealWidth = 200;
          $idealHeight = (200/$upload->getWidth()) * $upload->getHeight();
        }
        $resize = bulletproof\utils\resize(
          $upload->getFullPath(), 
          $upload->getMime(),
          $upload->getWidth(),
          $upload->getHeight(),
          $idealWidth,
          $idealHeight,
          true
        );
        return $source;
      } else {
        return false;
      }
    }
}
?>