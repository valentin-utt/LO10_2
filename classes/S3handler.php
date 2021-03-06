<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


include('./Interface/IS3Handler.php');



class S3handler implements IS3Handler {

    public static $bucketName = 'projector.image';
    public static $IAM_KEY = 'XXXXXX';
    public static $IAM_SECRET = 'XXXXXX';

    public function __construct() {
        
    }

    public function uploadToS3($fileURL) {


        // AWS Info
        // Connect to AWS

        $IAM_KEY = $this::$IAM_KEY;
        $IAM_SECRET = $this::$IAM_SECRET;

        try {
            // You may need to change the region. It will say in the URL when the bucket is open
            // and on creation. us-east-2 is Ohio, us-east-1 is North Virgina
            $s3 = S3Client::factory(
                            array(
                                'credentials' => array(
                                    'key' => $IAM_KEY,
                                    'secret' => $IAM_SECRET
                                ),
                                'version' => 'latest',
                                'region' => 'eu-west-1'
                            )
            );
        } catch (Exception $e) {
            // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
            // return a json object.
            die("Error: " . $e->getMessage());
        }

        //$fileURL = ; // Change this
        // For this, I would generate a unqiue random string for the key name. But you can do whatever.
        $keyName = basename($fileURL);
        $pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $this::$bucketName . '/' . $keyName;
        // Add it to S3
        try {
            // You need a local copy of the image to upload.
            // My solution: http://stackoverflow.com/questions/21004691/downloading-a-file-and-saving-it-locally-with-php
            if (!file_exists('/tmp/tmpfile')) {
                mkdir('/tmp/tmpfile', 0777, true);
            }

            $tempFilePath = '/tmp/tmpfile/' . basename($fileURL);
            $tempFile = fopen($tempFilePath, "w") or die("Error: Unable to open file.");
            $fileContents = file_get_contents($fileURL);
            $tempFile = file_put_contents($tempFilePath, $fileContents);
            $s3->putObject(
                    array(
                        'Bucket' => $this::$bucketName,
                        'Key' => $keyName,
                        'SourceFile' => $tempFilePath,
                        'ACL' => 'public-read-write',
                        'StorageClass' => 'REDUCED_REDUNDANCY'
                    )
            );
            // WARNING: You are downloading a file to your local server then uploading
            // it to the S3 Bucket. You should delete it from this server.
            // $tempFilePath - This is the local file path.
        } catch (S3Exception $e) {
            die('Error:' . $e->getMessage());
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        //echo 'Done';
        //unlink($tempFilePath) or die("Couldn't delete file");
        // Now that you have it working, I recommend adding some checks on the files.
        // Example: Max size, allowed file types, etc.
    }

    public function deleteFromS3($keyName) {
        // AWS Info
        $provided_IAM_KEY = $this::$IAM_KEY;
        $provided_IAM_SECRET = $this::$IAM_SECRET;
        // Connect to AWS
        try {
            // You may need to change the region. It will say in the URL when the bucket is open
            // and on creation. us-east-2 is Ohio, us-east-1 is North Virgina

            $s3 = S3Client::factory(
                            array(
                                'credentials' => array(
                                    'key' => $provided_IAM_KEY,
                                    'secret' => $provided_IAM_SECRET
                                ),
                                'version' => 'latest',
                                'region' => 'eu-west-1'
                            )
            );
        } catch (Exception $e) {
            // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
            // return a json object.
            die("Error: " . $e->getMessage());
        }

        //$fileURL = ; // Change this
        // For this, I would generate a unqiue random string for the key name. But you can do whatever.
        //$keyName =  basename($fileURL);
        $pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $this::$bucketName . '/' . $keyName;
        // Add it to S3
        try {

            $s3->deleteObject(
                    array(
                        'Bucket' => $this::$bucketName,
                        'Key' => $keyName,
                    )
            );
        } catch (S3Exception $e) {
            die('Error:' . $e->getMessage());
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        //echo 'Done';
        // Now that you have it working, I recommend adding some checks on the files.
        // Example: Max size, allowed file types, etc.
    }

}
?>

