<?php
    require './vendor/autoload.php';

    use Aws\Rekognition\RekognitionClient;

    $options = [
        'region' => 'us-west-2',
        'version' => 'latest'
    ];

    $rekognition = new RekognitionClient($options);

    $photo = 'text.jpg';
    $fp_image = fopen($photo, 'r');
    $image = fread($fp_image, filesize($photo));
    fclose($fp_image);

    $result = $rekognition->DetectLabels(array(
        'Image' => array(
            'Bytes' => $image,
        ),
    ));

    for ($i = 0; $i < sizeof($result['Labels']) ; $i++) {
            print $result['Labels'][$i]['Name'] . '<br>';
    }

//    echo '<pre>';
//    var_dump($result);
