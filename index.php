<?php
    require './vendor/autoload.php';

    use Aws\Rekognition\RekognitionClient;

    $options = [
        'region' => 'us-west-2',
        'version' => 'latest'
    ];

    $rekognition = new RekognitionClient($options);

    $photo = 'input.jpg';
    $fp_image = fopen($photo, 'r');
    $image = fread($fp_image, filesize($photo));
    fclose($fp_image);

    $result = $rekognition->DetectFaces(array(
        'Image' => array(
            'Bytes' => $image,
        ),
        'Attributes' => array('ALL')
    ));


    for($n=0; $n < sizeof($result['FaceDetails']); $n++) {
        print 'Your age is between ' 
            . $result['FaceDetails'][$n]['AgeRange']['Low']
            . ' - ' . $result['FaceDetails'][$n]['AgeRange']['High'];
    }

    echo '<pre>';
    print_r($result);

