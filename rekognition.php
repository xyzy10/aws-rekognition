<?php
    require './vendor/autoload.php';

    use Aws\Rekognition\RekognitionClient;

    $options = [
        'region' => 'us-west-2',
        'version' => 'latest'
    ];

    $rekognition = new RekognitionClient($options);

    $photo = 'target.jpg';
    $fp_image = fopen($photo, 'r');
    $image = fread($fp_image, filesize($photo));
    fclose($fp_image);

    $result = $rekognition->DetectLabels(array(
        'Image' => array(
            'Bytes' => $image,
        ),
    ));

    echo "<img src=\"./$photo\" style=\"width: 800px;\"><br><br>";

    print 'Objects: ';
    for ($i = 0; $i < sizeof($result['Labels']) ; $i++) {
            print $result['Labels'][$i]['Name'] . ', ';
    }

    echo '<br>';
    echo '<br>';


    $result_text = $rekognition->DetectText(array(
        'Image' => array(
            'Bytes' => $image,
        ),
    ));

    print 'Text: ';
    for ($i = 0; $i < sizeof($result_text['TextDetections']) ; $i++) {
        if ($result_text['TextDetections'][$i]['Type'] == 'LINE') {
            print $result_text['TextDetections'][$i]['DetectedText'] . ', ';
        }
    }

//    echo '<pre>';
//    var_dump($result);
