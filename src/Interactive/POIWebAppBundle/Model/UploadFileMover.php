<?php

namespace Interactive\POIWebAppBundle\Model;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Interactive\POIWebAppBundle\Model\Document;

/**
 * Description of UploadFileMover
 *
 * @author Manoj
 */
class UploadFileMover {

    public function moveUploadedFile(UploadedFile $file, $uploadBasePath,$relativePath) {
        $originalName = $file->getFilename();
        // use filemtime() to have a more determenistic way to determine the subpath, otherwise its hard to test.
       // $relativePath = date('Y-m', filemtime($file->getPath()));
        $targetFileName = $relativePath . DIRECTORY_SEPARATOR . $originalName;
        $targetFilePath = $uploadBasePath . DIRECTORY_SEPARATOR . $targetFileName;
        
        $oName = $file->getClientOriginalName();
        $name_array = explode('.', $oName);
        $ext = $name_array[sizeof($name_array) - 1];
        
        
        /*$i=1;
        while (file_exists($targetFilePath) && md5_file($file->getPath()) != md5_file($targetFilePath)) {
            if ($ext) {
                $prev = $i == 1 ? "" : $i;
                $targetFilePath = $targetFilePath . str_replace($prev . $ext, $i++ . $ext, $targetFilePath);
                
            } else {
                $targetFilePath = $targetFilePath . $i++;
            }
        }*/
        
        //TODO - Remove this line when above comments are removed
        $targetFilePath = $targetFilePath . '.' . $ext;


        $targetDir = $uploadBasePath . DIRECTORY_SEPARATOR . $relativePath;
        if (!is_dir($targetDir)) {
            $ret = mkdir($targetDir, umask(), true);
            if (!$ret) {
                throw new \RuntimeException("Could not create target directory to move temporary file into.");
            }
        }
        $file->move($targetDir, basename($targetFilePath));

        return str_replace($uploadBasePath . DIRECTORY_SEPARATOR, "", $targetFilePath);
    }

    /**
     * Uploads file to the server
     * @param type $imageFile
     */
    public function processImageFile($image) {
        $status = true;
        $uploadedURL = '';
        $message = '';
        if (($image instanceof UploadedFile) && ($image->getError() == '0')) {
            if (($image->getSize() < 2000000000)) {
                $originalName = $image->getClientOriginalName();
                $name_array = explode('.', $originalName);
                $file_type = $name_array[sizeof($name_array) - 1];
                $valid_filetypes = array('jpg', 'jpeg', 'bmp', 'png');
                if (in_array(strtolower($file_type), $valid_filetypes)) {
                    //Start Uploading File
                    $document = new Document();
                    $document->setFile($image);
                    $document->setSubDirectory('uploads/points_of_interest');
                    $document->processFile();
                    $uploadedURL = $document->getFilePersistencePath();
                } else {
                    $status = false;
                    $message = 'Invalid File Type';
                }
            } else {
                $status = false;
                $message = 'Size exceeds limit';
            }
        } else {
            $status = false;
            $message = 'File Error';
        }
        
        if(!$status){
            return array('status' => $status, 'content' => $message);
        }
        else{
            return array('status' => $status, 'content' => $uploadedURL);
        }
    }

}

?>
