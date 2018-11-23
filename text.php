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

    $result = $rekognition->DetectText(array(
        'Image' => array(
            'Bytes' => $image,
        ),
    ));

    for ($i = 0; $i < sizeof($result['TextDetections']) ; $i++) {
        if ($result['TextDetections'][$i]['Type'] == 'LINE') {
            print $result['TextDetections'][$i]['DetectedText'] . '<br>';
        }
    }

    //echo '<pre>';
    //var_dump($result);
