<?php

require './vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

$privateKeyFileContent = '{
  "type": "service_account",
  "project_id": "arctic-robot-342602",
  "private_key_id": "45d45bbc1eff3cb35e7a202705d7da976519abd6",
  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDvD3uRPQKR25OS\nRzYNYB0NUJV12PqAKwkHoHE6JQmFvApWVqZvu064rG1EVDkWBCvXKxVnyhYEYfWb\nJCleWPwjJvyMIiAGlgngcrUFyNmluJhLUdSzi7wajwOrRT/8YKcPRVcjNXYdm6Pj\nupzInIcJ4fGVP3123DekUoFJuRC45Nhmyn3HS62082mHpJ/E5o8XzDDpUTvARU7D\n6YDDtstIPqwTAfGXzk+LUgGIo3nMUGWsr95HxOjayU2zTS5Qdw6T+ZB0zzwdhZRa\n1MkX/53qqhQrAIrBRKq7H6joQSyLBRj4sr/eEN5LrFIfxv68JhhDnU63gqbpo+S7\nSBh0KOujAgMBAAECggEAaAwpD/Gp6KnU9NmhoPiwLFdidcRWYupYJ8WhAlmUZ2yM\nYz+beQ3hGWeStyahIf/2xNOvoVjHdGjeaQO4LaQ1OWeCi8tefP9YlSPXvgjJEePi\nBQY8uVicKkMMqcKeMs4uZ+saHezq18Ah+MAD9RyLebWpW/giN1Vpsk9mjhvKN24r\nlhm+1jT3AerLORmAuLtWX30MqBVb1UzC2iVF8vq2zeX8M2QDEZmTrT3NPngZXMUd\nTfkLp8WDPMbddOpmtVT6pKSV8VsRPYhDPel/74iZRB/I9ZGvl4OURxogQCrsBeun\nguX9f26pkFDXyupEcb3GxthcnvgcThjYOuUddl4swQKBgQD6Hjv6niRmwRnbPht4\nzGsx6UCQKsKM9PrnyOCU9kB1iDx3epDUr8bMrvmwCl9WPOm1nonK91TxSKUJYnz3\n40NHf6BzKog7p1mkPzG02ojd1UXgWfMxUYm0TkpOwP+eHj96E7AqfF66XVoiquuj\nGRVPfbE3MlAkrZlSf3IjV1IWKQKBgQD0rq3YIrF6zTSoo3Us+1FDBYRyWheaxjAD\nw5GgO08d2U+M3DfnHUM8lHXy95hAz37djFnBmXJYaEy91ngCu8oNtx+wEO/HRKcR\nC1T7GeHweD/cv3k3m7b6x+OcMCF13KyDloUlk9ido8WaAjYCmxygYWk+Hk1wn7lh\noMX6nCR06wKBgFLsczZD+A2ZN9lYXgNOwrtped5STu4syoLONqcsfXJ6GJIEMMBT\nBrYVzPJwfes5hsKQLV79YUwdqZnS7VvCHSw3RBrqnwAoG7A4w2ISkg36B5C6Qca4\nIc+FpV0234isvp7aqC1tzno7OQcFY9pPFqGkKn0CUU/Xvl17o3vUF4MBAoGBAIEj\nVFNXdC5o8ZrzsltMRQZHejDURdMFOMAzzr8vrkEFuYuRituqwRrPDDVw4eWK3d1W\nPuUD9KqeWapz8CEZNbnpZYsKVVLpc/d18KMadPnyrVn3oKVtxLQ1HXcInBBVqKNG\npP1BO7lvf1IaSqEzdndbEi2b1qlTU4coUHVFRaSDAoGASb33njYMfY9uicuuHXiK\nDyxxNnXEgjXc7wKGDkemj8YZCIywaW1Rq2VhulvcyDNOFOZQPtMdCmzCVxeD9PEz\n/p2qCFvJ0Bv72Fea8tcdQBIrr7+qGMK0VHjPD7q0jbHB946V8akgS23NRYLncYPO\nDntXq8puYhbGIR9nG52bKTw=\n-----END PRIVATE KEY-----\n",
  "client_email": "gcp-storage-upload@arctic-robot-342602.iam.gserviceaccount.com",
  "client_id": "112520825110497174142",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/gcp-storage-upload%40arctic-robot-342602.iam.gserviceaccount.com"
}';
 
function uploadFile($bucketName, $fileContent, $cloudPath) {
  $privateKeyFileContent = $GLOBALS['privateKeyFileContent'];
  // connect to Google Cloud Storage using private key as authentication
  try {
    $storage = new StorageClient([
      'keyFile' => json_decode($privateKeyFileContent, true)
    ]);
  } catch (Exception $e) {
    // maybe invalid private key ?
    print $e;
    return false;
  }
     
  // set which bucket to work in
  $bucket = $storage->bucket($bucketName);
     
  // upload/replace file 
  $storageObject = $bucket->upload(
    $fileContent,
    ['name' => $cloudPath]
    // if $cloudPath is existed then will be overwrite without confirmation
    // NOTE: 
    // a. do not put prefix '/', '/' is a separate folder name  !!
    // b. private key MUST have 'storage.objects.delete' permission if want to replace file !
  );
     
  // is it succeed ?
  return $storageObject != null;
}
     
function getFileInfo($bucketName, $cloudPath) {
  $privateKeyFileContent = $GLOBALS['privateKeyFileContent'];
  // connect to Google Cloud Storage using private key as authentication
  try {
    $storage = new StorageClient([
      'keyFile' => json_decode($privateKeyFileContent, true)
    ]);
  } catch (Exception $e) {
  // maybe invalid private key ?
    print $e;
    return false;
  }
     
  // set which bucket to work in
  $bucket = $storage->bucket($bucketName);
  $object = $bucket->object($cloudPath);
  return $object->info();
}

function listFiles($bucket, $directory = null) {
  if ($directory == null) {
      // list all files
      $objects = $bucket->objects();
  } else {
      // list all files within a directory (sub-directory)
      $options = array('prefix' => $directory);
      $objects = $bucket->objects($options);
  }
  
  foreach ($objects as $object) {
      print $object->name() . PHP_EOL;
      // NOTE: if $object->name() ends with '/' then it is a 'folder'
  }
}


?>